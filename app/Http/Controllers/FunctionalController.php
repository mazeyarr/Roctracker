<?php

namespace App\Http\Controllers;

use App\Assessors;
use App\College;
use App\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class FunctionalController extends Controller
{
    public function ajaxSaveCollege ($id, $name, $location) {
        if (!is_numeric($id)) {
            return json_encode(array('result' => 'failed'));
        }
        $college = College::find($id);
        $college->name = $name;
        $college->location = $location;
        $college->save();
        return json_encode(array('result' => 'executed'));
    }

    public function ajaxSaveAssessorToCollege ($id, $college_id) {

        $parameters = array(
          'id' => $id,
          'college_id' => $college_id
        );
        $validator = Validator::make($parameters, [
            'id' => 'required|max:255',
            'college_id' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return json_encode(array('result' => 'failed'));
        }

        $assessor = Assessors::find($id);
        if (empty($assessor)) {
            return json_encode(array('result' => 'failed'));
        }
        $old_college = $assessor->fk_college;
        if ($college_id == "off") {
            $assessor->status = 0;
            $assessor->save();
            Log::AssessorLog($id, 'College veranderd, Assessor is hierbij op non-actief gezet');
        }else {
            $assessor->fk_college = $college_id;
            $assessor->save();
            Log::AssessorLog($id, 'College veranderd, van <strong>'. (College::find($old_college)->name) . '</strong> Naar <strong>' . (College::find($assessor->fk_college)->name) . '</strong>' );
        }
        return json_encode(array('result' => 'executed'));
    }
}
