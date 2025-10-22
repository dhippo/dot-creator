<div>
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">{{ __('pages/credits.title') }}</h1>
        <p class="mt-2 text-gray-600">{{ __('pages/credits.subtitle') }}</p>
    </div>

    <!-- Current Credits -->
    <div class="bg-gradient-to-br from-purple-600 to-pink-600 rounded-lg shadow-lg p-8 mb-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-purple-100 mb-2">{{ __('pages/credits.current.available') }}</p>
                <h2 class="text-5xl font-bold">1</h2>
                <p class="text-purple-100 mt-2">{{ __('pages/credits.current.download_credit') }}</p>
            </div>
            <div class="w-24 h-24 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Credit Plans -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Starter Pack -->
        <div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow p-6 border-2 border-gray-200">
            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ __('pages/credits.plans.starter.name') }}</h3>
            <div class="mb-4">
                <span class="text-4xl font-bold text-gray-900">5€</span>
                <span class="text-gray-600">/5 {{ __('pages/credits.plans.starter.credits') }}</span>
            </div>
            <ul class="space-y-3 mb-6">
                <li class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ __('pages/credits.plans.starter.features.downloads', ['count' => 5]) }}
                </li>
                <li class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ __('pages/credits.plans.starter.features.quality_hd') }}
                </li>
                <li class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ __('pages/credits.plans.starter.features.validity', ['days' => 30]) }}
                </li>
            </ul>
            <button class="w-full px-4 py-3 border-2 border-purple-600 text-purple-600 rounded-lg hover:bg-purple-50 transition-colors font-semibold">
                {{ __('pages/credits.buy_button') }}
            </button>
        </div>

        <!-- Pro Pack -->
        <div class="bg-white rounded-lg shadow-lg p-6 border-2 border-purple-600 relative transform scale-105">
            <div class="absolute top-0 right-0 bg-purple-600 text-white px-3 py-1 rounded-bl-lg rounded-tr-lg text-sm font-semibold">
                {{ __('pages/credits.plans.pro.badge') }}
            </div>
            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ __('pages/credits.plans.pro.name') }}</h3>
            <div class="mb-4">
                <span class="text-4xl font-bold text-gray-900">15€</span>
                <span class="text-gray-600">/20 {{ __('pages/credits.plans.pro.credits') }}</span>
            </div>
            <ul class="space-y-3 mb-6">
                <li class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ __('pages/credits.plans.pro.features.downloads', ['count' => 20]) }}
                </li>
                <li class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ __('pages/credits.plans.pro.features.quality_hd') }}
                </li>
                <li class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ __('pages/credits.plans.pro.features.validity', ['days' => 60]) }}
                </li>
                <li class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ __('pages/credits.plans.pro.features.priority_support') }}
                </li>
            </ul>
            <button class="w-full px-4 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors font-semibold">
                {{ __('pages/credits.buy_button') }}
            </button>
        </div>

        <!-- Business Pack -->
        <div class="bg-white rounded-lg shadow hover:shadow-lg transition-shadow p-6 border-2 border-gray-200">
            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ __('pages/credits.plans.business.name') }}</h3>
            <div class="mb-4">
                <span class="text-4xl font-bold text-gray-900">40€</span>
                <span class="text-gray-600">/60 {{ __('pages/credits.plans.business.credits') }}</span>
            </div>
            <ul class="space-y-3 mb-6">
                <li class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ __('pages/credits.plans.business.features.downloads', ['count' => 60]) }}
                </li>
                <li class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ __('pages/credits.plans.business.features.quality_4k') }}
                </li>
                <li class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ __('pages/credits.plans.business.features.validity', ['days' => 90]) }}
                </li>
                <li class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ __('pages/credits.plans.business.features.priority_support') }}
                </li>
            </ul>
            <button class="w-full px-4 py-3 border-2 border-purple-600 text-purple-600 rounded-lg hover:bg-purple-50 transition-colors font-semibold">
                {{ __('pages/credits.buy_button') }}
            </button>
        </div>
    </div>

    <!-- Transaction History -->
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-900">{{ __('pages/credits.history.title') }}</h2>
        </div>
        <div class="p-6">
            <div class="text-center text-gray-500 py-8">
                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <p>{{ __('pages/credits.history.empty') }}</p>
            </div>
        </div>
    </div>
</div>
