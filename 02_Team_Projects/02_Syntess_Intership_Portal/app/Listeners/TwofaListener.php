<?php

namespace App\Listeners;

use App\Events\TwofaEvent;
use App\Mail\TwofaCode;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class TwofaListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TwofaEvent $event): void
    {
        Mail::to($event->email)->send(new TwofaCode($event->code));
    }
}
