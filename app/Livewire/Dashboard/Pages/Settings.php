<?php

namespace App\Livewire\Dashboard\Pages;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Settings extends Component
{
    public $currentLocale;

    public function mount()
    {
        $this->currentLocale = app()->getLocale();
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect('/');
    }

    public function render()
    {
        return view('livewire.dashboard.pages.settings');
    }
}
