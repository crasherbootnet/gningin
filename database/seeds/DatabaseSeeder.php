<?php

use Illuminate\Database\Seeder;
//use Illuminate\Database\Seeder\UsersTableSeeder;
use App\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       //$this->call(UsersTableSeeder::class);
    	User::create([
    					'name' => 'dsdbhsbdh',
						'email' => 'fbhsbdhbqs@gmail.com',
						'password' => 'bdhqsbdhsq',
						'admin' => 1,
						'active' => 0,
					]);
    }
}
