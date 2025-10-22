<?php

use App\Http\Controllers\VideoConverterController;
use App\Livewire\DotDashboard;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/lang-switch', function (Request $request) {
    $locale = $request->string('locale')->toString();
    if (in_array($locale, ['en','fr'], true)) {
        Session::put('locale', $locale);
    }
    return back(status: 303); // évite le repost du formulaire
})->name('lang.switch');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', DotDashboard::class)->name('dashboard');

    // Route pour afficher l'interface du simulateur (dans l'iframe)
    Route::get('/video-simulator', function () {
        return view('video-simulator');
    })->name('video-simulator');

    // Route API pour convertir WebM → MP4
    Route::post('/api/convert-webm', [VideoConverterController::class, 'convert'])
        ->name('api.convert-webm');

});
