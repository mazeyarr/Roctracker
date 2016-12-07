<?php

use Illuminate\Database\Seeder;
use App\TiC;

class TeamleadersInCollegeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TiC::create(array(
            'fk_teamleader' => 1,
            'fk_college' => 1
        ));

        TiC::create(array(
            'fk_teamleader' => 1,
            'fk_college' => 2
        ));

        TiC::create(array(
            'fk_teamleader' => 2,
            'fk_college' => 3
        ));

        TiC::create(array(
            'fk_teamleader' => 3,
            'fk_college' => 4
        ));

        TiC::create(array(
            'fk_teamleader' => 4,
            'fk_college' => 5
        ));
    }
}
