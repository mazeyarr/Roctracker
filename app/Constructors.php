<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Constructors extends Model
{
    public static function get($id=null, $json=false)
    {
        if (!empty($id)) {
            $constructor = self::find($id);
            if (empty($constructor)) {
                return $json == false ? null : json_encode(null);
            }

            $constructor->fk_college = College::find($constructor->fk_college);
            $constructor->fk_teamleader = Teamleaders::find($constructor->fk_teamleader);

            return $json == false ? $constructor : $constructor->toJson();
        }

        $constructors = self::all();
        foreach ($constructors as $constructor) {
            $constructor->fk_college = College::find($constructor->fk_college);
            $constructor->fk_teamleader = Teamleaders::find($constructor->fk_teamleader);
        }

        return $json == false ? $constructors : $constructors->toJson();

    }
}
