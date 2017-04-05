<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    /**
     * This function gets all colleges mixes them to with the assigned teamleader(s)
     * (The $id parameter is used for single searches. It then returns a single college)
     *
     * @param null $id
     * @return array|null
     */
    public static function getColleges($id = null)
    {
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
            } else {
                $with_teamleaders['college'] = $college;
                $with_teamleaders['teamleader'] = Teamleaders::find($asigned_teamleaders->fk_teamleader);
            }
            return $with_teamleaders;
        } else {
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
        # it will insure that we have control over the output of our data to the view
        foreach ($colleges as $college) {
            # We get the asigned teamleader of this college
            $asigned_teamleaders = TiC::where('fk_college', '=', $college->id)->first();
            if (empty($asigned_teamleaders)) {
                # If there is no teamleader, we will just give the college and set the teamleader to null value
                $with_teamleaders[$college->id]['college'] = $college;
                $with_teamleaders[$college->id]['teamleader'] = null;
            } else {
                # in the case that we do have a teamleader in this college we will set the teamleader to a Collection class
                $with_teamleaders[$college->id]['college'] = $college;
                $with_teamleaders[$college->id]['teamleader'] = Teamleaders::find($asigned_teamleaders->fk_teamleader);
            }
        }
        return $with_teamleaders;
    }

    /**
     * This function will return all assessors.
     * In the case $json is equal to TRUE (boolean) this function returns all assessors in json string
     *
     * @param $id
     * @param bool $json
     * @return null|string
     */
    public static function AssessorsInCollege($id, $json = false)
    {
        $assessors = Assessors::where('fk_college', $id)->where('status', 1)->get();
        if ($json) {
            $data = array();
            foreach ($assessors as $assessor) {
                # we decode the Log from each assessor to an Object
                $assessor->log = json_decode($assessor->log);

                # We add the (temp edited ^ ) assessor to an array
                $data[] = $assessor;
            }

            #we encode the array to json and return it
            return json_encode($data);
        } else {
            if ($assessors->isEmpty()) {
                return null;
            }
            return $assessors;
        }
    }

    /**
     * This function is user to reform a object into an array if necessary
     *
     * @param $result
     * @return array
     */
    public static function object_2_array($result)
    {
        $array = array();
        foreach ($result as $key => $value) {
            if (is_object($value)) {
                $array[$key] = self::object_2_array(self::object_2_array($value));
            }
            if (is_array($value)) {
                $array[$key] = self::object_2_array(self::object_2_array($value));
            } else {
                $array[$key] = $value;
            }
        }
        return $array;
    }
}
