<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Event;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view) {
            if(auth()->check()) {

                $newCount = auth()->user()->notifications()->where('seen', '0')->orderBy('created_at', 'desc')->get();
                $newCount = count($newCount);

                $notifications = \Auth::user()->notifications()->orderBy('created_at', 'desc')->get();

                foreach($notifications as $notification) {
                    if($notification->seen == 0) {
                        $notification->class = 'notification-unseen';
                    }
                    $notification->event = Event::find($notification->object_id);
                }

                $view->with('notifications', $notifications)
                    ->with('newCount', $newCount);
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
