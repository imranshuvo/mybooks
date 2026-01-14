<?php

namespace App\Providers;

use App\Listeners\SendLoginNotification;
use App\Listeners\SendPasswordChangedNotification;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register event listeners for notifications
        Event::listen(Login::class, SendLoginNotification::class);
        Event::listen(PasswordReset::class, SendPasswordChangedNotification::class);
    }
}
