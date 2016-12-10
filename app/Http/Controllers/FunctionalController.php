<?php

namespace App\Http\Controllers;

use App\College;
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
}
