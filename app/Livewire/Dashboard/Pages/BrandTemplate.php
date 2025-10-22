<?php

namespace App\Livewire\Dashboard\Pages;

use Livewire\Component;

class BrandTemplate extends Component
{
    public $brandName = '';
    public $primaryColor = '#8B5CF6';
    public $secondaryColor = '#EC4899';
    public $logo = null;

    public function render()
    {
        return view('livewire.dashboard.pages.brand-template');
    }

    public function saveBrandTemplate()
    {
        $this->validate([
            'brandName' => 'required|min:2',
            'primaryColor' => 'required',
            'secondaryColor' => 'required',
        ]);

        // TODO: Sauvegarder le template de marque
        session()->flash('message', 'Template de marque sauvegardé avec succès !');
    }
}
