<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\Log;

use Config;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        $app['config']->set('database.default', 'database.sqlite');

        // Config::set('database.connections.mysql.database');
        // Config::set('database.connections.mysql.database', '');
        Config::set('database.connections.sqlite_testing.database', 'database.sqlite');
        Log::debug('name database => ' . Config::get('database.default'));

        return $app;
    }
}
