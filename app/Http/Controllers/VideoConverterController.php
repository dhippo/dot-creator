<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use FFMpeg\FFMpeg;
use FFMpeg\Format\Video\X264;

class VideoConverterController extends Controller
{
    public function convert(Request $request)
    {
        $request->validate([
            'webm' => 'required|file|mimes:webm|max:204800', // 200MB max
        ]);

        try {
            // Sauvegarder le fichier WebM temporaire
            $webmPath = $request->file('webm')->store('temp', 'local');
            $webmFullPath = storage_path('app/' . $webmPath);

            // Chemin de sortie MP4
            $mp4Filename = 'video_' . time() . '_' . uniqid() . '.mp4';
            $mp4Path = 'temp/' . $mp4Filename;
            $mp4FullPath = storage_path('app/' . $mp4Path);

            // Configuration FFmpeg
            $ffmpeg = FFMpeg::create([
                'ffmpeg.binaries'  => config('ffmpeg.binary', '/usr/bin/ffmpeg'),
                'ffprobe.binaries' => config('ffmpeg.probe', '/usr/bin/ffprobe'),
                'timeout'          => 3600,
                'ffmpeg.threads'   => 12,
            ]);

            // Ouvrir la vidéo WebM
            $video = $ffmpeg->open($webmFullPath);

            // Format de sortie MP4 (même config que le serveur Node.js d'Antoine)
            $format = new X264('aac');
            $format->setKiloBitrate(2000)
                ->setAudioKiloBitrate(192);

            // Convertir et sauvegarder
            $video->save($format, $mp4FullPath);

            // Supprimer le fichier WebM source
            Storage::disk('local')->delete($webmPath);

            // Retourner le fichier MP4 en téléchargement
            return response()->download($mp4FullPath, 'video.mp4')
                ->deleteFileAfterSend(true);

        } catch (\Exception $e) {
            Log::error('FFmpeg conversion failed: ' . $e->getMessage());

            // Nettoyer les fichiers en cas d'erreur
            if (isset($webmPath)) {
                Storage::disk('local')->delete($webmPath);
            }
            if (isset($mp4Path) && Storage::disk('local')->exists($mp4Path)) {
                Storage::disk('local')->delete($mp4Path);
            }

            return response()->json([
                'error' => 'La conversion a échoué. Veuillez réessayer.'
            ], 500);
        }
    }
}
