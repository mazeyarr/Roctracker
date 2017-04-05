<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Assessors extends Model
{
    /**
     * @param null $id
     * @return if $id was not given it will return Collection of all Assessors
     * @else
     * @return Collection of Assessor
     */
    public static function getAssessors($id = null)
    {
        # SECTOR 1
        $assessors = array();

        # SECTOR 2
        if (self::all()->isEmpty()) {
            return null;
        }

        # SECTOR 3
        if (!empty($id)) {
            # SECTOR 3.1
            $assessor = self::find($id);
            /** @returns Collection of $this Model */

            # SECTOR 3.2
            /** If the college #id is not a faulty one */
            if (!empty($assessor->fk_college)) {
                $college = College::find($assessor->fk_college);
                /** $college will become a Collection */
                $assessor->fk_college = $college;
                /** replace the Collection collum "fk_college" with the bounded Collection */
            }

            # SECTOR 3.3
            /** If the teamleader #id is not a faulty one */
            if (!empty($assessor->fk_teamleader)) {
                $teamleader = Teamleaders::find($assessor->fk_teamleader)->name;
                /** Place name from Teamleader in $teamleader */

                # SECTOR 3.3.1
                /** if the Teamleader could be found */
                if (!empty($teamleader)) {
                    $assessor->fk_teamleader = $teamleader;
                    /** replace the Collection collum "fk_teamleader" with the name of the $teamleader */
                }
            }

            # SECTOR 3.4
            $exams = Exams::find($assessor->fk_exams);
            /** @returns Collection of the Exam Model */

            # SECTOR 3.5
            /** if the Model returned Collection */
            if (!empty($exams)) {
                $exams->basictraining = json_decode($exams->basictraining);
                /** replace Collection collum "basictraining" a json decoded version */
                $assessor->fk_exams = $exams;
                /** replace this Collection collum from this $assessor to the Collection of $exams */
            }
            return $assessor;
        }

        /** If $id was not given as a parameter of this __FUNCTION__ */

        # SECTIOR 4
        /** Loop trough all the Assessors */
        foreach (self::all() as $assessor) {
            # SECTOR 4.1
            /** Get college of the assessor by using the bounded foreign key */
            $college = College::find($assessor->fk_college);

            # SECTOR 4.2
            /** replace Collection "fk_college" field with a Collection of the college
             * @note that if college is not found it wil return null
             */
            $assessor->fk_college = $college;

            # SECTOR 4.3
            /** Get teamleader of the assessor by using the bounded foreign key */
            $teamleader = Teamleaders::find($assessor->fk_teamleader);

            # SECTOR 4.4
            /** if the $teamleader is not null */
            if (!empty($teamleader)) {
                /** replace Assessor Collection "fk_teamleader" field to the teamleader name */
                $assessor->fk_teamleader = $teamleader->name;
            }

            # SECTOR 4.5
            /** find the Exams data that belongs to this assessor
             * @note that every assessor has exam data
             */
            $exams = Exams::find($assessor->fk_exams);

            # SECTOR 4.6
            /** if $exams does not return a null value */
            if (!empty($exams)) {
                # SECTOR 4.6.1
                /** replace the $exams(Collection) "basictraining" field to a json decoded version*/
                $exams->basictraining = json_decode($exams->basictraining);

                # SECTOR 4.6.2
                /** replace the Assessor(Collection) "fk_exams" to the new temporary $exams Collection*/
                $assessor->fk_exams = $exams;
            }
            $assessors[] = $assessor;
            /** add new (temp) made assessor to array with all the others */
        }

        return $assessors;
    }

    /**
     * @param $id "ID of an Assessor"
     * @param $date "(DateTime 'Y-m-d H:i:s') Date of which the maintenance will start"
     * @param $place "(bool) if u want to place assessor in group"
     * @return bool "True or False"
     */
    public static function ScheduledForMaintenance($id, $date, $place)
    {
        /** @var  $assessor Collection */
        $assessor = self::find($id);

        /** if $assessor Collection is null */
        if (empty($assessor)) {
            return false;
        }

        /**
         * @function: whatKindOfMaintenance($id)
         * @param $id ID of the Assessor
         * @returns string
         */
        $type = Maintenance::whatKindOfMaintenance($id);

        /** If assessor needs to be placed in maintenance mode */
        if ($place) {
            # if assessor needs to do an maintenance
            if ($type == "maintenance") {
                $exam = Exams::find($assessor->fk_exams);

                /** Create a DateTime format*/
                $exam->training_next_on = Carbon::createFromFormat('Y-m-d H:i:s', $date)->toDateString();
                $exam->save();

                /** We Log this change to the log of this assessor */
                Log::AssessorLog($id, "Is aangemeld om op onderhoud te gaan voor " . Carbon::createFromFormat('Y-m-d H:i:s', $date)->toDateString());
            }

            # if assessor needs to do an Exam
            if ($type == "exam") {
                $exam = Exams::find($assessor->fk_exams);

                /** Create a DateTime format*/
                $exam->exam_next_on = Carbon::createFromFormat('Y-m-d H:i:s', $date)->toDateString();
                $exam->save();

                /** We Log this change to the log of this assessor */
                Log::AssessorLog($id, "Is aangemeld om op examen te gaan voor " . Carbon::createFromFormat('Y-m-d H:i:s', $date)->toDateString());
            }
        } else {
            /** If this assessor does not have to be placed in maintenance
             * We will reset the dates
             */
            if ($type == "maintenance") {
                $exam = Exams::find($assessor->fk_exams);
                $exam->training_next_on = null;
                $exam->save();
            }

            if ($type == "exam") {
                $exam = Exams::find($assessor->fk_exams);
                $exam->exam_next_on = null;
                $exam->save();
            }
        }
    }
}
