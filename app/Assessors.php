<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assessors extends Model
{
    public static function getAssessors(){
        $assessors = array();

        if (self::all()->isEmpty()){
            return null;
        }

        foreach (self::all() as $assessor) {
            if (is_null($assessor->fk_college)) {
                $assessors[] = $assessor;
                continue;
            }

            $college = College::find($assessor->fk_college);
            $assessor->fk_college = $college;

            $teamleader = Teamleaders::find($assessor->fk_teamleader)->name;
            $assessor->fk_teamleader = $teamleader;

            $assessors[] = $assessor;
        }
        return $assessors;
    }
}
