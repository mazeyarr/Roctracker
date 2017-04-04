<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * This class will manage all the maintenance groups that "have" been made by this class
 *
 * Class MaintenanceGroups
 * @package App
 */
class MaintenanceGroups extends Model
{
    /**
     * This function will retrieve all the made groups in this year
     *
     * @return Collection Array
     */
    public static function GetGroups () {
        $groups = self::where('year', '>=', date('Y'))->get();

        # If there are no groups, this function will return null
        if (empty($groups)) {
            return null;
        }

        foreach ($groups as $group) {
            # We decode the participants json, this will return all the id`s of the assessors participating
            $group->participants = json_decode($group->participants);
            foreach ($group->participants->participants as $key => $assessor) {
                # Next we (temporary) change the object to add all the Assessors as Collection classes
                $group->participants->participants[$key] = Assessors::find($assessor);
            }

            # We also change the "fk_maintenances" field to the Maintenance Model (by the foreign key (fk_maintenances) )
            $group->fk_maintenances = Maintenance::find($group->fk_maintenances);
        }
        return $groups;
    }
}
