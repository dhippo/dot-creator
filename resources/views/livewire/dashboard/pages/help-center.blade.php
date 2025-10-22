<div>
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">{{ __('pages/help-center.title') }}</h1>
        <p class="mt-2 text-gray-600">{{ __('pages/help-center.subtitle') }}</p>
    </div>

    <!-- Search -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <div class="relative">
            <input
                type="text"
                placeholder="{{ __('pages/help-center.search_placeholder') }}"
                class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-lg"
            >
            <svg class="absolute left-4 top-3.5 h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
    </div>

    <!-- FAQ Categories -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow cursor-pointer">
            <div class="flex items-start">
                <div class="p-3 bg-purple-100 rounded-lg">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ __('pages/help-center.categories.quick_start.title') }}</h3>
                    <p class="text-gray-600 text-sm">{{ __('pages/help-center.categories.quick_start.description') }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow cursor-pointer">
            <div class="flex items-start">
                <div class="p-3 bg-blue-100 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ __('pages/help-center.categories.settings.title') }}</h3>
                    <p class="text-gray-600 text-sm">{{ __('pages/help-center.categories.settings.description') }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow cursor-pointer">
            <div class="flex items-start">
                <div class="p-3 bg-green-100 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ __('pages/help-center.categories.billing.title') }}</h3>
                    <p class="text-gray-600 text-sm">{{ __('pages/help-center.categories.billing.description') }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition-shadow cursor-pointer">
            <div class="flex items-start">
                <div class="p-3 bg-orange-100 rounded-lg">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ __('pages/help-center.categories.tutorials.title') }}</h3>
                    <p class="text-gray-600 text-sm">{{ __('pages/help-center.categories.tutorials.description') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Support -->
    <div class="mt-8 bg-gradient-to-r from-purple-600 to-pink-600 rounded-lg shadow-lg p-8 text-center text-white">
        <h3 class="text-2xl font-bold mb-2">{{ __('pages/help-center.contact.title') }}</h3>
        <p class="mb-6 opacity-90">{{ __('pages/help-center.contact.description') }}</p>
        <button class="px-6 py-3 bg-white text-purple-600 rounded-lg hover:bg-gray-100 transition-colors font-semibold">
            {{ __('pages/help-center.contact.button') }}
        </button>
    </div>
</div>
