<div>
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">{{ __('pages/video-creator.title') }}</h1>
        <p class="mt-2 text-gray-600">{{ __('pages/video-creator.subtitle') }}</p>
    </div>

    @if (session()->has('message'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
            {{ session('message') }}
        </div>
    @endif

    <!-- Video Simulator - iframe -->
    <div class="bg-white rounded-lg shadow mb-6 overflow-hidden">
        <iframe
            src="{{ route('video-simulator') }}"
            class="w-full border-0"
            style="height: calc(100vh - 250px); min-height: 700px;"
            title="Video Simulator"
        ></iframe>
    </div>

    <!-- Action Buttons -->
    <div class="flex justify-between items-center">
        <div class="text-sm text-gray-600">
            <span class="font-medium">{{ __('pages/video-creator.credits.label') }}:</span>
            <span class="text-purple-600 font-bold">1</span> {{ __('pages/video-creator.credits.available') }}
        </div>

        <div class="flex space-x-3">
            <button
                wire:click="cancel"
                class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium"
            >
                {{ __('pages/video-creator.buttons.cancel') }}
            </button>

            <button
                wire:click="save"
                class="px-6 py-2.5 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors font-medium"
            >
                {{ __('pages/video-creator.buttons.save') }}
            </button>

            <button
                disabled
                class="px-6 py-2.5 bg-gray-300 text-gray-500 rounded-lg cursor-not-allowed font-medium opacity-60"
                title="{{ __('pages/video-creator.buttons.publish_disabled_tooltip') }}"
            >
                {{ __('pages/video-creator.buttons.publish') }}
            </button>
        </div>
    </div>
</div>
