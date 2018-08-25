<?php

namespace App\Utilities;

class DeepFactory{

	/* retourne une instance de la classe passée en parametre */
	public static function getInstance($classe_name)
	{
		$classe_name = "\\App\\".ucfirst($classe_name);
		return new $classe_name;
	}
}