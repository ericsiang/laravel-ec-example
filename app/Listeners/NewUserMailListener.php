<?php

namespace App\Listeners;

use App\Mail\NewUserMail;
use Illuminate\Support\Facades\Mail;
//use Illuminate\Queue\InteractsWithQueue;
//use Illuminate\Contracts\Queue\ShouldQueue;

class NewUserMailListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //sleep(10);
        //dd($event);
        Mail::to($event->customer->email)->send(new NewUserMail());
    }
}
