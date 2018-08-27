<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Project;
use Laravel\Dusk\Browser;

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
        });
        Browser::macro('waitForReload', function () {
            $this->script("window.duskPageIsStale = {}");
            return $this->waitUntil("return typeof window.duskPageIsStale === 'undefined';");
        });

        Browser::macro('scrollTo', function($selector) {
            $this->driver->executeScript("$(\"html, body\").animate({scrollTop: $(\"$selector\").offset().top}, 0);");
            return $this;
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
