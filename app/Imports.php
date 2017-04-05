<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

/**
 * This class will keep track of all the imported files to the system.
 *
 * Class Imports
 * @package App
 */
class Imports extends Model
{
    public static function undo($id)
    {
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
