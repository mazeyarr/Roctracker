<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    public static function GetSortedData() {
        $dates = self::where('from', '>=', date('Y-m-d'))->get();
        if (empty($dates)) {
            return null;
        }

        $ret = array();

        foreach ($dates as $date) {
            if (!empty($date->fk_group)){
                $date->fk_group = MaintenanceGroups::find($date->fk_group);
            }
            $ret[] = $date;
        }
        return $ret;
    }

    public static function whatKindOfMaintenance ($id) {
        $assessor = Assessors::find($id);
        $exam = Exams::find($assessor->fk_exams);
        if ($exam->training_done == 4) {
            return "exam";
        }else{
            return "maintenance";
        }
    }
}
