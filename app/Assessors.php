<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assessors extends Model
{
    public static function getAssessors($id=null){
        $assessors = array();

        if (self::all()->isEmpty()){
            return null;
        }

        if (!is_null($id)) {
            $assessor = self::find($id);

            if (!is_null($assessor->fk_college)) {
                $college = College::find($assessor->fk_college);
                $assessor->fk_college = $college;
            }

            $teamleader = Teamleaders::find($assessor->fk_teamleader)->name;

            if (!empty($teamleader)) {
                $assessor->fk_teamleader = $teamleader;
            }

            $exams = Exams::find($assessor->fk_exams);

            if (!empty($exams)) {
                $exams->basictraining = json_decode($exams->basictraining);
                $assessor->fk_exams = $exams;
            }

            return $assessor;
        }

        foreach (self::all() as $assessor) {

            $college = College::find($assessor->fk_college);
            $assessor->fk_college = $college;

            $teamleader = Teamleaders::find($assessor->fk_teamleader);

            if (!empty($teamleader)) {
                $assessor->fk_teamleader = $teamleader->name;
            }

            $exams = Exams::find($assessor->fk_exams);

            if (!empty($exams)) {
                $exams->basictraining = json_decode($exams->basictraining);
                $assessor->fk_exams = $exams;
            }
            $assessors[] = $assessor;
        }
        return $assessors;
    }
}
