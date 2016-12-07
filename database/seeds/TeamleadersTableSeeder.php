<?php

use Illuminate\Database\Seeder;
use App\Teamleaders;

class TeamleadersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Teamleaders::create(array(
            'name' => 'Pieter Henks',
            'log' => '{}'
        ));

        Teamleaders::create(array(
            'name' => 'Chantal Jansen',
            'log' => '{}'
        ));

        Teamleaders::create(array(
            'name' => 'Jay Pietermalen',
            'log' => '{}'
        ));

        Teamleaders::create(array(
            'name' => 'Wouter Bos',
            'log' => '{}'
        ));

        Teamleaders::create(array(
            'name' => 'Mark Rutte',
            'log' => '{}'
        ));

        Teamleaders::create(array(
            'name' => 'Barack Obama',
            'log' => '{}'
        ));
    }
}
