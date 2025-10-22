<?php

namespace App\Livewire\Dashboard\Pages;

use Livewire\Component;

class Home extends Component
{
    public function createNewVideo()
    {
        $this->dispatch('navigateTo', 'video-creator');
    }

    public function browseLibrary()
    {
        $this->dispatch('navigateTo', 'resource-library');
    }

    public function render()
    {
        return view('livewire.dashboard.pages.home');
    }
}
