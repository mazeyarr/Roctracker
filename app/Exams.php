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
}
