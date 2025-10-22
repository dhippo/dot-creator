<?php

namespace App\Livewire\Dashboard\Pages;

use Livewire\Component;

class Profile extends Component
{
    public function render()
    {
        return view('livewire.dashboard.pages.profile');
    }

    public function redirectToJetstreamProfile()
    {
        return redirect()->route('profile.show');
    }
}
