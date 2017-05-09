<?php

namespace App;

use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * This class will perform updates, saves, and changes to every assessors exam data.
 * It also checks if assessors need maintenance
 *
 * Class Exams
 * @package App
 */
class Exams extends Model
{
    /**
     * This function will check every assessor for maintenance,
     * if there are assessors that need maintenance, it will return an array with:
     *  * Assessor (Collection)
     *  * Type maintenance (string: Examen, Onderhoud)
     *  * Data (Collection: Exam Collection from the assessor)
     * @return array|null
     */
    public static function MaintenanceUpdate()
    {
        # We initialize our variables
        $need_maintenance = null;
        $assessors = Assessors::all();

        # SECTOR 1
        foreach ($assessors as $assessor) {
            # We check every assessor for required maintenance
            $exam = self::find($assessor->fk_exams);

            # SECTOR 1.1
            if (empty($exam)) {
                # this is highly unlikely, but we will Log this error to the system log
                SystemLog::LOG(__FUNCTION__, 'SECTOR 1.1', "Exam was empty, Assessor: " . $assessor->id, Auth::user()->id);
                continue;
            }

            # SECTOR 1.2
            # We decode the basictraining json data.
            $basictraining = json_decode($exam->basictraining);

            # SECTOR 1.3
            # If this assessor did not graduate his basictraining he does not require basictraining.
            if (!$basictraining->passed) {
                continue;
            }

            # SECTOR 1.4
            # if the assessor passed his basictraining and does not have a second training date,
            # We cannot calculate if this assessor needs a maintenance.
            if ($basictraining->graduationday == null) {
                continue;
            }

            # SECTOR 1.5
            # if the current year is equal the year this assessor received his basictraining certificate
            # In that case this assessor does not require maintenance.
            if (date('Y') == date_format(date_create_from_format('d-m-Y', $basictraining->graduationday), 'Y')) {
                continue;
            }

            # SECTOR 1.6
            # if the last basictraining date is equal to the current year + 1 year
            # In that case this assessor does not require maintenance
            elseif (date('Y') == date_format(date_create_from_format('d-m-Y', $basictraining->graduationday), 'Y') + 1) {
                continue;
            }

            # SECTOR 1.7
            # If this assessor has passed 4 maintenance's,
            # In that case this assessor needs to be applied for "Exam" type maintenance.
            if ($exam->training_done == 4) {
                $need_maintenance[] = array(
                    'assessor' => $assessor,
                    'type' => 'Examen',
                    'data' => $exam
                );
                # If this assessor has passed below 4 maintenance`s,
                # In that case this assessor is required to be applied for an standard maintenance.
            } else {
                $need_maintenance[] = array(
                    'assessor' => $assessor,
                    'type' => 'Onderhoud',
                    'data' => $exam
                );
            }
        }
        return $need_maintenance;
    }

    /**
     * This function will simply return a json decoded of the Assessors basictraining
     *
     * @param $id
     * @return bool|mixed
     */
    public static function getBasictraining($id)
    {
        $exam = self::find($id);
        if (empty($exam)) {
            return false;
        }
        return json_decode($exam->basictraining);
    }

    /**
     * This function will save the given parameter $object as an basictraining to the Assessors Exam data
     *
     * @param $id
     * @param null $object
     * @return bool
     */
    public static function saveBasictraining($id, $object = null)
    {
        $exam = self::find($id);
        if (empty($object)) {
            return false;
        }
        if (empty($exam->last_maintenance)) {
            if ($object->graduationday != "") {
                $exam->training_done = self::calcTrainingDone($object->graduationday, 'd-m-Y');
            }
        };
        $exam->basictraining = json_encode($object);
        $exam->save();

        return $exam;
    }

    /**
     * For each new made Assessor, this function is called to make a default Exam model,
     * The parameters will determine how the Exam data will be saved
     *
     * @param bool $training
     * @param null $last_training
     * @return mixed
     */
    public static function NewAssessor($training = false, $last_training = null)
    {
        $exam = new self();

        # If this Assessor passed his basictraining,
        # All values will be set to true. the parameter $last_training will be save ass a "dd-mm-yyyy"
        #
        # If this Assessor did not pass his basictraining, this Assessor will get a standard formulated basictraining json
        if ($training) {

            $exam->basictraining = json_encode(array (
                'passed' => true,
                'requirements' =>
                    array (
                        'video' => true,
                        'portfolio' => true,
                        'CV' => true,
                    ),
                'date1' => array (
                    'present' => true,
                    'date' => $last_training,
                ),
                'date2' => array (
                    'present' => true,
                    'date' => $last_training,
                ),
                'graduationday' => $last_training,
                'graduated' => true,
            ));
        } else {
            $exam->basictraining = json_encode(array (
                'passed' => false,
                'requirements' =>
                    array (
                        'video' => false,
                        'portfolio' => false,
                        'CV' => false,
                    ),
                'date1' => array (
                    'present' => false,
                    'date' => null,
                ),
                'date2' => array (
                    'present' => false,
                    'date' => null,
                ),
                'graduationday' => null,
                'graduated' => false,
            ));
        }

        # The amount a maintenances will be set to 0
        $training_done = 0;

        # If there was no given $last_training, will skip the maintenance/exam calculation.
        if (!empty($last_training)) {
            # If there was a date given we will calculate the next type of maintenance needed
            $training_done = self::calcTrainingDone($last_training, 'd-m-Y');
        }
        $exam->exam_next_on = null; # Default data is set to prevent database error.
        $exam->training_next_on = null; # Default data is set to prevent database error.
        $exam->training_done = $training_done; # Amount is set based on the calculation above
        $exam->log = '{}'; # Empty Log json is made
        $exam->save();
        return $exam->id; # we return the Exam id to save this (foreign_key (fk_) ) to the new made Assessor.
    }

    /**
     * This function will return an integer of the amount a maintenance`s done by this assessor.
     * @NOTE: THIS FUNCTION WILL CALCULATE AS IF THE ASSESSOR HAS BEEN TROUGH ALL MAINTENANCES.
     * @WARNING: FUNCTION DOES NOT ACCOUNT FOR HUMAN ERROR.
     *
     * @param $basictraining_date
     * @param $format
     * @return int
     */
    public static function calcTrainingDone($basictraining_date, $format)
    {
        # We make a Carbon object based on the given basictraining date
        $begin = Carbon::parse(date_format(date_create_from_format($format, $basictraining_date), 'Y-m-d'));

        # Now we make a Carbon object based on the current date
        $end = Carbon::parse(date_format(date_create_from_format('d-m-Y', Carbon::now()->format('d-m-Y')), 'Y-m-d'));

        # We calculate the difference in years
        $diff = $end->diffInYears($begin);

        # if the difference is below 4, the next maintenance type will be "Onderhoud"
        if ($diff >= 4) {
            $training_done = 4;

            # if the diffrence is equal to 1 year this assessor is not required to be applied for maintenance
        } elseif ($diff == 1) {
            $training_done = 0;

            # Else we will just place the differance value in the database,
            # (Minus 1 because an assessor is not required to be applied for maintenance, after the first year of the basictraining)
        } else {
            $training_done = $diff - 1;
        }

        if ($training_done < 0) {
            $training_done = 0;
        }
        return $training_done;
    }
}
