<?php

use Illuminate\Database\Seeder;
use App\College;

class CollegeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        College::create(array(
            'name' => 'Business College',
            'location' => 'Keizerinmarialaan 5',
            'log' => '{}'
        ));

        College::create(array(
            'name' => 'Zorg en Welzijn',
            'location' => 'Keizerinmarialaan 5',
            'log' => '{}'
        ));

        College::create(array(
            'name' => 'Dienstverlening',
            'location' => 'Keizerinmarialaan 5',
            'log' => '{}'
        ));

        College::create(array(
            'name' => 'ICT College',
            'location' => 'Keizerinmarialaan 5',
            'log' => '{}'
        ));

        College::create(array(
            'name' => 'Administratie College',
            'location' => 'Keizerinmarialaan 5',
            'log' => '{}'
        ));
    }
}
