<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Log extends Model
{
    /**
     * @param int $length
     * @return string
     *
     * This generator is used to randomize names.
     * Its used to give unique names to keys or images
     */
    public static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * @param $id
     * @param $message
     * @return mixed
     *
     * CollegeLog wil save messages to the according college
     */
    public static function CollegeLog($id, $message) {
        $college = College::find($id);
        $key = self::generateRandomString(50);
        $log = json_decode($college->log, true);
        $log['log'][$key]['date'] = Carbon::now('Europe/Amsterdam')->format('d-m-Y');
        $log['log'][$key]['by']['id'] = Auth::user()->id;
        $log['log'][$key]['by']['name'] = Auth::user()->name;
        $log['log'][$key]['discription'] = $message;
        $log['log'][$key]['key'] = $key;
        $college->log = json_encode($log);
        $college->save();
        return $college;
    }

    /**
     * @param $id
     * @param $message
     * @return mixed
     *
     * AssessorLog wil save messages to the according Assessor
     */
    public static function AssessorLog($id, $message) {
        $assessor = Assessors::find($id);
        $log = json_decode($assessor->log, true);
        $key = self::generateRandomString(50);
        $log['log'][$key]['date'] = Carbon::now('Europe/Amsterdam')->format('d-m-Y');
        $log['log'][$key]['by']['id'] = Auth::user()->id;
        $log['log'][$key]['by']['name'] = Auth::user()->name;
        $log['log'][$key]['discription'] = $message;
        $log['log'][$key]['key'] = $key;
        $assessor->log = json_encode($log);
        $assessor->save();
        return $assessor;
    }

    /**
     * @param $id
     * @param $message
     * @param string $intro
     * @param string $list_before
     * @return mixed
     *
     * TeamleaderLog wil save messages to the according Teamleader
     * also if many changes occur u have the option to make lists
     */
    public static function TeamleaderLog($id, $message, $intro="", $list_before="") {
        if (is_array($message)) {
            $list_start = "<ul>";
            $list_end = "</ul>";
            foreach ($message as $item) {
                $list_start = $list_start . $item;
            }
            $list_start = $list_start.$list_end;
            $message = $list_start;
        }
        $teamleader = Teamleaders::find($id);
        $log = json_decode($teamleader->log, true);
        $key = self::generateRandomString(50);
        $log['log'][$key]['date'] = Carbon::now('Europe/Amsterdam')->format('d-m-Y');
        $log['log'][$key]['by']['id'] = Auth::user()->id;
        $log['log'][$key]['by']['name'] = Auth::user()->name;
        $log['log'][$key]['discription'] = $intro."<br>".$list_before."<br>".$message;
        $log['log'][$key]['key'] = $key;
        $teamleader->log = json_encode($log);
        $teamleader->save();
        return $teamleader;
    }
}
