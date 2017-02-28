<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Functions extends Model
{
    public static function getTablename($model){
        return with(new $model)->getTable();
    }
}
