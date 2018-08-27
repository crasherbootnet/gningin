<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class Register extends DuskTestCase
{

    // use DatabaseMigrations;
    
    /**
     * A Dusk test example.
     * @test
     * @return void
     */
    public function test_get_login()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->assertSee('Login')
                    ->assertSee('Forgot Your Password')
                    ->type('email', 'ong@yopmail.com')
                    ->type('password', 'ong')
                    ->press('Login')
                    ->assertPathIs('/ongs');
        });
    }
}
