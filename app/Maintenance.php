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
    public static function whatKindOfMaintenance ($id) {
        $assessor = Assessors::find($id); # We get the assessor by $id (Collection class)
        $exam = Exams::find($assessor->fk_exams); # We get the assessors exam data by the foreign key (Collection class)

        # We make a simple calculation of the kind of maintenance
        if ($exam->training_done == 4) {
            return "exam";
        }else{
            return "maintenance";
        }
    }
}
