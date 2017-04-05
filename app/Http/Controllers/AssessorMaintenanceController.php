<?php

namespace App\Http\Controllers;

use App\Assessors;
use App\Log;
use App\Maintenance;
use App\MaintenanceGroups;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AssessorMaintenanceController extends Controller
{
    public function postPlaceAssessor(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'id_a' => 'required',
            'id_g' => 'required',
        ));

        if ($validator->fails()) {
            return json_encode(false);
        }

        $id_a = $request->id_a;
        $id_g = $request->id_g;
        $replacement = $request->replace_id;
        $group = MaintenanceGroups::find($id_g);
        if (!empty($group)) {
            $participants = json_decode($group->participants, true);
            if ($id_a == "reserve") {
                if (!empty($replacement)) {
                    foreach ($participants['participants'] as $key => $participant) {
                        if ($participant == $replacement) {
                            array_splice($participants['participants'], $key, 1);
                            Assessors::ScheduledForMaintenance($id_a, Maintenance::find($group->fk_maintenances)->from, false);
                            $group->participants = json_encode($participants);
                            $group->save();
                            return json_encode(true);
                        }
                    }
                } else {
                    return json_encode(true);
                }
            } else {
                if (!empty($replacement)) {
                    foreach ($participants['participants'] as $key => $participant) {
                        if ($participant == $replacement) {
                            $participants['participants'][$key] = $id_a;
                            Assessors::ScheduledForMaintenance($id_a, Maintenance::find($group->fk_maintenances)->from, true);
                            $group->participants = json_encode($participants);
                            $group->save();
                            return json_encode(true);
                        }
                    }
                } else {
                    if (count($participants['participants']) < 16) {
                        $participants['participants'][] = $id_a;
                        Assessors::ScheduledForMaintenance($id_a, Maintenance::find($group->fk_maintenances)->from, true);
                        $group->participants = json_encode($participants);
                        $group->save();
                        return json_encode(true);
                    } else {
                        return json_encode(false);
                    }
                }
            }
        }

        return json_encode(false);
    }

    public function postMaintenanceData(Request $request)
    {
        $validate = Validator::make($request->all(), array(
            'id' => 'required',
            'group' => 'required',
            'name' => 'required',
            'value' => 'required',
        ));

        if ($validate->fails()) {
            return json_encode(false);
        }

        $id = $request->id;
        $id_g = $request->group;
        $fieldname = $request->name;
        $value = $request->value;

        $maintenance = Maintenance::find($id);
        if (empty($maintenance)) {
            dd($id);
            return json_encode(false);
        }

        $group = MaintenanceGroups::find($id_g);
        if (empty($group)) {
            return json_encode(false);
        } elseif ($group->fk_maintenances != $id) {
            return json_encode(false);
        }

        $ret = json_encode(false);
        switch ($fieldname) {
            case "title":
                if ($value == "") {
                    return $ret;
                }
                $group->title = $value;
                $group->save();
                return json_encode(true);
                break;
            case "institution":
                if ($value == "") {
                    return $ret;
                }
                $maintenance->institution = $value;
                $maintenance->save();
                return json_encode(true);
                break;
            case "location":
                if ($value == "") {
                    return $ret;
                }
                $maintenance->location = $value;
                $maintenance->save();
                return json_encode(true);
                break;
            case "from":
                if ($value == "") {
                    return $ret;
                }
                if (preg_match("/[a-z]/i", $value)) {
                    return $ret;
                }
                $validate_date = Validator::make($request->all(), array('value' => 'date_format:d-m-Y'));
                if ($validate_date->fails()) {
                    return $ret;
                }
                $from = Carbon::createFromFormat('d-m-Y', $value);
                $maintenance->from = $from->toDateTimeString();
                if (!empty($maintenance->from) && !empty($maintenance->till)) {
                    $till = Carbon::createFromFormat('Y-m-d H:i:s', $maintenance->till);
                    $f = $from;
                    $t = $till;
                    $maintenance->days = $f->diffInDays($t);
                    $maintenance->year = $f->format('Y');
                }
                $maintenance->save();
                $participants = json_decode($group->participants, true);
                foreach ($participants['participants'] as $key => $participant) {
                    Assessors::ScheduledForMaintenance($participant, $maintenance->from, true);
                }
                return json_encode(true);
                break;
            case "till":
                if ($value == "") {
                    return $ret;
                }
                if (preg_match("/[a-z]/i", $value)) {
                    return $ret;
                }
                $validate_date = Validator::make($request->all(), array('value' => 'date_format:d-m-Y'));
                if ($validate_date->fails()) {
                    return $ret;
                }
                $till = Carbon::createFromFormat('d-m-Y', $value);
                $maintenance->till = $till->toDateTimeString();
                if (!empty($maintenance->from) && !empty($maintenance->till)) {
                    $from = Carbon::createFromFormat('Y-m-d H:i:s', $maintenance->from);
                    $f = $from;
                    $t = $till;
                    $maintenance->days = $f->diffInDays($t);
                    $maintenance->year = $f->format('Y');
                }
                $maintenance->save();
                return json_encode(true);
                break;
        }
        return json_encode(false);
    }

    public function getMakeNewGroup()
    {
        $maintenance = new Maintenance();
        $maintenance->institution = "";
        $maintenance->location = "";
        $maintenance->year = date('Y');
        $maintenance->from = Carbon::now()->toDateTimeString();
        $maintenance->till = Carbon::now()->toDateTimeString();
        $maintenance->days = 0;
        $maintenance->save();

        $group = new MaintenanceGroups();
        $group->title = "Groep " . Log::generateRandomString(5);
        $group->participants = '{"participants": []}';
        $group->year = $maintenance->year;
        $group->fk_maintenances = $maintenance->id;
        $group->save();

        return json_encode(true);
    }

    public function getRemoveGroup($id)
    {
        $group = MaintenanceGroups::find($id);
        if (!empty($group)) {
            $participants = json_decode($group->participants, true);
            foreach ($participants['participants'] as $key => $participant) {
                Assessors::ScheduledForMaintenance($participant, Maintenance::find($group->fk_maintenances)->from, false);
            }
            $maintenance = Maintenance::find($group->fk_maintenances);
            $maintenance->delete();
            $group->delete();
            return json_encode(true);
        }
        return json_encode(false);
    }
}
