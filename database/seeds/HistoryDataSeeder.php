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
        foreach (\App\College::all() as $college) {
            HistoryData::create(array(
                'college' => $college->name,
                'actieve_assessors' => \App\Assessors::where('fk_college', $college->id)->where('status', 1)->count(),
                'assessors' => \App\Assessors::where('fk_college', $college->id)->get()->toJson()
            ));
        }
    }
}
