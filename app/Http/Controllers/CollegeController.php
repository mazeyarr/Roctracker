<?php

namespace App\Http\Controllers;

use App\Assessors;
use App\College;
use App\Log;
use App\Teamleaders;
use App\TiC;
use Illuminate\Http\Request;
use Validator;

class CollegeController extends Controller
{
    public function postChangeCollege(Request $request, $id)
    {
        switch ($request->assessor_option) {
            case 'selection':
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
                $change_both = ($name == true && $location == true) ? true : false;
                if ($name == false && $location == false) {
                    return redirect()->route('change_colleges', $id)->withWarning('Geen veranderingen plaatsgevonden.');
                }

                $message = null;
                $old_college['name'] = $college->name;
                $old_college['location'] = $college->location;
                if ($change_both == true) {
                    $college->name = $request->name;
                    $college->location = $request->location;
                    $message = 'College naam van<strong> ' . $old_college['name'] . ' </strong>naar <strong>' . $request->name . '</strong>' . 'en Locatie van <strong>' . $old_college['location'] . '</strong> naar <strong>' . $request->location . '</strong>';
                } elseif ($name == true) {
                    $college->name = $request->name;
                    $message = 'College naam van<strong> ' . $old_college['name'] . ' </strong>naar <strong>' . $request->name . '</strong>';
                } elseif ($location == true) {
                    $college->location = $request->location;
                    $message = 'Locatie van <strong>' . $old_college['location'] . '</strong> naar <strong>' . $request->location . '</strong>';
                }
                $college->save();
                Log::CollegeLog($id, $message);

                $asigned_assessors = Assessors::where('fk_college', '=', $id)->get();
                if (!empty($asigned_assessors)) {
                    foreach ($asigned_assessors as $assessor) {
                        if ($change_both == true) {
                            $message = 'College naam van<strong> ' . $old_college['name'] . ' </strong> naar <strong>' . $request->name . ' </strong> ' . ' en Locatie van <strong>' . $old_college['location'] . ' </strong> naar <strong> ' . $request->location . '</strong>';
                            Log::AssessorLog($assessor->id, $message);
                        } elseif ($name == true) {
                            $message = 'College naam van<strong> ' . $old_college['name'] . ' </strong> naar <strong>' . $request->name . ' </strong> ';
                            Log::AssessorLog($assessor->id, $message);
                        } elseif ($location == true) {
                            $message = 'College Locatie van <strong>' . $old_college['location'] . ' </strong> naar <strong> ' . $request->location . ' </strong> ';
                            Log::AssessorLog($assessor->id, $message);
                        }
                    }
                }

                return redirect()->route('change_college_assessors', array($id, $request->name, $request->location));
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
                $change_both = ($name == true && $location == true) ? true : false;
                if ($name == false && $location == false) {
                    return redirect()->route('change_colleges', $id)->withWarning('Geen veranderingen plaatsgevonden');
                }

                $message = null;
                $old_college['name'] = $college->name;
                $old_college['location'] = $college->location;
                if ($change_both == true) {
                    $college->name = $request->name;
                    $college->location = $request->location;
                    $message = 'College naam van<strong> ' . $old_college['name'] . ' </strong>naar <strong>' . $request->name . '</strong>' . 'en Locatie van <strong>' . $old_college['location'] . '</strong> naar <strong>' . $request->location . '</strong>';
                } elseif ($name == true) {
                    $college->name = $request->name;
                    $message = 'College naam van<strong> ' . $old_college['name'] . ' </strong>naar <strong>' . $request->name . '</strong>';
                } elseif ($location == true) {
                    $college->location = $request->location;
                    $message = 'Locatie van <strong>' . $old_college['location'] . '</strong> naar <strong>' . $request->location . '</strong>';
                }
                $college->save();
                Log::CollegeLog($id, $message);

                $asigned_assessors = Assessors::where('fk_college', '=', $id)->get();
                if (!empty($asigned_assessors)) {
                    foreach ($asigned_assessors as $assessor) {
                        if ($change_both == true) {
                            $message = 'College naam van<strong> ' . $old_college['name'] . ' </strong> naar <strong>' . $request->name . ' </strong> ' . ' en Locatie van <strong>' . $old_college['location'] . ' </strong> naar <strong> ' . $request->location . '</strong>';
                            Log::AssessorLog($assessor->id, $message);
                        } elseif ($name == true) {
                            $message = 'College naam van<strong> ' . $old_college['name'] . ' </strong> naar <strong>' . $request->name . ' </strong> ';
                            Log::AssessorLog($assessor->id, $message);
                        } elseif ($location == true) {
                            $message = 'College Locatie van <strong>' . $old_college['location'] . ' </strong> naar <strong> ' . $request->location . ' </strong> ';
                            Log::AssessorLog($assessor->id, $message);
                        }
                    }
                }
                return redirect()->route('view_colleges', $id)->withSuccess('Aanpasing opgeslagen en uitgevoerd!');
                break;
            case 'disable':
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
                $change_both = ($name == true && $location == true) ? true : false;

                $message = null;
                $old_college['name'] = $college->name;
                $old_college['location'] = $college->location;
                if ($change_both == true) {
                    $college->name = $request->name;
                    $college->location = $request->location;
                    $message = 'College naam van<strong> ' . $old_college['name'] . ' </strong>naar <strong>' . $request->name . '</strong>' . 'en Locatie van <strong>' . $old_college['location'] . '</strong> naar <strong>' . $request->location . '</strong>. <br> Assesoren zijn op non-actief gezet.';
                } elseif ($name == true) {
                    $college->name = $request->name;
                    $message = 'College naam van<strong> ' . $old_college['name'] . ' </strong>naar <strong>' . $request->name . '</strong>. <br> Assesoren zijn op non-actief gezet.';
                } elseif ($location == true) {
                    $college->location = $request->location;
                    $message = 'Locatie van <strong>' . $old_college['location'] . '</strong> naar <strong>' . $request->location . '</strong>. <br> Assesoren zijn op non-actief gezet.';
                } elseif ($name == false && $location == false) {
                    $message = 'Geen verandering plaatsgevonden in <strong>' . $old_college['name'] . '</strong> Maar alle Assesoren zijn op non-actief gezet';
                }
                $college->save();
                Log::CollegeLog($id, $message);

                $asigned_assessors = Assessors::where('fk_college', '=', $id)->get();
                foreach ($asigned_assessors as $assessor) {
                    $assessor->status = 0;
                    $assessor->save();
                    Log::AssessorLog($assessor->id, $old_college['name'] . ' Is veranderd, Assessoren in dit college zijn op non-actief gezet');
                }
                return redirect()->route('view_colleges', $id)->withSuccess('Aanpasing opgeslagen en uitgevoerd!');
                break;
        }
    }

    public function getChangeAssessorsSelection($id, $collegename, $collegelocation)
    {
        return view('college-change-selection')->withCollege_current(College::find($id))->withNewname($collegename)->withNewlocation($collegelocation)->withColleges(College::all())->withAssessors(Assessors::where('fk_college', '=', $id)->get());
    }

    public function getDeleteCollege($id)
    {
        $college = College::find($id);
        if (empty($college)) {
            return redirect()->back()->withErrors("College was niet gevonden om te verwijderen");
        }

        $tic = TiC::where('fk_college', $college->id)->first();
        if (!empty($tic)) {
            $teamleader = Teamleaders::find($tic->fk_teamleader);
            Log::TeamleaderLog($teamleader->id, "College: '" . $college->name . "' was uit het systeem verwijderd");
            $tic = TiC::find($tic->id);
            $tic->delete();
        }

        $assessors = Assessors::where('fk_college', $college->id)->get();
        foreach ($assessors as $assessor) {
            $assessor->fk_college = null;
            $assessor->fk_teamleader = null;
            Log::AssessorLog($assessor->id, "College: '" . $college->name . "' was uit het systeem verwijderd");
            $assessor->save();
        }

        $college->delete();

        return redirect()->back()->withSuccess("College was successvol verwijderd");
    }

    public function postNewCollege(Request $request)
    {
        $validate = Validator::make($request->all(), array(
            'name' => 'required|max:250',
        ), array(
            'name.max' => 'College naam mag niet groter dan 250 karakters zijn',
            'location.required' => 'Locatie veld is verplicht'
        ));
        if ($validate->fails()) {
            return back()->withErrors($validate->getMessageBag());
        }

        $college = new College();
        $college->name = $request->name;
        $college->location = "";
        $college->log = "{}";
        $college->save();
        Log::CollegeLog($college->id, $college->name . " Toegevoegd aan het systeem");
        if ($request->teamleader != "geen") {
            $validate_teamleader = Validator::make($request->all(), array(
                'teamleader' => 'numeric'
            ));
            if ($validate_teamleader->fails()) {
                return back()->withErrors('Teamleder veld was incorrect ingevuld');
            }
            $tic = new TiC();
            $tic->fk_teamleader = $request->teamleader;
            $tic->fk_college = $college->id;
            $tic->save();
            Log::CollegeLog($college->id, "<i>" . Teamleaders::find($tic->fk_teamleader)->name . "</i> Is nu teamleider van <i>" . $college->name . "</i>");
            Log::TeamleaderLog($tic->fk_teamleader, "<i>" . Teamleaders::find($tic->fk_teamleader)->name . "</i> Is nu teamleider van <i>" . $college->name . "</i>");
        }
        return redirect()->route('colleges', $college->id)->withSuccess('College Opgeslagen !');
    }

    public function getCollegeDetails($id)
    {
        $college = College::find($id);
        if (empty($college)) {
            return redirect()->back()->withErrors("Dit College bestaat niet in het systeem");
        }

        return view('college-details')->withCollege($college);
    }
}
