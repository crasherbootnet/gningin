<?php

use Illuminate\Database\Seeder;
//use Illuminate\Database\Seeder\UsersTableSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
        				UsersTableSeeder::class,
        				BayeurTableSeeder::class,
        				OngTableSeeder::class,
                        ProjectTableSeeder::class,
                        CategorieTaleSeeder::class,
                        EtatProjectTableSeeder::class,
        ]);
    }
}
