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

            switch ($option) {
                case "replace":
                    $message_array = array();
                    $i_current_colleges = TiC::where("fk_teamleader", "=", $teamleader->id)->count();
                    $rules = array();
                    for ($i = $i_current_colleges; $i > 0; $i--) {
                        $rules['college'.$i] = 'required';
                    }

                    foreach ($rules as $rule => $check){
                        $count = count($rules);
                        for ($i = $count; $i > 0; $i--) {
                            $number = str_replace("college", "", $rule);
                            ($i != $number) ? $check = $check . "|different:college".$i : null;
                        }
                        $rules[$rule] = $check;
                    }

                    $validator = Validator::make($request->all(), $rules);
                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator);
                    }

                    $links = TiC::where("fk_teamleader", "=", $teamleader->id)->get();
                    $old = array();
                    if (!$links->isEmpty()) {
                        foreach ($links as $teamleaders_in_colleges) {
                            $old[] = "<li>".College::find($teamleaders_in_colleges->fk_college)->name."</li>";
                            $teamleaders_in_colleges->delete();
                        }
                    }

                    for ($i = $i_current_colleges; $i > 0; $i--) {
                        $property = "college".$i;
                        if ($request->$property != "none") {
                            $teamleaders_in_college = new TiC();
                            $teamleaders_in_college->fk_teamleader = $teamleader->id;
                            $teamleaders_in_college->fk_college = $request->$property;
                            $teamleaders_in_college->save();
                            $message_array[] = "<li>" . College::find($teamleaders_in_college->fk_college)->name . "</li>";
                        }else {
                            $message_array[] = "<li> Geen </li>";
                        }
                    }

                    $list_start = "<ul>";
                    $list_end = "</ul>";
                    foreach ($old as $item) {
                        $list_start = $list_start . $item;
                    }
                    $list_start = $list_start.$list_end;
                    $list = $list_start . "<br> Door:";
                    $intro = "De college(s) waar <strong>". $teamleader->name ."</strong> teamleider van was, zijn vervangen. <br><br> De volgende college(s) zijn vervangen:";

                    Log::TeamleaderLog($id, array_reverse($message_array), $intro, $list);
                    return redirect()->route('view_teamleaders', $id)->withSuccess("Wijziging succesvol doorgevoerd !");
                    break;
                case "add":
                    $validator = Validator::make($request->all(), [
                        'college_add' => 'required|numeric',
                    ]);
                    if ($validator->fails()) {
                        return redirect()->back()->withErrors($validator);
                    }

                    $teamleaders_in_college = new TiC();
                    $teamleaders_in_college->fk_teamleader = $teamleader->id;
                    $teamleaders_in_college->fk_college = $request->college_add;
                    $teamleaders_in_college->save();
                    Log::TeamleaderLog($id, "<strong>".$teamleader->name."</strong> is teamleider geworden van: <strong>". College::find($teamleaders_in_college->fk_college)->name ."</strong>");
                    return redirect()->route('view_teamleaders', $id)->withSuccess("Wijziging succesvol doorgevoerd !");
                    break;
                case "none":
                    $message_array = array();
                    $i_current_colleges = TiC::where("fk_teamleader", "=", $teamleader->id)->count();
                    $links = TiC::where("fk_teamleader", "=", $teamleader->id)->get();
                    $old = array();
                    if (!$links->isEmpty()) {
                        foreach ($links as $teamleaders_in_colleges) {
                            $old[] = "<li>".College::find($teamleaders_in_colleges->fk_college)->name."</li>";
                            $teamleaders_in_colleges->delete();
                        }
                    }

                    for ($i = $i_current_colleges; $i > 0; $i--) {
                        $message_array[] = "<li> Geen </li>";
                    }

                    $list_start = "<ul>";
                    $list_end = "</ul>";
                    foreach ($old as $item) {
                        $list_start = $list_start . $item;
                    }
                    $list_start = $list_start.$list_end;
                    $list = $list_start . "<br> Naar:";
                    $intro = "De college(s) waar <strong>". $teamleader->name ."</strong> teamleider van was, zijn veranderd. <br><br> De volgende college(s) zijn varanderd:";

                    Log::TeamleaderLog($id, array_reverse($message_array), $intro, $list);
                    return redirect()->route('view_teamleaders', $id)->withSuccess("Wijziging succesvol doorgevoerd !");
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
