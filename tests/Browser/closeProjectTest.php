<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use App\Project;

class closeProjectTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     * @test
     * @return void
     */
    public function testInit()
    {

        // create a instance of project
        $project = new Project;

        $this->browse(function (Browser $browser){

            $browser->screenshot('maximise');
            $browser->visit('/login')
                    ->assertSee('Login')
                    ->type('email', 'ong@yopmail.com')
                    ->type('password', 'ong')
                    ->press('Login');

                   /*$browser->click('.btn-loader')
                    ->type('libelle', 'qsdsqdqsdvdg')
                    ->select('type_projet', 1)
                    ->click('#btn-Context')
                    ->click('#btn-Justificatif')
                    ->script([
                        "document.querySelector('#date_fin').value = '2017-02-23'",
                        "document.querySelector('#date_debut').value = '2017-02-23'",
                    ]);

                    $browser->script('window.scrollTo(0, 600);');
                    $browser->press('#btn-create-project');*/

                    // recuperation d'un project

        
        });
    }

    /**
     * @test
     * @return void
     */
    public function testVisitDashboardProject()
    {

        // create a instance of project
        // $project = new Project;

        $this->browse(function (Browser $browser)  {

            // recuperation d'un project
            // $project = $project->where('short_code', 'qsdsqvdg')->first();

            $browser->visit('/ongs')
                    // ->click('.btn-project-qsdsqvdg')
            ;
            dd("dd");
        
        });
    }
}
