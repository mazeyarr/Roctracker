<?php

namespace App\Http\Controllers;

use App\Colleges;
use App\Teamleaders;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Input;

class DashboardController extends Controller
{
    public function postNewColleges (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:colleges',
            'location' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput(Input::all());
        }

        $college = new Colleges();
        $college->name = $request->name;
        $college->location = $request->location;
        $college->teamleader_id = ($request->teamleader == 'default') ? null : $request->teamleader;
        $college->save();

        if ($request->teamleader != 'default') {
            $teamleader = Teamleaders::find($request->teamleader);
            if (empty($teamleader)) {
                $warning = 'Waarschuwing! Teamleider kon niet worden toegevoegd';
            }else {
                $teamleader->college_id = $college->id;
                $teamleader->save();
            }
        }

        if (isset($warning)) {
            return redirect()->route('add_college')->withSuccess('College is toegevoegd aan het systeem !')->withWarning($warning)->withCollege($college);
        }
        return redirect()->route('add_college')->withSuccess('College is toegevoegd aan het systeem !')->withCollege($college);

    }

    public function ajaxChangeCollege ($id, $name, $location, $teamleader) {
        $data = array(
            'status' => 'error'
        );
        $id = (!empty($id)) ? $id : null;
        $name = (!empty($name) && $name != '') ? $name : null;
        $location = (!empty($location) && $location != '') ? $location : null;
        $teamleader = (!empty($teamleader) && $teamleader != '') ? $teamleader : null;

        if ($id == null) {
            $data['message'] = 'Fatal error {id missing}';
            die(json_encode($data));
        }

        if ($name == null) {
            $data['message'] = 'Naam was leeg';
            die(json_encode($data));
        }

        if ($location == null) {
            $data['message'] = 'Locatie was leeg';
            die(json_encode($data));
        }

        if ($teamleader == null) {
            $data['message'] = 'Teamleider was leeg';
            die(json_encode($data));
        }

        if ( empty(Colleges::find($id)) ) {
            $data['message'] = 'Fatal error {Collage id niet gevonden}';
            die(json_encode($data));
        }

        $college = Colleges::find($id);
        if ($teamleader != 'default') {
            if (!is_null($college->teamleader_id)) {
                $old_teamleader = Teamleaders::find(Colleges::find($id)->teamleader_id);
                if ($old_teamleader->id == $teamleader) {
                    $data['message'] = 'Teamleider zit al bij een college!';
                    die(json_encode($data));
                }
                $old_teamleader->college_id = null;
                $old_teamleader->save();
            }
        }
        $college->name = $name;
        $college->location = $location;
        ($teamleader != 'default') ? $college->teamleader_id = $teamleader : null;
        $college->save();
        if ($teamleader != 'default') {
            $leader = Teamleaders::find($teamleader);
            $leader->college_id = $college->id;
            $leader->save();
        }

        $data['status'] = 'success';
        $data['message'] = 'College aangepast!';

        die(json_encode($data));

    }
}
