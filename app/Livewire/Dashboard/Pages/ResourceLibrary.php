<?php

namespace App\Livewire\Dashboard\Pages;

use Livewire\Component;
use Livewire\WithPagination;

class ResourceLibrary extends Component
{
    use WithPagination;

    public $search = '';
    public $filter = 'all'; // all, images, videos, audio

    public function render()
    {
        return view('livewire.dashboard.pages.resource-library');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
