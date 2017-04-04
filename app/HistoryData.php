<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class HistoryData extends Model
{
    /**
     * This function will generate data for the Dashboard graphs
     *
     * @return array
     */
    public static function generate()
    {
        $data = array();
        foreach (College::all() as $college) {
            # $current = The current year
            # $should  = How many actieve assessors there is needed at the end of the year
            # $count   = Count of all the active assessors
            $data[$college->id] = array(
                'current' => date('Y'),
                'should' => 1 + round(Assessors::where('fk_college', $college->id)->where('status', 1)->count() / 100 * 110),
                'count' => Assessors::where('fk_college', $college->id)->where('status', 1)->count()
            );
        }
        return $data;
    }

    /**
     * This complex function will get all the history data of the College by $id
     *
     * @param $id
     * @return string
     */
    public static function CollegeData($id)
    {
        # Initialize variables
        $data = array();
        $current = Assessors::where('fk_college', $id)->where('status', 1)->get();

        # If there are no active assessors in this college
        if (!empty($current)) {

            # We make a Carbon date by transforming the current date as if it was the very start of the year.
            $currentKeyDate = Carbon::now()->startOfYear()->toDateString();

            # This array will contain the total amount of each assessors profession
            $currentProfessions = array();
            foreach ($current as $assessor) {
                if (array_key_exists($assessor->profession, $currentProfessions)) {
                    # if the profession already exist in this college we just add an integer to it.
                    $currentProfessions[$assessor->profession]++;
                }else {
                    # if the profession did not exist in the profession array we add this profession as a key
                    $currentProfessions[$assessor->profession] = 1;
                }
            }

            # Now the current status and data of the college is saved to the array with the current date as the key
            $data[$currentKeyDate] = $currentProfessions;
        }

        # Next we get all rows where the collegeid field is equal to the $id given as the __FUNCTION__ parameter
        $dataHistory = HistoryData::where('created_at', '<', Carbon::now()->startOfYear())->where('collegeid', $id)->get();

        foreach ($dataHistory as $collegeData) {
            # We decode this CollegeData assessors (Collections)
            $dataHistory_assessors = json_decode($collegeData->assessors);

            # We make a Carbon date by transforming the created_at date as if it was the very start of the year.
            $keyDate = Carbon::createFromFormat('Y-m-d H:i:s', $collegeData->created_at)->startOfYear()->toDateString();

            # This array will contain the amou
            $professions = array();
            foreach ($dataHistory_assessors as $assessor) {
                if ($assessor->status != 1) {
                    continue;
                }
                if (array_key_exists($assessor->profession, $professions)) {
                    # if the profession already exist in this college we just add an integer to it.
                    $professions[$assessor->profession]++;
                }else {
                    # if the profession did not exist in the profession array we add this profession as a key
                    $professions[$assessor->profession] = 1;
                }
            }

            # Now the status and data of the college is saved to the array with the created_at date as the key
            $data[$keyDate] = $professions;
        }

        # This array will store all the professions that this college has ever had,
        # this is done to make this function dynamic and give user more freedom
        $diffrentLabels = array();
        foreach ($data as $year_professions) {
            foreach ($year_professions as $profession => $actieve_assessors) {
                # If the profession already exist in this array
                if (!array_key_exists($profession, $diffrentLabels)) {
                    # we just add this profession as a key and value it to a null value
                    $diffrentLabels[$profession] = null;
                }
            }
        }

        # Next we loop trough all the HistoryData of this college
        foreach ($data as $bar => $barData) {
            foreach ($diffrentLabels as $label => $null) {
                # For each profession that exists in this college
                if (!array_key_exists($label, $barData)){
                    # If this profession does not exist in this the year that is looped trough,
                    # we only add this profession, but we value it to a 0 (integer)
                    $data[$bar][$label] = 0;
                }
            }
        }

        # Next we begin to make an acceptable json object that our view can transform into a graph
        $dataBars = array();
        foreach ($diffrentLabels as $dataBar => $null) {
            # We initialize an iterator
            $i = 0;
            foreach ($data as $bar => $barData) {
                $dataBars[$dataBar][] = array(
                    0 => Carbon::createFromFormat('Y-m-d', $bar)->format("d/m/Y"),
                    1 => $barData[$dataBar]
                );
                $i++;
            }
        }
        return json_encode($dataBars);
    }
}
