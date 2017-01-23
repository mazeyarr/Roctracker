<?php

namespace App\Http\Controllers;

use App\Assessors;
use App\College;
use App\Log;
use App\Teamleaders;
use App\TiC;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Validator;

class TeamleaderController extends Controller
{
    public function postChangeTeamleader (Request $request, $id) {
        $teamleader = Teamleaders::find($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'team' => 'max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors("Geen inputs ontavngen !");
        }

        if ($request->change_college) {

            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'team' => 'max:255',
                'college_option' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }

            $option = $request->college_option;
            $college_id = $request->college;


            switch ($option) {
                case "replace":
                    /* TODO: Replace the old college(s) with the new one */
                    $tic = TiC::AssignedCollege($teamleader->id);
                    $message_array = array();
                    if ($tic['count'] > 1) {
                        $count = 1;
                        $college_replacements = array();
                        for ($i = $count; $i <= $tic['count']; $i++) {
                            $property ='college' . $i;
                            $college_replacements[] = $request->$property;
                        }

                        foreach ($tic['tic'] as $key => $link) {
                            $replacement = TiC::find($link);
                            $old = College::find($replacement->fk_college)->name;
                            $replacement->fk_college = $college_replacements[$key];
                            $replacement->save();
                            $message_array[] = "<li>".$old." <strong>Naar</strong> ". College::find($college_replacements[$key])->name ."</li>";
                        }
                    }
                    Log::TeamleaderLog($id, $message_array);
                    return redirect()->route('view_teamleaders', $id)->withSuccess("Wijziging succesvol doorgevoerd !");
                    break;
                case "add":
                    /* TODO: Add a new relation with a college */
                    dd($request);
                    break;
                case "none":
                    /* TODO: Delete every relation in the TIC table */
                    dd($request);
                    break;
            }
        }

        $old['name'] = $teamleader->name;
        $old['team'] = $teamleader->team;
        switch ($this->DetectChange($teamleader, $request->name, $request->team)) {
            case "both":
                $teamleader->name = $request->name;
                $teamleader->team = $request->team;
                $teamleader->save();
                $message = "Naam gewijzigd van <i><strong>". $old['name'] ."</strong></i> naar <i><strong>". $request->name ."</strong></i>.<br> Team gewijzigd van <i><strong>". $old['team'] ."</strong></i> naar <i><strong>". $request->team ."</strong></i>";
                Log::TeamleaderLog($teamleader->id, $message);
                break;
            case "name":
                $teamleader->name = $request->name;
                $teamleader->save();
                $message = "Naam gewijzigd van <i><strong>". $old['name'] ."</strong></i> naar <i><strong>". $request->name ."</strong></i>.";
                Log::TeamleaderLog($teamleader->id, $message);
                break;
            case "team":
                $teamleader->team = $request->team;
                $teamleader->save();
                $message = "Team gewijzigd van <i><strong>". $old['team'] ."</strong></i> naar <i><strong>". $request->team ."</strong></i>";
                Log::TeamleaderLog($teamleader->id, $message);
                break;
            default:
                return redirect()->back()->withWarning("Geen wijzegingen ontvangen !");
                break;
        }

        return redirect()->route('view_teamleaders', $teamleader->id)->withSucces('Wijzeging was succesvol doorgevoerd !');
    }

    private function DetectChange ($object, $value1, $value2) {
        if ($object->name != $value1 && $object->team != $value2) {
            return "both";
        }elseif ($object->name != $value1) {
            return "name";
        }elseif ($object->team != $value2) {
            return "team";
        }else {
            return "none";
        }
    }
}
