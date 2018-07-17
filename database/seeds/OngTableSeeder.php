<?php

use Illuminate\Database\Seeder;

use App\Ong;

class OngTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ong::create([
        				'user_id' => 2,
        				'bayeur_id' => 1
        ]);
    }
}
