<?php

use Illuminate\Database\Seeder;

use DB;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        							'name' => 'dsdbhsbdh',
        							'email' => 'fbhsbdhbqs@gmail.com',
        							'password' => 'bdhqsbdhsq'
        						]);
    }
}
