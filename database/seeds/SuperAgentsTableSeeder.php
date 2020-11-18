<?php

use Illuminate\Database\Seeder;

class SuperAgentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=3816;$i<=3829;$i++){
            \App\SuperAgent::create([
                'email'=>'getbucks@getcash.co.zw',
                'name'=>'GETBUCKS',
                'agent_number'=>$i
            ]);

        }
    }
}
