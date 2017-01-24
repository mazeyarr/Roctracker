<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teamleaders extends Model
{
    public static function getTeamleaders ($id=null) {
        $ret = false;
        $college = null;
        $format_teamleaders = array();
        $all_teamleaders = self::all();

        if (!empty($all_teamleaders)) {
            foreach ($all_teamleaders as $teamleader) {
                $format_teamleaders[$teamleader->id]["teamleader"] = $teamleader;
                $inCollege = TiC::where("fk_teamleader", "=", $teamleader->id)->first();
                $inCollege = TiC::where("fk_teamleader", "=", $teamleader->id)->get();
                if (!$inCollege->isEmpty()) {
                    foreach ($inCollege as $inthisCollege) {
                        $format_teamleaders[$teamleader->id]["college"][] = College::find($inthisCollege->fk_college);
                    }
                }else {
                    $format_teamleaders[$teamleader->id]["college"] = null;
                }
            }
            $ret = $format_teamleaders;
        }

        if (!is_null($id)) {
            array_key_exists ( $id , $ret ) ? $ret = $ret[$id] : $ret = false;
        }
        return $ret;
    }
}
