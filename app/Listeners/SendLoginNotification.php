<?php

namespace App\Listeners;

use App\Mail\LoginNotification;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Mail;

class SendLoginNotification
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
    public function handle(Login $event): void
    {
        $user = $event->user;
        $ipAddress = request()->ip() ?? 'Unknown';
        $userAgent = request()->userAgent() ?? 'Unknown';

        Mail::to('imrankhanshuvo@gmail.com')->send(
            new LoginNotification($user, $ipAddress, $userAgent)
        );
    }
}
