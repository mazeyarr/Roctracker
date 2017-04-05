<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teamleaders extends Model
{
    /**
     * This function is used to get all teamleaders with colleges if available,
     *
     * @param null $id
     * @return array|bool|mixed
     */
    public static function getTeamleaders($id = null)
    {

        # We initialize our variables
        $ret = false;
        $college = null;
        $format_teamleaders = array();
        $all_teamleaders = self::all();

        # If there are no teamleaders existent in the database then it will return false
        if (!empty($all_teamleaders)) {

            # We loop trough all the teamleaders and make a proper output that we can than loop trough in the view
            foreach ($all_teamleaders as $teamleader) {
                $format_teamleaders[$teamleader->id]["teamleader"] = $teamleader;
                $inCollege = TiC::where("fk_teamleader", "=", $teamleader->id)->get();
                if (!$inCollege->isEmpty()) {
                    foreach ($inCollege as $inthisCollege) {
                        $format_teamleaders[$teamleader->id]["college"][] = College::find($inthisCollege->fk_college);
                    }
                } else {
                    $format_teamleaders[$teamleader->id]["college"] = null;
                }
            }
            $ret = $format_teamleaders;
        }

        if (!is_null($id)) {
            array_key_exists($id, $ret) ? $ret = $ret[$id] : $ret = false;
        }
        return $ret;
    }
}
