<div>
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">{{ __('pages/brand-template.title') }}</h1>
        <p class="mt-2 text-gray-600">{{ __('pages/brand-template.subtitle') }}</p>
    </div>

    @if (session()->has('message'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow">
        <form wire:submit.prevent="saveBrandTemplate">
            <div class="p-6 space-y-6">
                <!-- Nom de la marque -->
                <div>
                    <label for="brandName" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('pages/brand-template.form.brand_name.label') }}
                    </label>
                    <input
                        type="text"
                        id="brandName"
                        wire:model="brandName"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                        placeholder="{{ __('pages/brand-template.form.brand_name.placeholder') }}"
                    >
                    @error('brandName')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Couleurs -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="primaryColor" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ __('pages/brand-template.form.primary_color.label') }}
                        </label>
                        <div class="flex items-center space-x-3">
                            <input
                                type="color"
                                id="primaryColor"
                                wire:model="primaryColor"
                                class="h-12 w-20 rounded border border-gray-300 cursor-pointer"
                            >
                            <input
                                type="text"
                                wire:model="primaryColor"
                                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                placeholder="#8B5CF6"
                            >
                        </div>
                    </div>

                    <div>
                        <label for="secondaryColor" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ __('pages/brand-template.form.secondary_color.label') }}
                        </label>
                        <div class="flex items-center space-x-3">
                            <input
                                type="color"
                                id="secondaryColor"
                                wire:model="secondaryColor"
                                class="h-12 w-20 rounded border border-gray-300 cursor-pointer"
                            >
                            <input
                                type="text"
                                wire:model="secondaryColor"
                                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                placeholder="#EC4899"
                            >
                        </div>
                    </div>
                </div>

                <!-- Aperçu -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('pages/brand-template.form.preview.label') }}
                    </label>
                    <div class="flex space-x-4">
                        <div
                            class="w-32 h-32 rounded-lg shadow-md flex items-center justify-center text-white font-semibold"
                            style="background-color: {{ $primaryColor }}"
                        >
                            {{ __('pages/brand-template.form.preview.primary') }}
                        </div>
                        <div
                            class="w-32 h-32 rounded-lg shadow-md flex items-center justify-center text-white font-semibold"
                            style="background-color: {{ $secondaryColor }}"
                        >
                            {{ __('pages/brand-template.form.preview.secondary') }}
                        </div>
                        <div
                            class="w-32 h-32 rounded-lg shadow-md flex items-center justify-center text-white font-semibold"
                            style="background: linear-gradient(135deg, {{ $primaryColor }} 0%, {{ $secondaryColor }} 100%)"
                        >
                            {{ __('pages/brand-template.form.preview.gradient') }}
                        </div>
                    </div>
                </div>

                <!-- Logo -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('pages/brand-template.form.logo.label') }}
                    </label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-purple-500 transition-colors cursor-pointer">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        <p class="mt-2 text-sm text-gray-600">{{ __('pages/brand-template.form.logo.drag_drop') }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ __('pages/brand-template.form.logo.file_types') }}</p>
                    </div>
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end space-x-3">
                <button
                    type="button"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors"
                >
                    {{ __('pages/brand-template.form.buttons.reset') }}
                </button>
                <button
                    type="submit"
                    class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors"
                >
                    {{ __('pages/brand-template.form.buttons.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
