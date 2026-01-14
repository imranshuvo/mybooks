<?php

namespace App\Listeners;

use App\Mail\PasswordChangedNotification;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Mail;

class SendPasswordChangedNotification
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
    public function handle(PasswordReset $event): void
    {
        $user = $event->user;

        Mail::to('imrankhanshuvo@gmail.com')->send(
            new PasswordChangedNotification($user)
        );
    }
}
