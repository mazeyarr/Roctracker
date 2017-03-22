<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Exams extends Model
{
    public static function MaintenanceUpdate () {
        $need_maintenance = null;
        $assessors = Assessors::all();
        foreach ($assessors as $assessor) {
            $exam = self::find($assessor->fk_exams);
            if (empty($exam)) {
                continue;
            }
            $basictraining = json_decode($exam->basictraining);
            /*if (!is_object($basictraining)) {
                dd($exam);
            }*/
            if (!$basictraining->passed) {
                continue;
            }
            if ($basictraining->date2->date == null) {
                continue;
            }
            if (date('Y') == date_format(date_create_from_format('d-m-Y', $basictraining->date2->date),'Y') ) {
                continue;
            }
            elseif (date('Y') == date_format(date_create_from_format('d-m-Y', $basictraining->date2->date),'Y') +1) {
                continue;
            }
            if ($exam->training_done == 4) {
                $need_maintenance[] = array(
                    'assessor' => $assessor,
                    'type' => 'Examen',
                    'data' => $exam
                );
            }else{
                $need_maintenance[] = array(
                    'assessor' => $assessor,
                    'type' => 'Onderhoud',
                    'data' => $exam
                );
            }
        }
        return $need_maintenance;
    }

    public static function getBasictraining ($id) {
        $exam = self::find($id);
        if (empty($exam)) {
            return false;
        }
        return json_decode($exam->basictraining);
    }

    public static function saveBasictraining($id, $object=null) {
        $exam = self::find($id);
        if (empty($object)) {
            return false;
        }
        $exam->basictraining = json_encode($object);
        $exam->save();

        return $exam;
    }

    public static function NewAssessor ($training=false, $last_training=null) {
        $exam = new self();

        if ($training) {
            $exam->basictraining = trim(preg_replace('/\s\s+/', ' ', '
            {
              "passed": true,
              "requirements": {
                "video": true,
                "portfolio": true,
                "CV": true
              },
              "date1": {
                "present": true,
                "date": "'.$last_training.'"
              },
              "date2": {
                "present": true,
                "date": "'.$last_training.'"
              },
              "graduated": true
            }'));
        }else{
            $exam->basictraining = trim(preg_replace('/\s\s+/', ' ', '
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
            }'));
        }

        $training_done = 0;
        if (!empty($last_training)) {
            $training_done = self::calcTrainingDone($last_training, 'd-m-Y');
        }
        $exam->exam_next_on = null;
        $exam->training_next_on = null;
        $exam->training_done = $training_done;
        $exam->log = '{}';
        $exam->save();
        return $exam->id;
    }

    public static function calcTrainingDone ($basictraining_date, $format) {
        $begin = Carbon::parse(date_format(date_create_from_format($format, $basictraining_date), 'Y-m-d'));
        $end = Carbon::parse(date_format(date_create_from_format('d-m-Y', Carbon::now()->format('d-m-Y')), 'Y-m-d'));
        $diff = $end->diffInYears($begin);
        if ($diff >= 4 ) {
            $training_done = 4;
        }elseif ($diff == 1) {
            $training_done = 0;
        } else{
            $training_done = $diff -1;
        }
        return $training_done;
    }
}
