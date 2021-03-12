<?php

namespace App\Providers;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        if ( env('APP_MODE') == 'STAGE' ) {
            //View::composer(['telescope::layout'], function ($view) { $view->with('telescopeScriptVariables', [ 'path' => 'securtac/telescope', 'timezone' => config('app.timezone'), 'recording' => ! cache('telescope:pause-recording'), ]); });    
        }
    }
}
