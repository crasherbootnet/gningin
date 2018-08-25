<?php

use Illuminate\Database\Seeder;

use App\StatutProject;

class StatutProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatutProject::create(['libelle' => "fermé"]);
        StatutProject::create(['libelle' => "financé"]);
    }
}
