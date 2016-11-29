<?php

use Illuminate\Database\Seeder;
use App\Colleges;

class CollegeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Colleges::create(array(
            'name' => 'ICT Collage',
            'location' => 'Julianalaan 12',
            'teamleader_id' => 1,
        ));

        Colleges::create(array(
            'name' => 'Zorg & Welzijn',
            'location' => 'Keizerinmarialaan 14',
            'teamleader_id' => 2,
        ));

        Colleges::create(array(
            'name' => 'Business Collage',
            'location' => 'Keizerinmarialaan 14',
            'teamleader_id' => 3,
        ));
    }
}
