<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    /**
     * @param null $id
     * @return array|null
     *
     * This function gets all colleges mixes them to with the assigned teamleader(s)
     * (The $id parameter is used for single searches. It then returns a single college)
     */
    public static function getColleges($id=null) {
        # if there is an ID given as a parameter of this function then we only get 1 college according to the ID
        if (!is_null($id)) {
            $college = self::find($id); # Get the college object
            if (empty($college)) {
                return null; # If the object is empty we cancel this function
            }

            # We initialize our variables here
            $with_teamleaders = array();
            $asigned_teamleaders = TiC::where('fk_college', '=', $college->id)->first();

            # We now merge the teamleaders and colleges together based on the TIC table (Teamleaders in Colleges)
            if (is_null($asigned_teamleaders)) {
                $with_teamleaders['college'] = $college;
                $with_teamleaders['teamleader'] = null;
            }else {
                $with_teamleaders['college'] = $college;
                $with_teamleaders['teamleader'] = Teamleaders::find($asigned_teamleaders->fk_teamleader);
            }
            return $with_teamleaders;
        }else {
            # else we just grab all the colleges
            $colleges = self::all();
        }

        # if there is no college existent in the database we return a (null) value
        if (empty($colleges)) {
            return null;
        }

        # We initialize our variables
        $with_teamleaders = array();
        # This foreach will loop trough every college,
        # it will insure that we have control over the output of our data tot the view
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

    /**
     * @param $result
     * @return array
     *
     * This function is user to reform a object into an array if necessary
     */
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
