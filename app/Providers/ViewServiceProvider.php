<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Medias;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function($view){
            if(auth()->check())
            {
                $view->with('medias', Medias::where('user_id', auth()->user()->id)->first());
            }
        });
    }
}
