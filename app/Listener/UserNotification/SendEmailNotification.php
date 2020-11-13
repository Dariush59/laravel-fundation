<?php

namespace App\Listener\UserNotification;

use App\Events\UserAttached;
use App\Mail\UserAccount;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserAttached  $event
     * @return void
     */
    public function handle(UserAttached $event)
    {
        Mail::to($event->user->email)->send(new UserAccount($event->user));
    }
}
