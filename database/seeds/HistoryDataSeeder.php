<?php

use Illuminate\Database\Seeder;
use App\HistoryData;
use Carbon\Carbon;

class HistoryDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HistoryData::create(array(
            'year' => Carbon::create(2014, 12, 31)->format('Y'),
            'actieve_assessors' => 30,
            'c_assessors' => 86,
            'c_colleges' => 3,
            'c_teamleaders' => 40,
            'c_teamleaders_in_colleges' => 50,
            'year_checked' => true,
            'log' => '{}',
        ));

        HistoryData::create(array(
            'year' => Carbon::create(2015, 12, 31)->format('Y'),
            'actieve_assessors' => 60,
            'c_assessors' => 75,
            'c_colleges' => 5,
            'c_teamleaders' => 55,
            'c_teamleaders_in_colleges' => 50,
            'year_checked' => true,
            'log' => '{}',
        ));

        HistoryData::create(array(
            'year' => Carbon::create(2016, 12, 31)->format('Y'),
            'actieve_assessors' => 90,
            'c_assessors' => 20,
            'c_colleges' => 13,
            'c_teamleaders' => 60,
            'c_teamleaders_in_colleges' => 50,
            'year_checked' => false,
            'log' => '{}',
        ));
    }
}
