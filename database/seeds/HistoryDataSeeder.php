<?php

use App\HistoryData;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class HistoryDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\College::all() as $college) {
            HistoryData::create(array(
                'college' => $college->name,
                'collegeid' => $college->id,
                'actieve_assessors' => \App\Assessors::where('fk_college', $college->id)->where('status', 1)->count(),
                'assessors' => \App\Assessors::where('fk_college', $college->id)->get()->toJson()
            ));
        }
        foreach (\App\College::all() as $college) {
            HistoryData::create(array(
                'college' => $college->name,
                'collegeid' => $college->id,
                'actieve_assessors' => \App\Assessors::where('fk_college', $college->id)->where('status', 1)->count(),
                'assessors' => \App\Assessors::where('fk_college', $college->id)->get()->toJson(),
                'created_at' => Carbon::create(2016, 1, 1)->toDateTimeString(),
                'updated_at' => Carbon::create(2016, 1, 1)->toDateTimeString()
            ));
        }
        foreach (\App\College::all() as $college) {
            HistoryData::create(array(
                'college' => $college->name,
                'collegeid' => $college->id,
                'actieve_assessors' => \App\Assessors::where('fk_college', $college->id)->where('status', 1)->count(),
                'assessors' => \App\Assessors::where('fk_college', $college->id)->get()->toJson(),
                'created_at' => Carbon::create(2015, 1, 1)->toDateTimeString(),
                'updated_at' => Carbon::create(2015, 1, 1)->toDateTimeString()
            ));
        }
        foreach (\App\College::all() as $college) {
            HistoryData::create(array(
                'college' => $college->name,
                'collegeid' => $college->id,
                'actieve_assessors' => \App\Assessors::where('fk_college', $college->id)->where('status', 1)->count(),
                'assessors' => \App\Assessors::where('fk_college', $college->id)->get()->toJson(),
                'created_at' => Carbon::create(2014, 1, 1)->toDateTimeString(),
                'updated_at' => Carbon::create(2014, 1, 1)->toDateTimeString()
            ));
        }
    }
}
