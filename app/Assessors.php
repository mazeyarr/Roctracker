<?php

namespace App;

use Carbon\Carbon;
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

            if (!is_null($assessor->fk_teamleader)) {
                $teamleader = Teamleaders::find($assessor->fk_teamleader)->name;

                if (!empty($teamleader)) {
                    $assessor->fk_teamleader = $teamleader;
                }
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

    public static function ScheduledForMaintenance($id, $date, $place) {
        $assessor = self::find($id);
        if (empty($assessor)) {
            return false;
        }
        $type = Maintenance::whatKindOfMaintenance($id);
        if ($place) {
            if ($type == "maintenance"){
                $exam = Exams::find($assessor->fk_exams);
                $exam->training_next_on = Carbon::createFromFormat('Y-m-d H:i:s', $date)->toDateString();
                $exam->save();
                Log::AssessorLog($id, "Is aangemeld om op onderhoud te gaan voor " . Carbon::createFromFormat('Y-m-d H:i:s', $date)->toDateString());
            }

            if ($type == "exam") {
                $exam = Exams::find($assessor->fk_exams);
                $exam->exam_next_on = Carbon::createFromFormat('Y-m-d H:i:s', $date)->toDateString();
                $exam->save();
                Log::AssessorLog($id, "Is aangemeld om op examen te gaan voor " . Carbon::createFromFormat('Y-m-d H:i:s', $date)->toDateString());
            }
        }else {
            if ($type == "maintenance"){
                $exam = Exams::find($assessor->fk_exams);
                $exam->training_next_on = null;
                $exam->save();
            }

            if ($type == "exam") {
                $exam = Exams::find($assessor->fk_exams);
                $exam->exam_next_on = null;
                $exam->save();
            }
        }
    }
}
