<?php

namespace App;

use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * This Class will do all the Logging functions to the all the Models that contain a "log" field
 *
 * Class Log
 * @package App
 */
class Log extends Model
{
    /**
     * This generator is used to randomize names.
     * Its used to give unique names to keys or images
     *
     * @param int $length
     * @return string
     */
    public static function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * CollegeLog wil save messages to the according college
     *
     * @param $id
     * @param $message
     * @return mixed
     */
    public static function CollegeLog($id, $message)
    {
        $college = College::find($id); # We get the College (Collection) by id
        $key = self::generateRandomString(50); # We generate a unique Key name
        $log = json_decode($college->log, true); # We decode our json log (ASSOC ARRAY)
        $log['log'][$key]['date'] = Carbon::now('Europe/Amsterdam')->format('d-m-Y'); # We create Carbon object of current time
        $log['log'][$key]['by']['id'] = Auth::user()->id; # We store the logged on users id
        $log['log'][$key]['by']['name'] = Auth::user()->name; # We store the logged on users name
        $log['log'][$key]['discription'] = $message; # We store the message given by the function parameter
        $log['log'][$key]['key'] = $key; # We store the key another time so you can get it more easily
        $college->log = json_encode($log); # We encode the decoded json log
        $college->save();
        return $college;
    }

    /**
     * AssessorLog wil save messages to the according Assessor
     *
     * @param $id
     * @param $message
     * @return mixed
     */
    public static function AssessorLog($id, $message, $array = false)
    {
        $assessor = Assessors::find($id); # We find the assessor by $id (Collection)
        $log = json_decode($assessor->log, true); # We decode the json log (ASSOC ARRAY)
        $key = self::generateRandomString(50); # We generate a random unique string
        $log['log'][$key]['date'] = Carbon::now('Europe/Amsterdam')->format('d-m-Y'); # We create Carbon object of current time
        $log['log'][$key]['by']['id'] = Auth::user()->id; # We store the logged on users id
        $log['log'][$key]['by']['name'] = Auth::user()->name; # We store the logged on users name

        # If $array is set to TRUE than this indicates that $message is an array
        if ($array) {
            if (!is_array($message)) {
                return false;
            } # in case $message is not an array we return a false value

            # We initialize our variable
            # starting with an <ul> tag to start a unordered list
            $string = "<ul>";
            foreach ($message as $msg) {
                # Now we add each message as an 'list item' to the 'unordered list'
                $string = $string . "<li>" . $msg . "</li>";
            }

            # We finish the list by adding the end tag for the 'unordered list'
            $string = $string . "</ul>";

            $log['log'][$key]['discription'] = $string; # We store the made string to the log
        } else {
            $log['log'][$key]['discription'] = $message; # We store the made $message to the log
        }

        $log['log'][$key]['key'] = $key; # We store the key another time so you can get it more easily
        $assessor->log = json_encode($log); # We encode the decoded json log
        $assessor->save();
        return $assessor;
    }

    /**
     * TeamleaderLog wil save messages to the according Teamleader
     * also if many changes occur u have the option to make lists
     *
     * @param $id
     * @param $message
     * @param string $intro
     * @param string $list_before
     * @return mixed
     */
    public static function TeamleaderLog($id, $message, $intro = "", $list_before = "")
    {

        # First we check if the $message parameter is an array
        if (is_array($message)) {

            # We initialize our variables
            $list_start = "<ul>";
            $list_end = "</ul>";

            foreach ($message as $item) {
                $list_start = $list_start . $item; # We add each message as an list item
            }

            $list_start = $list_start . $list_end; # To finish the string we will end the string with our initialized variable

            # We transform the $message variable to the new made 'Unordered list'
            $message = $list_start;
        }

        $teamleader = Teamleaders::find($id); # We find the Teamleader by $id (Collection)
        $log = json_decode($teamleader->log, true); # We decode the json log (ASSOC ARRAY)
        $key = self::generateRandomString(50); # We generate a random unique string
        $log['log'][$key]['date'] = Carbon::now('Europe/Amsterdam')->format('d-m-Y'); # We create Carbon object of current time
        $log['log'][$key]['by']['id'] = Auth::user()->id; # We store the logged on users id
        $log['log'][$key]['by']['name'] = Auth::user()->name; # We store the logged on users name

        # We make our log by adding a few extra variables
        # $intro = The first line of text that is shown before the list
        # $list_before = is a description if the given list
        $log['log'][$key]['discription'] = $intro . "<br>" . $list_before . "<br>" . $message;

        $log['log'][$key]['key'] = $key; # We store the key another time so you can get it more easily
        $teamleader->log = json_encode($log); # We encode the decoded json log
        $teamleader->save();
        return $teamleader;
    }

    /**
     * This function will limit the log amount of given logs to a default $value of 5
     * But if an integer is given to the $value it will limit the log amount to the given $value
     *
     * @param $logs
     * @param int $value
     * @return array|null
     */
    public static function limit($logs, $value = 5)
    {
        $logs = json_decode($logs); # We decode all logs given by the $logs parameter
        $ret = array(); # We initialize our return array

        # in the case that there are no logs we return a null value
        if (empty($logs)) {
            return null;
        }

        # We reverse the array to reorder the dates from old --> new TO new --> old
        foreach (array_reverse((array)$logs->log) as $log) {
            if ($value > 0) {
                $ret[] = $log;
            } else {
                break;
            }
            $value--;
        }
        return $ret;
    }
}
