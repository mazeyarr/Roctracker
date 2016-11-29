<?php

use Illuminate\Database\Seeder;
use App\Teamleaders;

class TeamleadeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Teamleaders::create(array(
            'name' => 'Mazeyar Rezaei',
            'college_id' => 1
        ));

        Teamleaders::create(array(
            'name' => 'Thoby Visser',
            'college_id' => 2
        ));

        Teamleaders::create(array(
            'name' => 'Rob Hendrikx',
            'college_id' => 3
        ));

        Teamleaders::create(array(
            'name' => 'Jan Kooij'
        ));

        Teamleaders::create(array(
            'name' => 'Pieter Henks'
        ));

        Teamleaders::create(array(
            'name' => 'Chantal Jansen'
        ));
    }
}
