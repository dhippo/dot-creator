<?php

namespace App\Livewire\Dashboard\Pages;

use Livewire\Component;

class VideoCreator extends Component
{
    public function cancel()
    {
        // Rediriger vers la page d'accueil
        $this->dispatch('navigateTo', 'home');
    }

    public function save()
    {
        // TODO: Logique de sauvegarde
        session()->flash('message', __('pages/video-creator.messages.saved'));
    }

    public function publish()
    {
        // TODO: Logique de publication (pour plus tard)
    }

    public function render()
    {
        return view('livewire.dashboard.pages.video-creator');
    }
}
