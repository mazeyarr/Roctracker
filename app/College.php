<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    public static function teamleaders($id=null) {
        if (!is_null($id)) {
            $college = self::find($id);
            if (empty($college)) {
                return null;
            }
            $with_teamleaders = array();
            $asigned_teamleaders = TiC::where('fk_college', '=', $college->id)->first();
            $with_teamleaders['college'] = $college;
            $with_teamleaders['teamleader'] = Teamleaders::find($asigned_teamleaders->fk_teamleader);
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
            $with_teamleaders[$college->name]['college'] = $college;
            $with_teamleaders[$college->name]['teamleader'] = Teamleaders::find($asigned_teamleaders->fk_teamleader);
        }
        return $with_teamleaders;
    }
}
