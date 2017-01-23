<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Log extends Model
{
    public static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

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

    public static function TeamleaderLog($id, $message) {
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
        $log['log'][$key]['discription'] = $message;
        $log['log'][$key]['key'] = $key;
        $teamleader->log = json_encode($log);
        $teamleader->save();
        return $teamleader;
    }
}
