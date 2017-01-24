<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    public static function getColleges($id=null) {
        if (!is_null($id)) {
            $college = self::find($id);
            if (empty($college)) {
                return null;
            }
            $with_teamleaders = array();
            $asigned_teamleaders = TiC::where('fk_college', '=', $college->id)->first();
            if (is_null($asigned_teamleaders)) {
                $with_teamleaders['college'] = $college;
                $with_teamleaders['teamleader'] = null;
            }else {
                $with_teamleaders['college'] = $college;
                $with_teamleaders['teamleader'] = Teamleaders::find($asigned_teamleaders->fk_teamleader);
            }
            return $with_teamleaders;
        }else {
            $colleges = self::all();
        }

        if (empty($colleges)) {
            return null;
        }

        $with_teamleaders = array();
        foreach ($colleges as $college) {
            $asigned_teamleaders = TiC::where('fk_college', '=', $college->id)->first();
            if (is_null($asigned_teamleaders)) {
                $with_teamleaders[$college->id]['college'] = $college;
                $with_teamleaders[$college->id]['teamleader'] = null;
            }else {
                $with_teamleaders[$college->id]['college'] = $college;
                $with_teamleaders[$college->id]['teamleader'] = Teamleaders::find($asigned_teamleaders->fk_teamleader);
            }
        }
        return $with_teamleaders;
    }

    public static function object_2_array($result)
    {
        $array = array();
        foreach ($result as $key=>$value)
        {
            if (is_object($value))
            {
                $array[$key]=self::object_2_array(self::object_2_array($value));
            }
            if (is_array($value))
            {
                $array[$key]=self::object_2_array(self::object_2_array($value));
            }
            else
            {
                $array[$key]=$value;
            }
        }
        return $array;
    }
}
