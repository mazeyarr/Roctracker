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
            'year' => Carbon::create(2014, 12, 31),
            'actieve_assessors' => 50,
            'c_assessors' => 60,
            'c_colleges' => 7,
            'c_teamleaders' => 50,
            'c_teamleaders_in_colleges' => 50,
            'year_checked' => true,
            'log' => '{}',
        ));

        HistoryData::create(array(
            'year' => Carbon::create(2015, 12, 31),
            'actieve_assessors' => 50,
            'c_assessors' => 60,
            'c_colleges' => 7,
            'c_teamleaders' => 50,
            'c_teamleaders_in_colleges' => 50,
            'year_checked' => true,
            'log' => '{}',
        ));

        HistoryData::create(array(
            'year' => Carbon::create(2016, 12, 31),
            'actieve_assessors' => 50,
            'c_assessors' => 60,
            'c_colleges' => 7,
            'c_teamleaders' => 50,
            'c_teamleaders_in_colleges' => 50,
            'year_checked' => false,
            'log' => '{}',
        ));
    }
}
