<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Project;
use App\ProjectHistorisation;
class ProviderProjectHistorisation extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        /*
        *  Lors de la creation d'une historisation on desactive le mode
        *  modification du project.
        */
        ProjectHistorisation::created(function($projecthistorisation){
            $projecthistorisation->project
                                 ->update(['is_modification' => 0]);
            //dd($projecthistorisation->project);
        }); 
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
