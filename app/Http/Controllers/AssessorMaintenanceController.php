<?php

namespace App\Http\Controllers;

use App\Functions;
use App\Log;
use App\Maintenance;
use App\MaintenanceGroups;
use App\SystemLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AssessorMaintenanceController extends Controller
{
    public function postNewDates($count, Request $request) {
        # Sector 1
        if ($count == 0) {
            SystemLog::LOG(__FUNCTION__,'SECTOR 1', "Givin parameter {count} was 0", Auth::user()->id);
            return redirect()->back()->withErrors('Systeem fout, parameter was 0');
        }

        # Sector 2
        for ($i = 1; $i <= $count ; $i++) {
            $rules = array(
                'institution-'.$i => 'required',
                'location-'.$i => 'required',
                'date-from-'.$i => 'required|date_format:d/m/Y - H:i',
                'date-till-'.$i => 'required|date_format:d/m/Y - H:i',
            );

            # Sector 2.1
            $validator = Validator::make($request->all(), $rules);

            # Sector 2.2
            if ($validator->fails()) {
                return redirect()->back()->withErrors('Datums was niet correct ingevuld.');
            }

            $propInstitution = "institution-".$i;
            $propLocation = "location-".$i;
            $propDateFrom = "date-from-".$i;
            $propDateTill = "date-till-".$i;
            $days = Functions::DiffDays($request->$propDateFrom, $request->$propDateTill, 'd/m/Y - H:i');

            $NewDates = new Maintenance();
            $NewDates->institution = $request->$propInstitution;
            $NewDates->location = $request->$propLocation;
            $NewDates->from = date_format(date_create_from_format('d/m/Y - H:i', $request->$propDateFrom), 'Y-m-d H:i:s');
            $NewDates->till = date_format(date_create_from_format('d/m/Y - H:i', $request->$propDateTill), 'Y-m-d H:i:s');
            $NewDates->year = date_format(date_create_from_format('d/m/Y - H:i', $request->$propDateFrom), 'Y');
            $NewDates->days = $days == 0 ? 1 : $days;
            $NewDates->save();
        }

        return redirect()->route('maintenance_assessor')->withSuccess('Datums zijn succesvol opgeslagen !');
    }
}
