<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\User::create([
            'name'=>'GETBUCKS',
            'email'=>'getbucks@getcash.co.zw',
            'password'=>bcrypt('3651')

        ]);
    }
}
