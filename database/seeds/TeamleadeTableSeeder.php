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
            'college_id' => 1,
            'email' => 'test1@email.com'
        ));

        Teamleaders::create(array(
            'name' => 'Thoby Visser',
            'college_id' => 2,
            'email' => 'test2@email.com'
        ));

        Teamleaders::create(array(
            'name' => 'Rob Hendrikx',
            'college_id' => 3,
            'email' => 'test3@email.com'
        ));

        Teamleaders::create(array(
            'name' => 'Jan Kooij',
            'email' => 'testJan@email.com'
        ));

        Teamleaders::create(array(
            'name' => 'Pieter Henks',
            'email' => 'testPieter@email.com'
        ));

        Teamleaders::create(array(
            'name' => 'Chantal Jansen',
            'email' => 'testChantal@email.com'
        ));
    }
}
