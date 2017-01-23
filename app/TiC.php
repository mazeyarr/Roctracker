<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TiC extends Model
{
    /**
     * @param $id = teamleader id
     * @return mixed
     */
    public static function AssignedCollege ($id) {
        $teamleader_in_colleges = self::where('fk_teamleader', '=', $id)->get();
        $ret['colleges'] = array();
        if (count($teamleader_in_colleges) > 1) {
            foreach ($teamleader_in_colleges as $college_id) {
                $ret['colleges'][] = College::find($college_id->fk_college);
                $ret['count'] = count($teamleader_in_colleges);
                $ret['tic'][] = $college_id->id;
            }
            return $ret;
        }else {
            $ret['colleges'][] = College::find($teamleader_in_colleges->first()->fk_college);
            $ret['count'] = count($teamleader_in_colleges);
            $ret['tic'] = $teamleader_in_colleges->id;
            return $ret;
        }
    }
    public static function AssignedTeamleader ($id) {

    }
}
