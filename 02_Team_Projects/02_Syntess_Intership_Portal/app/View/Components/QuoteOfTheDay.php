<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class QuoteOfTheDay extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $dayOfWeek = date('N');

        $quotes = [
            1 => "Code like you eat cookies: one line at a time, and sometimes, you need a break to debug.",
            2 => "Debugging is like being the detective in a crime movie where you are also the murderer.",
            3 => "Programmers don't die, they just byte.",
            4 => "I don't always test my code, but when I do, I do it in production.",
            5 => "Programmers never say 'it works', they say 'it compiles'.",
            6 => "Coding is a journey, not a destination. Enjoy the bugs along the way.",
            7 => "Keep calm and commit often. Every commit is a step towards a working program.",
        ];
        $this->quote = $quotes[$dayOfWeek];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.quote-of-the-day', [
            'quote' => $this->quote,
        ]);
    }
}
