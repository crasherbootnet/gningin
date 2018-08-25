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
                        'email' => 'bayeur@yopmail.com',
                        'password' => bcrypt('bayeur'),
                        'active' => 1,
                        'is_bayeur' => 1
                    ]);

        // creation de l'utilisateur ong
        User::create([
                        'name' => 'ong',
                        'email' => 'ong@yopmail.com',
                        'password' => bcrypt('ong'),
                        'active' => 1,
                        'is_ong' => 1
                    ]);
    }
}
