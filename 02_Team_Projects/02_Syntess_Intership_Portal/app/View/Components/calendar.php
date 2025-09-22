<?php

namespace App\View\Components;

use App\Models\Interview;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class calendar extends Component
{
    public $currentMonth;
    public $dates;
    public $nextMonths;
    public $highlightedDates;

    public function __construct()
    {
        $this->currentMonth = now()->format('F');
        $start = Carbon::parse($this->currentMonth)->startOfMonth()->startOfWeek();
        $end = Carbon::parse($this->currentMonth)->endOfMonth()->endOfWeek();

        $this->dates = CarbonPeriod::create($start, $end);

        $this->nextMonths = [];

        for ($i = 1; $i <= 2; $i++) {
            $nextMonth = now()->addMonths($i)->format('F');
            $nextStart = Carbon::parse($nextMonth)->startOfMonth()->startOfWeek();
            $nextEnd = Carbon::parse($nextMonth)->endOfMonth()->endOfWeek();

            $dates = CarbonPeriod::create($nextStart, $nextEnd);

            $this->nextMonths[] = [
                'month' => $nextMonth,
                'dates' => $dates,
            ];
        }

        $user = Auth::user();
        if ($user->role_id == 1) {
            $this->highlightedDates = Interview::whereBetween('date', [$start, $end])
                ->pluck('date')
                ->toArray();
        } elseif ($user->role_id == 2) {
            $this->highlightedDates = Interview::where('mentor_id', $user->id)
                ->whereBetween('date', [$start, $end])
                ->pluck('date')
                ->toArray();
        } elseif ($user->role_id == 4) {
            $this->highlightedDates = Interview::where('candidate_id', $user->id)
                ->whereBetween('date', [$start, $end])
                ->pluck('date')
                ->toArray();
        }
    }

    public function render()
    {
        return view('components.calendar', [
            'highlightedDates' => $this->highlightedDates,
        ]);
    }
}
