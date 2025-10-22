<?php

namespace App\Livewire;

use Livewire\Component;

class DotDashboard extends Component
{
    public string $currentPage = 'home';
    public bool $sidebarOpen = true;

    protected $listeners = ['navigateTo'];

    public function mount()
    {
        // Restaurer l'état de la sidebar depuis la session
        $this->sidebarOpen = session()->get('sidebar_open', true);
    }

    public function navigateTo($page)
    {
        $this->currentPage = $page;
    }

    public function toggleSidebar()
    {
        $this->sidebarOpen = !$this->sidebarOpen;
        // Persister l'état dans la session
        session()->put('sidebar_open', $this->sidebarOpen);
    }

    public function getMenuItemsProperty()
    {
        return [
            [
                'section' => __('dashboard.menu.create.section'),
                'items' => [
                    ['key' => 'home', 'label' => __('dashboard.menu.create.home'), 'icon' => 'home'],
                    ['key' => 'brand-template', 'label' => __('dashboard.menu.create.brand_template'), 'icon' => 'bookmark'],
                    ['key' => 'resource-library', 'label' => __('dashboard.menu.create.resource_library'), 'icon' => 'folder'],
                ]
            ],
            [
                'section' => __('dashboard.menu.publish.section'),
                'items' => [
                    ['key' => 'calendar', 'label' => __('dashboard.menu.publish.calendar'), 'icon' => 'calendar'],
                    ['key' => 'social-accounts', 'label' => __('dashboard.menu.publish.social_accounts'), 'icon' => 'share-2'],
                ]
            ],
        ];
    }

    public function getBottomMenuItemsProperty()
    {
        return [
            ['key' => 'profile', 'label' => __('dashboard.menu.bottom.profile'), 'icon' => 'user'],
            ['key' => 'help-center', 'label' => __('dashboard.menu.bottom.help_center'), 'icon' => 'help-circle'],
            ['key' => 'credits', 'label' => __('dashboard.menu.bottom.credits'), 'icon' => 'credit-card'],
            ['key' => 'settings', 'label' => __('dashboard.menu.bottom.settings'), 'icon' => 'settings'],
        ];
    }

    public function render()
    {
        return view('livewire.dot-dashboard')
            ->layout('layouts.app');
    }
}
