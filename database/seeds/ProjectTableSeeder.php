<?php

use Illuminate\Database\Seeder;

use App\Project;
class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::create([
                            //"bayeur_id" => 1,
                            "ong_id" => 1,
                            "libelle" => "bqsbdhqs",
                            "date_debut" => "2018-01-01",
                            "date_fin" => "2018-01-01",
                            "short_code" => "qsdqsvdgqs",
                            "type_project_id" => 1
                        ]);
    }
}

