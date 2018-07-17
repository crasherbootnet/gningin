<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // creation de l'utilisateur bayeur
        User::create([
                        'name' => 'bayeur',
                        'email' => 'bayeur@gmail.com',
                        'password' => bcrypt('bayeur'),
                        'active' => 0,
                        'is_bayeur' => 1
                    ]);

        // creation de l'utilisateur ong
        User::create([
                        'name' => 'ong',
                        'email' => 'ong@gmail.com',
                        'password' => bcrypt('ong'),
                        'active' => 0,
                        'is_ong' => 1
                    ]);
    }
}
