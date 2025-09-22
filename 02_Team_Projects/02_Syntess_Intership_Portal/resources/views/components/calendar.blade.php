<div class="flex flex-wrap">
    <!-- Current Month Calendar -->
    <div class="bg-white rounded-lg shadow-xl overflow-hidden w-full mb-5">
        <div class="text-center py-4 px-6 bg-purple-500 text-white">
            <span class="text-lg font-bold">{{ $currentMonth }}</span>
            <span class="ml-1 text-lg">{{ date('Y') }}</span>
        </div>
        <div class="grid grid-cols-7 gap-1 p-2">
            @foreach($dates as $date)
                <div class="flex items-center justify-center h-8">
        <span class="text-sm
            @if($date->isToday())
                bg-purple-500 text-white rounded-full w-7 h-7 flex items-center justify-center
            @elseif(!is_null($highlightedDates) && in_array($date->format('Y-m-d'), $highlightedDates))
                bg-purple-200 text-black rounded-full w-7 h-7 flex items-center justify-center
            @else
                text-cool-gray-500
            @endif">
            {{ $date->day }}
        </span>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Next Months Calendars -->
    <div class="flex w-full space-x-5">
        @foreach($nextMonths as $nextMonth)
            <div class="bg-white rounded-lg shadow-xl overflow-hidden flex-1">
                <div>
                    <div class="text-center py-2 px-4 bg-purple-500 text-white rounded-t-lg">
                        <span class="text-sm font-bold">{{ $nextMonth['month'] }}</span>
                        <span class="block text-xs">{{ date('Y') }}</span>
                    </div>
                    <div class="grid grid-cols-7 gap-1 p-2">
                        @foreach($nextMonth['dates'] as $date)
                            <div class="flex items-center justify-center h-8">
                        <span class="text-sm
                            @if(!is_null($highlightedDates) && in_array($date->format('Y-m-d'), $highlightedDates))
                                bg-purple-200 text-black rounded-full w-7 h-7 flex items-center justify-center
                            @else
                                text-cool-gray-500
                            @endif">
                            {{ $date->day }}
                        </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
