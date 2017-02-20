<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Imports extends Model
{
    public static function undo ($id) {
        if (empty($id) || !is_numeric($id)) {
            return false;
        }

        $import = self::find($id);
        if (empty($import)) {
            return false;
        }
        switch ($import->function) {
            case "add":
                foreach (json_decode($import->data) as $rowid) {
                    DB::table($import->tablename)->where('id', '=', $rowid->id)->delete();
                }
                $import->status = 0;
                break;
        }
        $import->save();
        return true;
    }
}
