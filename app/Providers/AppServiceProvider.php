<?php

namespace App\Providers;

use App\Order;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (App::environment('local', 'development')) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view) {
            $view->with(
                'assignCount',
                Order::where('assign_id', Auth::id())
                    ->where('status', '!=', 'finish')
                    ->count()
            );

            $view->with(
                'fromCount',
                Order::where('from_id', Auth::id())
                    ->where('status', '!=', 'finish')
                    ->count()
            );
        });
    }
}
