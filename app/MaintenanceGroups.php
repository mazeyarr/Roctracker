<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaintenanceGroups extends Model
{
    public static function GetGroups () {
        $groups = self::where('year', '>=', date('Y'))->get();

        if (empty($groups)) {
            return null;
        }

        foreach ($groups as $group) {
            $group->participants = json_decode($group->participants);
            foreach ($group->participants->participants as $key => $assessor) {
                $group->participants->participants[$key] = Assessors::find($assessor);
            }
        }
        return $groups;
    }
}
