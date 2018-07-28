<?php

use Illuminate\Database\Seeder;

use App\Categorie;

class CategorieTaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$categories = ["Context","Justificatif","Objectifs","Cible","Resultats",
    					"Composante", "Methodologie", "hypothèse", "Activités", "Cadre Logique",
    					"Plan d'exécution du projet", "Budget", "Fiche Synoptique"];
    	foreach ($categories as $categorie) {
    		Categorie::create([
	   			"libelle" => $categorie,
	   			"active" => 1
	   		]);
		/*Categorie::create([
   			"libelle" => "Context",
   			"active" => 1
   		]);	

   		Categorie::create([
   			"libelle" => "Justificatif",
   			"active" => 1
   		]);

   		Categorie::create([
   			"libelle" => "Objectifs",
   			"active" => 1
   		]);	*/
    	}
    }
}
