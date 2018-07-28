<?php

use Illuminate\Database\Seeder;

use App\EtatProject;

class EtatProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EtatProject::create(['libelle' => "En cours d'etude"]);
        EtatProject::create(['libelle' => "Rejeté"]);
        EtatProject::create(['libelle' => "Suivi projet"]);
    }
}
