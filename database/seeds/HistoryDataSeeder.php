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
            'actieve_assessors' => 600,
            'assessor_data' => trim(preg_replace('/\s\s+/', ' ','
            {
                "data": [
                {
                    "label": "Zorg en Welzijn",
                  "data": 10,
                  "value": 50,
                  "color": "#00FFFF"
                },
                {
                    "label": "Business College",
                  "data": 1,
 
            {
                "data": [
                {
                    "label": "Zorg en Welzijn",
                  "data": 10,
                  "value": 50,
                  "color": "#00FFFF"
                },
                {
                    "label": "Business College",
                  "data": 1,
                  "value": 20,
                  "color": "#00FFAA"
                },
                {
                    "label": "ICT College",
                  "data": 3,
                  "value": 40,
                  "color": "#ffb300"
                },
                {
                    "label": "Dienstverlening",
                  "data": 1,
                  "value": 25,
                  "color": "#8e24aa"
                }
              ]
            }
                        "value": 20,
                  "color": "#00FFAA"
                },
                {
                    "label": "ICT College",
                  "data": 3,
                  "value": 40,
                  "color": "#ffb300"
                },
                {
                    "label": "Dienstverlening",
                  "data": 1,
                  "value": 25,
                  "color": "#8e24aa"
                }
              ]
            }
        ')),
            'c_assessors' => 86,
            'c_colleges' => 3,
            'c_teamleaders' => 40,
            'c_teamleaders_in_colleges' => 50,
            'year_checked' => true,
            'log' => '{}',
        ));

        HistoryData::create(array(
            'year' => Carbon::create(2015, 12, 31)->format('Y'),
            'actieve_assessors' => 300,
            'assessor_data' => trim(preg_replace('/\s\s+/', ' ','
            {
                "data": [
                {
                    "label": "Zorg en Welzijn",
                  "data": 10,
                  "value": 50,
                  "color": "#00FFFF"
                },
                {
                    "label": "Business College",
                  "data": 1,

            {
                "data": [
                {
                    "label": "Zorg en Welzijn",
                  "data": 10,
                  "value": 50,
                  "color": "#00FFFF"
                },
                {
                    "label": "Business College",
                  "data": 1,
                  "value": 20,
                  "color": "#00FFAA"
                },
                {
                    "label": "ICT College",
                  "data": 3,
                  "value": 40,
                  "color": "#ffb300"
                },
                {
                    "label": "Dienstverlening",
                  "data": 1,
                  "value": 25,
                  "color": "#8e24aa"
                }
              ]
            }
                         "value": 20,
                  "color": "#00FFAA"
                },
                {
                    "label": "ICT College",
                  "data": 3,
                  "value": 40,
                  "color": "#ffb300"
                },
                {
                    "label": "Dienstverlening",
                  "data": 1,
                  "value": 25,
                  "color": "#8e24aa"
                }
              ]
            }
        ')),
            'c_assessors' => 75,
            'c_colleges' => 5,
            'c_teamleaders' => 55,
            'c_teamleaders_in_colleges' => 50,
            'year_checked' => true,
            'log' => '{}',
        ));

        HistoryData::create(array(
            'year' => Carbon::create(2016, 12, 31)->format('Y'),
            'actieve_assessors' => 400,
            'assessor_data' => trim(preg_replace('/\s\s+/', ' ','
            {
                "data": [
                {
                    "label": "Zorg en Welzijn",
                  "data": 10,
                  "value": 50,
                  "color": "#00FFFF"
                },
                {
                    "label": "Business College",
                  "data": 20,
                  "value": 20,
                  "color": "#00FFAA"
                },
                {
                    "label": "ICT College",
                  "data": 30,
                  "value": 40,
                  "color": "#ffb300"
                },
                {
                    "label": "Dienstverlening",
                  "data": 1,
                  "value": 25,
                  "color": "#8e24aa"
                }
              ]
            }
        ')),
            'c_assessors' => 20,
            'c_colleges' => 13,
            'c_teamleaders' => 60,
            'c_teamleaders_in_colleges' => 50,
            'year_checked' => false,
            'log' => '{}',
        ));
    }
}
