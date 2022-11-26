<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Medias;
use App\Models\User;
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
        // Send Medias Collection to all application view
        View::composer('*', function($view){
            if(auth()->check())
            {
                $view->with('medias', Medias::with('user', 'mediable')->where('mediable_type', User::class)->where('mediable_id', auth()->user()->id)->first());
            }
            else {
                $view->with('medias', null);
            }
        });
    }
}
