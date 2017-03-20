<?php

use Illuminate\Database\Seeder;
use App\Assessors;
use App\Exams;
use Carbon\Carbon;

class AssessorTableSeeder extends Seeder
{
    private $logString;
    private function string () {
        $string = \App\Log::generateRandomString(50);
        $this->logString = $string;
        return $string;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $EXAM = Exams::create(array(
            'basictraining' => trim(preg_replace('/\s\s+/', ' ', '
            {
                "passed": true,
              "requirements": {
                            "video": true,
                "portfolio": true,
                "CV": true
              },
              "date1": {
                            "present": true,
                "date": "'.Carbon::now()->subYears(2)->format('d-m-Y').'"
              },
              "date2": {
                            "present": true,
                "date": "'.Carbon::now()->subYears(2)->format('d-m-Y').'"
              },
              "graduated": false
            }')),
            'exam_next_on' => Carbon::now()->addYears(4),
            'training_next_on' => Carbon::now(),
            'training_done' => 4,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Rico van Dooren',
            'fk_college' => 4,
            'team' => 'ICT',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 1,
            'fk_exams' => $EXAM->id,
            'status' => 1,
            'log' => trim(preg_replace('/\s\s+/', ' ','
            {
                "log" : {
                    "'.$this->string().'": {
                      "date": "26-01-2017",
                      "by": {
                        "id": 1,
                        "name": "Mazeyar Rezaei"
                      },
                      "discription": "Test 1",
                      "key": "'.$this->logString.'"
                    },
                    "'.$this->string().'": {
                      "date": "26-01-2017",
                      "by": {
                        "id": 1,
                        "name": "Mazeyar Rezaei"
                      },
                      "discription": "Test 2",
                      "key": "'.$this->logString.'"
                    },
                    "'.$this->string().'": {
                      "date": "26-01-2017",
                      "by": {
                        "id": 1,
                        "name": "Mazeyar Rezaei"
                      },
                      "discription": "Test 3",
                      "key": "'.$this->logString.'"
                    },
                    "'.$this->string().'": {
                      "date": "26-01-2017",
                      "by": {
                        "id": 1,
                        "name": "Mazeyar Rezaei"
                      },
                      "discription": "Test 4",
                      "key": "'.$this->logString.'"
                    },
                    "'.$this->string().'": {
                      "date": "26-01-2017",
                      "by": {
                        "id": 1,
                        "name": "Mazeyar Rezaei"
                      },
                      "discription": "Test 5",
                      "key": "'.$this->logString.'"
                    },
                    "'.$this->string().'": {
                      "date": "26-01-2017",
                      "by": {
                        "id": 1,
                        "name": "Mazeyar Rezaei"
                      },
                      "discription": "Test 6",
                      "key": "'.$this->logString.'"
                    }
                }    
            }'))
        ));

        /****************************************/

        $EXAM = Exams::create(array(
            'basictraining' => trim(preg_replace('/\s\s+/', ' ', '
            {
                "passed": true,
              "requirements": {
                            "video": true,
                "portfolio": true,
                "CV": false
              },
              "date1": {
                            "present": true,
                "date": "'.Carbon::now()->subYears(2)->format('d-m-Y').'"
              },
              "date2": {
                            "present": true,
                "date": "'.Carbon::now()->subYears(2)->format('d-m-Y').'"
              },
              "graduated": true
            }')),
            'exam_next_on' => null,
            'training_next_on' => null,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Dick van Kalsbeek',
            'fk_college' => 4,
            'team' => 'ICT',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 1,
            'fk_exams' => $EXAM->id,
            'status' => 1,
            'log' => trim(preg_replace('/\s\s+/', ' ','
            {
                "log" : {}
            }'))
        ));

        /****************************************/

        $EXAM = Exams::create(array(
            'basictraining' => trim(preg_replace('/\s\s+/', ' ', '
            {
                "passed": true,
              "requirements": {
                            "video": true,
                "portfolio": true,
                "CV": false
              },
              "date1": {
                            "present": true,
                "date": "'.Carbon::now()->subYears(2)->format('d-m-Y').'"
              },
              "date2": {
                            "present": true,
                "date": "'.Carbon::now()->subYears(2)->format('d-m-Y').'"
              },
              "graduated": true
            }')),
            'exam_next_on' => null,
            'training_next_on' => null,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Casper de Meer',
            'fk_college' => 4,
            'team' => 'ICT',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 1,
            'fk_exams' => $EXAM->id,
            'status' => 1,
            'log' => trim(preg_replace('/\s\s+/', ' ','
            {
                "log" : {}
            }'))
        ));

        /****************************************/

        $EXAM = Exams::create(array(
            'basictraining' => trim(preg_replace('/\s\s+/', ' ', '
            {
                "passed": true,
              "requirements": {
                            "video": true,
                "portfolio": true,
                "CV": false
              },
              "date1": {
                            "present": true,
                "date": "'.Carbon::now()->subYears(2)->format('d-m-Y').'"
              },
              "date2": {
                            "present": true,
                "date": "'.Carbon::now()->subYears(2)->format('d-m-Y').'"
              },
              "graduated": true
            }')),
            'exam_next_on' => null,
            'training_next_on' => null,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Achmed Hakabi',
            'fk_college' => 4,
            'team' => 'ICT',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 1,
            'fk_exams' => $EXAM->id,
            'status' => 1,
            'log' => trim(preg_replace('/\s\s+/', ' ','
            {
                "log" : {}
            }'))
        ));

        /****************************************/

        $EXAM = Exams::create(array(
            'basictraining' => trim(preg_replace('/\s\s+/', ' ', '
            {
                "passed": false,
              "requirements": {
                            "video": false,
                "portfolio": false,
                "CV": false
              },
              "date1": {
                            "present": false,
                "date": null
              },
              "date2": {
                            "present": false,
                "date": null
              },
              "graduated": false
            }')),
            'exam_next_on' => null,
            'training_next_on' => null,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Sophie van de Steeg',
            'fk_college' => 4,
            'team' => 'ICT',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 1,
            'fk_exams' => $EXAM->id,
            'status' => 1,
            'log' => trim(preg_replace('/\s\s+/', ' ','
            {
                "log" : {}
            }'))
        ));

        /****************************************/

        $EXAM = Exams::create(array(
            'basictraining' => trim(preg_replace('/\s\s+/', ' ', '
            {
                "passed": false,
              "requirements": {
                            "video": false,
                "portfolio": false,
                "CV": false
              },
              "date1": {
                            "present": false,
                "date": null
              },
              "date2": {
                            "present": false,
                "date": null
              },
              "graduated": false
            }')),
            'exam_next_on' => null,
            'training_next_on' => null,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Lisa Richards',
            'fk_college' => 4,
            'team' => 'ICT',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 1,
            'fk_exams' => $EXAM->id,
            'status' => 1,
            'log' => trim(preg_replace('/\s\s+/', ' ','
            {
                "log" : {}
            }'))
        ));

        /****************************************/

        $EXAM = Exams::create(array(
            'basictraining' => trim(preg_replace('/\s\s+/', ' ', '
            {
                "passed": false,
              "requirements": {
                            "video": false,
                "portfolio": false,
                "CV": false
              },
              "date1": {
                            "present": false,
                "date": null
              },
              "date2": {
                            "present": false,
                "date": null
              },
              "graduated": false
            }')),
            'exam_next_on' => null,
            'training_next_on' => null,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Lieke Velds',
            'fk_college' => 4,
            'team' => 'ICT',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 1,
            'fk_exams' => $EXAM->id,
            'status' => 1,
            'log' => trim(preg_replace('/\s\s+/', ' ','
            {
                "log" : {}
            }'))
        ));

        /****************************************/

        $EXAM = Exams::create(array(
            'basictraining' => trim(preg_replace('/\s\s+/', ' ', '
            {
                "passed": false,
              "requirements": {
                            "video": false,
                "portfolio": false,
                "CV": false
              },
              "date1": {
                            "present": false,
                "date": null
              },
              "date2": {
                            "present": false,
                "date": null
              },
              "graduated": false
            }')),
            'exam_next_on' => null,
            'training_next_on' => null,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Zijlstra Openheimer',
            'fk_college' => 4,
            'team' => 'ICT',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 1,
            'fk_exams' => $EXAM->id,
            'status' => 1,
            'log' => trim(preg_replace('/\s\s+/', ' ','
            {
                "log" : {}
            }'))
        ));

        /****************************************/

        $EXAM = Exams::create(array(
            'basictraining' => trim(preg_replace('/\s\s+/', ' ', '
            {
                "passed": false,
              "requirements": {
                            "video": false,
                "portfolio": false,
                "CV": false
              },
              "date1": {
                            "present": false,
                "date": null
              },
              "date2": {
                            "present": false,
                "date": null
              },
              "graduated": false
            }')),
            'exam_next_on' => null,
            'training_next_on' => null,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Richard van de Sar',
            'fk_college' => 4,
            'team' => 'ICT',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 1,
            'fk_exams' => $EXAM->id,
            'status' => 1,
            'log' => trim(preg_replace('/\s\s+/', ' ','
            {
                "log" : {}
            }'))
        ));

        /****************************************/

        $EXAM = Exams::create(array(
            'basictraining' => trim(preg_replace('/\s\s+/', ' ', '
            {
                "passed": false,
              "requirements": {
                            "video": false,
                "portfolio": false,
                "CV": false
              },
              "date1": {
                            "present": false,
                "date": null
              },
              "date2": {
                            "present": false,
                "date": null
              },
              "graduated": false
            }')),
            'exam_next_on' => null,
            'training_next_on' => null,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Zara Larson',
            'fk_college' => 2,
            'team' => 'Zorg',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 2,
            'fk_exams' => $EXAM->id,
            'status' => 1,
            'log' => trim(preg_replace('/\s\s+/', ' ','
            {
                "log" : {}
            }'))
        ));

        /****************************************/

        $EXAM = Exams::create(array(
            'basictraining' => trim(preg_replace('/\s\s+/', ' ', '
            {
                "passed": false,
              "requirements": {
                            "video": false,
                "portfolio": false,
                "CV": false
              },
              "date1": {
                            "present": false,
                "date": null
              },
              "date2": {
                            "present": false,
                "date": null
              },
              "graduated": false
            }')),
            'exam_next_on' => null,
            'training_next_on' => null,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Wijnans Robberts',
            'fk_college' => 2,
            'team' => 'Zorg',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 2,
            'fk_exams' => $EXAM->id,
            'status' => 1,
            'log' => trim(preg_replace('/\s\s+/', ' ','
            {
                "log" : {}
            }'))
        ));

        /****************************************/

        $EXAM = Exams::create(array(
            'basictraining' => trim(preg_replace('/\s\s+/', ' ', '
            {
                "passed": false,
              "requirements": {
                            "video": false,
                "portfolio": false,
                "CV": false
              },
              "date1": {
                            "present": false,
                "date": null
              },
              "date2": {
                            "present": false,
                "date": null
              },
              "graduated": false
            }')),
            'exam_next_on' => null,
            'training_next_on' => null,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Margo Hendrikx',
            'fk_college' => 2,
            'team' => 'Zorg',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 2,
            'fk_exams' => $EXAM->id,
            'status' => 1,
            'log' => trim(preg_replace('/\s\s+/', ' ','
            {
                "log" : {}
            }'))
        ));

        /****************************************/

        $EXAM = Exams::create(array(
            'basictraining' => trim(preg_replace('/\s\s+/', ' ', '
            {
                "passed": false,
              "requirements": {
                            "video": false,
                "portfolio": false,
                "CV": false
              },
              "date1": {
                            "present": false,
                "date": null
              },
              "date2": {
                            "present": false,
                "date": null
              },
              "graduated": false
            }')),
            'exam_next_on' => null,
            'training_next_on' => null,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Mieke Liebrechts',
            'fk_college' => 2,
            'team' => 'Zorg',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 2,
            'fk_exams' => $EXAM->id,
            'status' => 1,
            'log' => trim(preg_replace('/\s\s+/', ' ','
            {
                "log" : {}
            }'))
        ));

        /****************************************/

        $EXAM = Exams::create(array(
            'basictraining' => trim(preg_replace('/\s\s+/', ' ', '
            {
                "passed": false,
              "requirements": {
                            "video": false,
                "portfolio": false,
                "CV": false
              },
              "date1": {
                            "present": false,
                "date": null
              },
              "date2": {
                            "present": false,
                "date": null
              },
              "graduated": false
            }')),
            'exam_next_on' => null,
            'training_next_on' => null,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Michelle van Doordrecht',
            'fk_college' => 2,
            'team' => 'Zorg',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 2,
            'fk_exams' => $EXAM->id,
            'status' => 1,
            'log' => trim(preg_replace('/\s\s+/', ' ','
            {
                "log" : {}
            }'))
        ));

        /****************************************/

        $EXAM = Exams::create(array(
            'basictraining' => trim(preg_replace('/\s\s+/', ' ', '
            {
                "passed": false,
              "requirements": {
                            "video": false,
                "portfolio": false,
                "CV": false
              },
              "date1": {
                            "present": false,
                "date": null
              },
              "date2": {
                            "present": false,
                "date": null
              },
              "graduated": false
            }')),
            'exam_next_on' => null,
            'training_next_on' => null,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Anna Robin',
            'fk_college' => 2,
            'team' => 'Zorg',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 2,
            'fk_exams' => $EXAM->id,
            'status' => 1,
            'log' => trim(preg_replace('/\s\s+/', ' ','
            {
                "log" : {}
            }'))
        ));

        /****************************************/

        $EXAM = Exams::create(array(
            'basictraining' => trim(preg_replace('/\s\s+/', ' ', '
            {
                "passed": false,
              "requirements": {
                            "video": false,
                "portfolio": false,
                "CV": false
              },
              "date1": {
                            "present": false,
                "date": null
              },
              "date2": {
                            "present": false,
                "date": null
              },
              "graduated": false
            }')),
            'exam_next_on' => null,
            'training_next_on' => null,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Jannie Liekenhof',
            'fk_college' => 2,
            'team' => 'Zorg',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 2,
            'fk_exams' => $EXAM->id,
            'status' => 1,
            'log' => trim(preg_replace('/\s\s+/', ' ','
            {
                "log" : {}
            }'))
        ));

        /****************************************/

        $EXAM = Exams::create(array(
            'basictraining' => trim(preg_replace('/\s\s+/', ' ', '
            {
                "passed": false,
              "requirements": {
                            "video": false,
                "portfolio": false,
                "CV": false
              },
              "date1": {
                            "present": false,
                "date": null
              },
              "date2": {
                            "present": false,
                "date": null
              },
              "graduated": false
            }')),
            'exam_next_on' => null,
            'training_next_on' => null,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Koos Filipono',
            'fk_college' => 2,
            'team' => 'Zorg',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 2,
            'fk_exams' => $EXAM->id,
            'status' => 1,
            'log' => trim(preg_replace('/\s\s+/', ' ','
            {
                "log" : {}
            }'))
        ));

        /****************************************/

        $EXAM = Exams::create(array(
            'basictraining' => trim(preg_replace('/\s\s+/', ' ', '
            {
                "passed": false,
              "requirements": {
                            "video": false,
                "portfolio": false,
                "CV": false
              },
              "date1": {
                            "present": false,
                "date": null
              },
              "date2": {
                            "present": false,
                "date": null
              },
              "graduated": false
            }')),
            'exam_next_on' => null,
            'training_next_on' => null,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Jolanda de Haas',
            'fk_college' => 2,
            'team' => 'Zorg',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 2,
            'fk_exams' => $EXAM->id,
            'status' => 1,
            'log' => trim(preg_replace('/\s\s+/', ' ','
            {
                "log" : {}
            }'))
        ));

        /****************************************/

        $EXAM = Exams::create(array(
            'basictraining' => trim(preg_replace('/\s\s+/', ' ', '
            {
                "passed": false,
              "requirements": {
                            "video": false,
                "portfolio": false,
                "CV": false
              },
              "date1": {
                            "present": false,
                "date": null
              },
              "date2": {
                            "present": false,
                "date": null
              },
              "graduated": false
            }')),
            'exam_next_on' => null,
            'training_next_on' => null,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Dione Stax',
            'fk_college' => 1,
            'team' => 'Business',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 2,
            'fk_exams' => $EXAM->id,
            'status' => 1,
            'log' => trim(preg_replace('/\s\s+/', ' ','
            {
                "log" : {}
            }'))
        ));

        /****************************************/

        $EXAM = Exams::create(array(
            'basictraining' => trim(preg_replace('/\s\s+/', ' ', '
            {
                "passed": false,
              "requirements": {
                            "video": false,
                "portfolio": false,
                "CV": false
              },
              "date1": {
                            "present": false,
                "date": null
              },
              "date2": {
                            "present": false,
                "date": null
              },
              "graduated": false
            }')),
            'exam_next_on' => null,
            'training_next_on' => null,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Fenne van Koophaven',
            'fk_college' => 1,
            'team' => 'Business',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 2,
            'fk_exams' => $EXAM->id,
            'status' => 1,
            'log' => trim(preg_replace('/\s\s+/', ' ','
            {
                "log" : {}
            }'))
        ));

        /****************************************/

        $EXAM = Exams::create(array(
            'basictraining' => trim(preg_replace('/\s\s+/', ' ', '
            {
                "passed": false,
              "requirements": {
                            "video": false,
                "portfolio": false,
                "CV": false
              },
              "date1": {
                            "present": false,
                "date": null
              },
              "date2": {
                            "present": false,
                "date": null
              },
              "graduated": false
            }')),
            'exam_next_on' => null,
            'training_next_on' => null,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Bart Verstappen',
            'fk_college' => 1,
            'team' => 'Business',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 2,
            'fk_exams' => $EXAM->id,
            'status' => 1,
            'log' => trim(preg_replace('/\s\s+/', ' ','
            {
                "log" : {}
            }'))
        ));

        /****************************************/

        $EXAM = Exams::create(array(
            'basictraining' => trim(preg_replace('/\s\s+/', ' ', '
            {
                "passed": false,
              "requirements": {
                            "video": false,
                "portfolio": false,
                "CV": false
              },
              "date1": {
                            "present": false,
                "date": null
              },
              "date2": {
                            "present": false,
                "date": null
              },
              "graduated": false
            }')),
            'exam_next_on' => null,
            'training_next_on' => null,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Mia Koblava',
            'fk_college' => 1,
            'team' => 'Business',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 2,
            'fk_exams' => $EXAM->id,
            'status' => 1,
            'log' => trim(preg_replace('/\s\s+/', ' ','
            {
                "log" : {}
            }'))
        ));

        /****************************************/

        $EXAM = Exams::create(array(
            'basictraining' => trim(preg_replace('/\s\s+/', ' ', '
            {
                "passed": false,
              "requirements": {
                            "video": false,
                "portfolio": false,
                "CV": false
              },
              "date1": {
                            "present": false,
                "date": null
              },
              "date2": {
                            "present": false,
                "date": null
              },
              "graduated": false
            }')),
            'exam_next_on' => null,
            'training_next_on' => null,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Alia van Kempen',
            'fk_college' => null,
            'team' => 'Business',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 2,
            'fk_exams' => $EXAM->id,
            'status' => 1,
            'log' => trim(preg_replace('/\s\s+/', ' ','
            {
                "log" : {}
            }'))
        ));

        /****************************************/

        $EXAM = Exams::create(array(
            'basictraining' => trim(preg_replace('/\s\s+/', ' ', '
            {
                "passed": false,
              "requirements": {
                            "video": false,
                "portfolio": false,
                "CV": false
              },
              "date1": {
                            "present": false,
                "date": null
              },
              "date2": {
                            "present": false,
                "date": null
              },
              "graduated": false
            }')),
            'exam_next_on' => null,
            'training_next_on' => null,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Richard van Kloppings',
            'fk_college' => 6,
            'team' => 'D&R',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 1,
            'fk_exams' => $EXAM->id,
            'status' => 0,
            'log' => trim(preg_replace('/\s\s+/', ' ','
            {
                "log" : {}
            }'))
        ));

        /****************************************/

        $EXAM = Exams::create(array(
            'basictraining' => trim(preg_replace('/\s\s+/', ' ', '
            {
                "passed": false,
              "requirements": {
                            "video": false,
                "portfolio": false,
                "CV": false
              },
              "date1": {
                            "present": false,
                "date": null
              },
              "date2": {
                            "present": false,
                "date": null
              },
              "graduated": false
            }')),
            'exam_next_on' => null,
            'training_next_on' => null,
            'log' => '{}'
        ));

        Assessors::create(array(
            'name' => 'Miera Shouwers',
            'fk_college' => 6,
            'team' => 'D&R',
            'birthdate' => Carbon::now(),
            'function' => 'Leraar',
            'trained_by' => 'NAE',
            'certified_by' => 'NAE',
            'fk_teamleader' => 1,
            'fk_exams' => $EXAM->id,
            'status' => 0,
            'log' => trim(preg_replace('/\s\s+/', ' ','
            {
                "log" : {}
            }'))
        ));
    }
}
