<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Project;

class ProviderProject extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        /*Project::created(function($projecthistorisation){
            dd($projecthistorisation);
        });*/
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
