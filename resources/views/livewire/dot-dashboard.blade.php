<div class="flex h-screen bg-gray-50 overflow-hidden">
    <!-- Sidebar -->
    <aside
        class="bg-white border-r border-gray-200 flex-shrink-0 transition-all duration-300 ease-in-out"
        :class="{ 'w-64': @js($sidebarOpen), 'w-20': !@js($sidebarOpen) }"
        x-data="{ open: @entangle('sidebarOpen') }"
    >
        <div class="flex flex-col h-full">
            <!-- Logo & Toggle -->
            <div class="flex items-center justify-between p-4 border-b border-gray-200">
                <div x-show="open" x-transition class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-sm">DC</span>
                    </div>
                    <span class="font-bold text-lg text-gray-900">Dot Creator</span>
                </div>

                <button
                    wire:click="toggleSidebar"
                    class="p-2 rounded-lg hover:bg-gray-100 transition-colors"
                    aria-label="Toggle sidebar"
                >
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                    </svg>
                </button>
            </div>

            <!-- Main Navigation -->
            <nav class="flex-1 overflow-y-auto py-4 px-3">
                @foreach($this->menuItems as $group)
                    <div class="mb-6">
                        <h3
                            x-show="open"
                            x-transition
                            class="px-3 mb-2 text-xs font-semibold text-gray-500 uppercase tracking-wider"
                        >
                            {{ $group['section'] }}
                        </h3>

                        <div class="space-y-1">
                            @foreach($group['items'] as $item)
                                <button
                                    wire:click="navigateTo('{{ $item['key'] }}')"
                                    class="w-full flex items-center px-3 py-2.5 rounded-lg transition-all duration-200 group
                                        {{ $currentPage === $item['key']
                                            ? 'bg-purple-50 text-purple-700'
                                            : 'text-gray-700 hover:bg-gray-100' }}"
                                    title="{{ $item['label'] }}"
                                >
                                    <x-dynamic-component
                                        :component="'icons.' . $item['icon']"
                                        :class="'w-5 h-5 flex-shrink-0 ' . ($currentPage === $item['key'] ? 'text-purple-700' : 'text-gray-500 group-hover:text-gray-700')"
                                    />

                                    <span
                                        x-show="open"
                                        x-transition
                                        class="ml-3 font-medium text-sm"
                                    >
                                        {{ $item['label'] }}
                                    </span>
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </nav>

            <!-- Bottom Navigation -->
            <div class="border-t border-gray-200 p-3 space-y-1">
                @foreach($this->bottomMenuItems as $item)
                    <button
                        wire:click="navigateTo('{{ $item['key'] }}')"
                        class="w-full flex items-center px-3 py-2.5 rounded-lg transition-all duration-200 group
                            {{ $currentPage === $item['key']
                                ? 'bg-purple-50 text-purple-700'
                                : 'text-gray-700 hover:bg-gray-100' }}"
                        title="{{ $item['label'] }}"
                    >
                        <x-dynamic-component
                            :component="'icons.' . $item['icon']"
                            :class="'w-5 h-5 flex-shrink-0 ' . ($currentPage === $item['key'] ? 'text-purple-700' : 'text-gray-500 group-hover:text-gray-700')"
                        />

                        <span
                            x-show="open"
                            x-transition
                            class="ml-3 font-medium text-sm"
                        >
                            {{ $item['label'] }}
                        </span>
                    </button>
                @endforeach
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 overflow-x-hidden overflow-y-auto">
        <div class="container mx-auto px-6 py-8">
            @switch($currentPage)
                @case('home')
                    @livewire('dashboard.pages.home')
                    @break

                @case('brand-template')
                    @livewire('dashboard.pages.brand-template')
                    @break

                @case('resource-library')
                    @livewire('dashboard.pages.resource-library')
                    @break

                @case('calendar')
                    @livewire('dashboard.pages.calendar')
                    @break

                @case('social-accounts')
                    @livewire('dashboard.pages.social-accounts')
                    @break

                @case('profile')
                    @livewire('dashboard.pages.profile')
                    @break

                @case('help-center')
                    @livewire('dashboard.pages.help-center')
                    @break
                @case('video-creator')
                    @livewire('dashboard.pages.video-creator')
                    @break
                @case('credits')
                    @livewire('dashboard.pages.credits')
                    @break

                @case('settings')
                    @livewire('dashboard.pages.settings')
                    @break

                @default
                    @livewire('dashboard.pages.home')
            @endswitch
        </div>
    </main>
</div>
