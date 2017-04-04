<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TiC extends Model
{
    /**
     * This function is for getting college that is assigned to the teamleaders by id
     *
     * @param $id = teamleader id
     * @return mixed
     */
    public static function AssignedCollege ($id) {
        $teamleader_in_colleges = self::where('fk_teamleader', '=', $id)->get();
        if ($teamleader_in_colleges->isEmpty()) {
            return null;
        }

        $ret['colleges'] = array();
            foreach ($teamleader_in_colleges as $college_id) {
                $ret['colleges'][] = College::find($college_id->fk_college);
                $ret['count'] = count($teamleader_in_colleges);
                $ret['tic'][] = $college_id->id;
            }
        return $ret;
    }
    public static function AssignedTeamleader ($id) {

    }
}
