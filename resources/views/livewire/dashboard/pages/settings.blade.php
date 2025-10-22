<div>
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">{{ __('pages/settings.title') }}</h1>
        <p class="mt-2 text-gray-600">{{ __('pages/settings.subtitle') }}</p>
    </div>

    <div class="space-y-6">
        <!-- Language Settings -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-900">{{ __('pages/settings.language.title') }}</h2>
                <p class="text-sm text-gray-600 mt-1">{{ __('pages/settings.language.description') }}</p>
            </div>
            <div class="p-6">
                <form action="{{ route('lang.switch') }}" method="POST">
                    @csrf
                    <div class="flex items-center justify-between">
                        <div>
                            <label for="locale" class="text-sm font-medium text-gray-700 block mb-1">
                                {{ __('pages/settings.language.label') }}
                            </label>
                            <p class="text-sm text-gray-500">
                                {{ __('pages/settings.language.help') }}
                            </p>
                        </div>
                        <select
                            name="locale"
                            id="locale"
                            onchange="this.form.submit()"
                            class="border border-gray-300 bg-white text-gray-900 px-4 py-2 text-sm rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                        >
                            <option value="fr" {{ app()->getLocale() == 'fr' ? 'selected' : '' }}>
                                🇫🇷 Français
                            </option>
                            <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>
                                🇬🇧 English
                            </option>
                        </select>
                    </div>
                </form>
            </div>
        </div>

        <!-- Account Settings -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-900">{{ __('pages/settings.account.title') }}</h2>
                <p class="text-sm text-gray-600 mt-1">{{ __('pages/settings.account.description') }}</p>
            </div>
            <div class="p-6 space-y-4">
                <!-- User Info -->
                <div class="flex items-center justify-between py-3 border-b border-gray-200">
                    <div>
                        <p class="text-sm font-medium text-gray-700">{{ __('pages/settings.account.user_info') }}</p>
                        <p class="text-sm text-gray-500 mt-1">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-400">{{ auth()->user()->email }}</p>
                    </div>
                    <a
                    href="{{ route('profile.show') }}"
                    class="px-4 py-2 text-sm border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors"
                    >
                    {{ __('pages/settings.account.edit_profile') }}
                    </a>
                </div>

                <!-- Logout -->
                <div class="flex items-center justify-between py-3">
                    <div>
                        <p class="text-sm font-medium text-gray-700">{{ __('pages/settings.account.logout.title') }}</p>
                        <p class="text-sm text-gray-500 mt-1">{{ __('pages/settings.account.logout.description') }}</p>
                    </div>
                    <button
                        wire:click="logout"
                        wire:confirm="{{ __('pages/settings.account.logout.confirm') }}"
                        class="px-4 py-2 text-sm bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors"
                    >
                        {{ __('pages/settings.account.logout.button') }}
                    </button>
                </div>
            </div>
        </div>

        <!-- Notifications Settings -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-900">{{ __('pages/settings.notifications.title') }}</h2>
                <p class="text-sm text-gray-600 mt-1">{{ __('pages/settings.notifications.description') }}</p>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-700">{{ __('pages/settings.notifications.email.label') }}</p>
                        <p class="text-sm text-gray-500 mt-1">{{ __('pages/settings.notifications.email.description') }}</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-purple-600"></div>
                    </label>
                </div>

                <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                    <div>
                        <p class="text-sm font-medium text-gray-700">{{ __('pages/settings.notifications.creation.label') }}</p>
                        <p class="text-sm text-gray-500 mt-1">{{ __('pages/settings.notifications.creation.description') }}</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-purple-600"></div>
                    </label>
                </div>
            </div>
        </div>

        <!-- Danger Zone -->
        <div class="bg-white rounded-lg shadow border-2 border-red-200">
            <div class="p-6 border-b border-red-200 bg-red-50">
                <h2 class="text-xl font-bold text-red-900">{{ __('pages/settings.danger_zone.title') }}</h2>
                <p class="text-sm text-red-700 mt-1">{{ __('pages/settings.danger_zone.description') }}</p>
            </div>
            <div class="p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-900">{{ __('pages/settings.danger_zone.delete_account.title') }}</p>
                        <p class="text-sm text-gray-600 mt-1">
                            {{ __('pages/settings.danger_zone.delete_account.description') }}
                        </p>
                    </div>
                    <a
                    href="{{ route('profile.show') }}"
                    class="px-4 py-2 text-sm bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors"
                    >
                    {{ __('pages/settings.danger_zone.delete_account.button') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
