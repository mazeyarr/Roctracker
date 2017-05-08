<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * This class will manage all maintenance data of each assessor
 *
 * Class Maintenance
 * @package App
 */
class Maintenance extends Model
{
    /**
     * This function will look what kind of maintenance the given assessor (by $id) needs
     *
     * @param $id
     * @return string "maintenance" | "exam"
     */
    public static function whatKindOfMaintenance($id)
    {
        $assessor = Assessors::find($id); # We get the assessor by $id (Collection class)
        $exam = Exams::find($assessor->fk_exams); # We get the assessors exam data by the foreign key (Collection class)

        # We make a simple calculation of the kind of maintenance
        if ($exam->training_done == 4) {
            return "exam";
        } else {
            return "maintenance";
        }
    }

    public static function saveAndRecalculate()
    {
        $exams = Exams::all();
        foreach ($exams as $exam) {
            $basictraining = json_decode($exam->basictraining);
            if (!$basictraining->passed) {
                continue;
            }
            if ($basictraining->graduationday == null) {
                continue;
            }

            if (empty($exam->last_maintenance)) {
                $exam->training_done = Exams::calcTrainingDone($basictraining->graduationday, 'd-m-Y');
            }else{
                if ($exam->maintenance_this_year) {
                    if ($exam->training_done == 4) {
                        $exam->training_done = 1;
                    }else{
                        $exam->training_done = $exam->training_done +1;
                    }
                    $exam->maintenance_this_year = false;
                }
            }
            $exam->save();
        }
    }
}
