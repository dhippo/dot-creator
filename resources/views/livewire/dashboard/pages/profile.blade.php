<div>
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">{{ __('pages/profile.title') }}</h1>
        <p class="mt-2 text-gray-600">{{ __('pages/profile.subtitle') }}</p>
    </div>

    <div class="bg-white rounded-lg shadow p-8 text-center">
        <div class="mx-auto w-24 h-24 bg-purple-100 rounded-full flex items-center justify-center mb-4">
            <svg class="w-12 h-12 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ auth()->user()->name }}</h3>
        <p class="text-gray-600 mb-6">{{ auth()->user()->email }}</p>

        <button
            wire:click="redirectToJetstreamProfile"
            class="px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors"
        >
            {{ __('pages/profile.edit_button') }}
        </button>
    </div>
</div>
