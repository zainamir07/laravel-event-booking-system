<?php

namespace App\Providers;

use App\Models\Notification;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            $totalNotifications = Notification::orderBy('noti_id', 'desc')->where('noti_forId', '=', session()->get('user_id'))->where('noti_status', '=', 0)->count();
            $view->with('totalNotifications', $totalNotifications);
        });
    }
}
