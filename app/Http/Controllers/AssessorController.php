<?php

namespace App\Http\Controllers;

use App\Assessors;
use App\Exams;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AssessorController extends Controller
{
    public function postChangeAssessor ($id, Request $request) {
        $assessor = Assessors::find($id);
        $assessor->fk_college = $request->college;
        $assessor->name = $request->name;
        $assessor->team = $request->team;
        $assessor->save();
        return redirect()->route('assessors')->withSuccess('Assessor saved !');
    }
}
