<div>
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">{{ __('pages/resource-library.title') }}</h1>
        <p class="mt-2 text-gray-600">{{ __('pages/resource-library.subtitle') }}</p>
    </div>

    <!-- Toolbar -->
    <div class="bg-white rounded-lg shadow mb-6 p-4">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0">
            <!-- Search -->
            <div class="flex-1 max-w-md">
                <div class="relative">
                    <input
                        type="text"
                        wire:model.live.debounce.300ms="search"
                        placeholder="{{ __('pages/resource-library.search_placeholder') }}"
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                    >
                    <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>

            <!-- Filters -->
            <div class="flex items-center space-x-3">
                <select
                    wire:model.live="filter"
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                >
                    <option value="all">{{ __('pages/resource-library.filters.all') }}</option>
                    <option value="images">{{ __('pages/resource-library.filters.images') }}</option>
                    <option value="videos">{{ __('pages/resource-library.filters.videos') }}</option>
                    <option value="audio">{{ __('pages/resource-library.filters.audio') }}</option>
                </select>

                <button class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    {{ __('pages/resource-library.add_button') }}
                </button>
            </div>
        </div>
    </div>

    <!-- Empty State -->
    <div class="bg-white rounded-lg shadow p-12 text-center">
        <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
            </svg>
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ __('pages/resource-library.empty_state.title') }}</h3>
        <p class="text-gray-600 mb-6">{{ __('pages/resource-library.empty_state.description') }}</p>
        <button class="px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
            {{ __('pages/resource-library.empty_state.cta') }}
        </button>
    </div>
</div>
