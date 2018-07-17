<?php

use Illuminate\Database\Seeder;

use App\Bayeur;

class BayeurTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bayeur::create([
        					'user_id' => 1
        ]);
    }
}
