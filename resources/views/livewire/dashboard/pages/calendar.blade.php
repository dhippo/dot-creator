<div>
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">{{ __('pages/calendar.title') }}</h1>
        <p class="mt-2 text-gray-600">{{ __('pages/calendar.subtitle') }}</p>
    </div>

    <div class="bg-white rounded-lg shadow">
        <!-- Calendar Header -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold text-gray-900">
                    {{ \Carbon\Carbon::createFromDate($currentYear, $currentMonth, 1)->translatedFormat('F Y') }}
                </h2>
                <div class="flex space-x-2">
                    <button
                        wire:click="previousMonth"
                        class="p-2 rounded-lg hover:bg-gray-100 transition-colors"
                        aria-label="{{ __('pages/calendar.previous_month') }}"
                    >
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button
                        wire:click="nextMonth"
                        class="p-2 rounded-lg hover:bg-gray-100 transition-colors"
                        aria-label="{{ __('pages/calendar.next_month') }}"
                    >
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Calendar Grid -->
        <div class="p-6">
            <!-- Days of week -->
            <div class="grid grid-cols-7 gap-2 mb-2">
                @foreach(__('pages/calendar.days_of_week') as $day)
                    <div class="text-center text-sm font-semibold text-gray-600 py-2">
                        {{ $day }}
                    </div>
                @endforeach
            </div>

            <!-- Calendar days -->
            <div class="grid grid-cols-7 gap-2">
                @for($i = 1; $i <= 35; $i++)
                    <div class="aspect-square border border-gray-200 rounded-lg p-2 hover:bg-gray-50 transition-colors cursor-pointer">
                        @if($i <= 28)
                            <div class="text-sm font-medium text-gray-900">{{ $i }}</div>
                        @endif
                    </div>
                @endfor
            </div>
        </div>

        <!-- Empty State -->
        <div class="p-6 border-t border-gray-200">
            <div class="text-center text-gray-500">
                <p class="text-sm">{{ __('pages/calendar.no_publications') }}</p>
            </div>
        </div>
    </div>
</div>
