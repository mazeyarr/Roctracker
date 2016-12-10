<?php

namespace App\Http\Controllers;

use App\Assessors;
use App\College;
use App\Log;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Validator;

class CollegeController extends Controller
{
    public function postChangeCollege (Request $request, $id) {
        switch ($request->assessor_option) {
            case 'selection':
                return view('college.selection')->withCollegeID($id)->withCollege(College::all())->withAssessors(Assessors::where('fk_college', '=', $id)->get());
                break;
            case 'overwrite':
                $validator = Validator::make($request->all(), [
                    'name' => 'required|max:255',
                    'location' => 'required|max:255',
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator);
                }

                $college = College::find($id);
                $name = $college->name;
                $location = $college->location;

                $name = ($name != $request->name) ? true : false;
                $location = ($location != $request->location) ? true : false;
                $change_both = ($name==true && $location==true) ? true : false;
                if ($name == false && $location == false) {
                    return redirect()->route('change_colleges', $id)->withWarning('Geen veranderingen plaatsgevonden');
                }

                $message = null;
                $old_college['name'] = $college->name;
                $old_college['location'] = $college->location;
                if ($change_both==true){
                    $college->name = $request->name;
                    $college->location = $request->location;
                    $message = 'College naam van<strong> ' . $old_college['name'] . ' </strong>naar <strong>' . $request->name.'</strong>' . 'en Locatie van <strong>' . $old_college['location'] . '</strong> naar <strong>' . $request->location . '</strong>';
                }elseif ($name==true) {
                    $college->name = $request->name;
                    $message = 'College naam van<strong> ' . $old_college['name'] . ' </strong>naar <strong>' . $request->name.'</strong>';
                }elseif ($location==true) {
                    $college->location = $request->location;
                    $message = 'Locatie van <strong>' . $old_college['location'] . '</strong> naar <strong>' . $request->location . '</strong>';
                }
                $college->save();
                Log::CollegeLog($id, $message);

                $asigned_assessors = Assessors::where('fk_college', '=', $id)->get();
                foreach ($asigned_assessors as $assessor) {
                    $data = json_decode($assessor->log, true);
                    $key = Log::generateRandomString(50);
                    $data['log'][$key]['date'] = Carbon::now('Europe/Amsterdam')->format('d-m-Y');
                    $data['log'][$key]['by']['id'] = Auth::user()->id;
                    $data['log'][$key]['by']['name'] = Auth::user()->name;
                    if ($change_both==true){
                        $message = 'College naam van<strong> ' . $old_college['name'] . ' </strong> naar <strong>' . $request->name.' </strong> ' . ' en Locatie van <strong>' . $old_college['location'] . ' </strong> naar <strong> ' . $request->location . '</strong>';
                        Log::AssessorLog($assessor->id, $message);
                    }elseif ($name==true) {
                        $message = 'College naam van<strong> ' . $old_college['name'] . ' </strong> naar <strong>' . $request->name.' </strong> ';
                        Log::AssessorLog($assessor->id, $message);
                    }elseif ($location==true) {
                        $message = 'College Locatie van <strong>' . $old_college['location'] . ' </strong> naar <strong> ' . $request->location . ' </strong> ';
                        Log::AssessorLog($assessor->id, $message);
                    }
                }
                return redirect()->route('view_colleges', $id);
                break;
            case 'disable':
                $asigned_assessors = Assessors::where('fk_college', '=', $id)->get();
                foreach ($asigned_assessors as $assessor) {

                }
                break;
        }
    }
}
