<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exams extends Model
{
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

    public static function NewAssessor () {
        $exam = new self();
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
        $exam->exam_next_on = null;
        $exam->training_next_on = null;
        $exam->log = '{}';
        $exam->save();
        return $exam->id;
    }
}
