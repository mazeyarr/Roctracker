<?php

namespace App\Http\Controllers;

use App\Assessors;
use App\Attention;
use App\College;
use App\Functions;
use App\Imports;
use App\Log;
use App\SystemLog;
use App\Teamleaders;
use App\TiC;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
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

    public function postAddTeamleaderManual ($count, Request $request) {
        # SECTOR 1
        if (empty($count)) {
            return redirect()->back()->withErrors('Error, parameter niet verkregen...');
        }

        $exchange_teamleader = array();
        $attention = null;

        # SECTOR 2
        for ($i = 1; $i <= $count; $i++) {
            # SECTOR 2.1
            $rules = array(
                'teamleader-'.$i.'-name' => 'required|max:255',
                'teamleader-'.$i.'-college' => 'required',
                'status-'.$i => 'required|Numeric'
            );

            # SECTOR 2.2
            $validation = Validator::make($request->all(), $rules);

            # SECTOR 2.3
            if ($validation->fails()) {
                return redirect()->back()->withErrors($validation->getMessageBag()->first());
            }

            /* request inputs */
            $propName = 'teamleader-'.$i.'-name';
            $propCollege = 'teamleader-'.$i.'-college';
            $propStat = 'status-'.$i;

            # SECTOR 2.4
            $teamleader = new Teamleaders();
            $teamleader->name = $request->$propName;
            $teamleader->team = "";
            $teamleader->status = $request->$propStat;
            $teamleader->log = '{"log" : {}}';
            $teamleader->save();

            # SECTOR 2.5
            Log::TeamleaderLog($teamleader->id, $teamleader->name . " is Teamleider geworden.");

            if ($request->$propCollege != "Geen") {
                # SECTOR 2.6
                if (!Assessors::where('fk_college', $request->$propCollege)->get()->isEmpty()) {
                    $assessors = Assessors::where('fk_college', $request->$propCollege)->get();
                    foreach ($assessors as $assessor) {
                        Log::AssessorLog($assessor->id, "Teamleider gewijzigd naar: <strong>" . $teamleader->name . "</strong>");
                    }
                }
                # SECTOR 2.7
                if (empty(TiC::where('fk_college', $request->$propCollege)->first())) {
                    try{
                        Log::TeamleaderLog($teamleader->id, $teamleader->name . " is teamleider geworden van -> " . College::find($request->$propCollege)->name);
                        Log::CollegeLog(College::find($request->$propCollege)->id, $teamleader->name . " is teamleider geworden van dit College");
                    }
                    catch(\Exception $e){ SystemLog::LOG(__FUNCTION__,'SECTOR 2.7', $e->getMessage(), Auth::user()->id); }
                    $place_in_college = new TiC();
                    $place_in_college->fk_teamleader = $teamleader->id;
                    $place_in_college->fk_college = $request->$propCollege;
                    $place_in_college->save();
                } else {
                    # SECTOR 2.8
                    $check = TiC::find(TiC::where('fk_college', $request->$propCollege)->first()->id)->fk_teamleader;

                    /** save this teamleader in the attention table incase user leaves without making change to this teamleader */
                    $attention = Attention::create([
                        'tablename' => Functions::getTablename($model = new Teamleaders()),
                        'message' => "Deze Teamleider werd vervangen door `" . $teamleader->name ."`. Wijziging vereist",
                        'status' => 0,
                        'fk_id' => Teamleaders::find($check)->id,
                        'fk_users' => Auth::user()->id
                    ]);

                    # SECTOR 2.9
                    $exchange_teamleader[$i]['teamleader'] = Teamleaders::find($check);
                    $exchange_teamleader[$i]['attention_id'] = $attention->id;

                    # SECTOR 2.10
                    $tic = TiC::find(TiC::where('fk_college', $request->$propCollege)->first()->id);
                    $tic->fk_teamleader = $teamleader->id;
                    $tic->save();

                    try{
                        Log::TeamleaderLog($teamleader->id, $teamleader->name . " is teamleider geworden van -> " . College::find($request->$propCollege)->name);
                        Log::CollegeLog(College::find($request->$propCollege)->id, $teamleader->name . " is teamleider geworden van dit College");
                    }
                    catch(\Exception $e){ SystemLog::LOG(__FUNCTION__,'SECTOR 2.10', $e->getMessage(), Auth::user()->id); }
                }
            }
        }

        if (count($exchange_teamleader) > 0) {
            $salutation = count($exchange_teamleader) > 1 ? 'Teamleiders' : "Teamleider";
            $data = array(
                'teamleaders' => $exchange_teamleader,
                'message' => "Wat moet er gebeuren met de volgende " . $salutation
            );
            Session::put('action_teamleader', $data);
            return redirect()->route('add_teamleader_change_save');
        }
        $salutation = $count > 1 ? 'Teamleiders' : "Teamleider";
        return redirect()->route('teamleaders')->withSuccess($salutation . ", Zijn successvol opgeslagen");
    }

    public function getChangeTeamleaderManual () {
        if (Session::has('action_teamleader')) {
            $data = Session::get('action_teamleader');
            return view('teamleader-exchange')
                ->withColleges(College::all())
                ->withTeamleaders($data['teamleaders'])
                ->withNotify($data['message'])
                ->withWarining($data['message']);
        }
        return redirect()->route('teamleaders')->withWarining('Geen actie nodig...');
    }

    public function postChangeTeamleaderManual ($count, Request $request) {
        # SECTOR 1
        if (empty($count)) {
            return redirect()->back()->withErrors('Error, parameter niet verkregen...');
        }

        $exchange_teamleader = array();

        # SECTOR 2
        for ($i = 1; $i <= $count; $i++) {
            # SECTOR 2.1
            $rules = array(
                'teamleader-'.$i.'-college' => 'required',
                'teamleader-'.$i.'-id' => 'required|Numeric',
                'teamleader-'.$i.'-attention' => 'required|Numeric'

            );

            # SECTOR 2.2
            $validation = Validator::make($request->all(), $rules);

            if ($validation->fails()) {
                return redirect()->back()->withErrors($validation->getMessageBag()->first());
            }

            $propID = 'teamleader-'.$i.'-id';
            $propCollege = 'teamleader-'.$i.'-college';
            $propAttentionID = 'teamleader-'.$i.'-attention';

            # SECTOR 2.3
            $teamleader = Teamleaders::find($request->$propID);

            if ($request->$propCollege != "Geen") {
                # SECTOR 2.4
                if (!empty(Assessors::where('fk_college', $request->$propCollege))) {
                    $assessors = Assessors::where('fk_college', $request->$propCollege)->get();

                    # SECTOR 2.5
                    foreach ($assessors as $assessor) {
                        Log::AssessorLog($assessor->id, "Teamleider gewijzigd naar: <strong>" . $teamleader->name . "</strong>");
                    }
                }
                if (empty(TiC::where('fk_college', $request->$propCollege)->first())) {

                    # SECTOR 2.6
                    try{
                        Log::TeamleaderLog($teamleader->id, $teamleader->name . " is teamleider geworden van -> " . College::find($request->$propCollege)->name);
                        Log::CollegeLog(College::find($request->$propCollege)->id, $teamleader->name . " is teamleider geworden van dit College");
                    }
                    catch(\Exception $e){ SystemLog::LOG(__FUNCTION__,'SECTOR 2.6', $e->getMessage(), Auth::user()->id); }
                    $place_in_college = new TiC();
                    $place_in_college->fk_teamleader = $teamleader->id;
                    $place_in_college->fk_college = $request->$propCollege;
                    $place_in_college->save();
                } else {
                    # SECTOR 2.7
                    $check = TiC::find(TiC::where('fk_college', $request->$propCollege)->first()->id)->fk_teamleader;

                    # SECTOR 2.8
                    /** save this teamleader in the attention table incase user leaves without making change to this teamleader */
                    $attention = Attention::create([
                        'tablename' => Functions::getTablename($model = new Teamleaders()),
                        'message' => "Deze Teamleider werd vervangen door `" . $teamleader->name ."`. Wijziging vereist",
                        'status' => 0,
                        'fk_id' => Teamleaders::find($check)->id,
                        'fk_users' => Auth::user()->id
                    ]);

                    # SECTOR 2.9
                    $exchange_teamleader[$i]['teamleader'] = Teamleaders::find($check);
                    $exchange_teamleader[$i]['attention_id'] = $attention->id;

                    # SECTOR 2.10
                    $tic = TiC::find(TiC::where('fk_college', $request->$propCollege)->first()->id);
                    $tic->fk_teamleader = $teamleader->id;
                    $tic->save();

                    try{
                        Log::TeamleaderLog($teamleader->id, $teamleader->name . " is teamleider geworden van -> " . College::find($request->$propCollege)->name);
                        Log::CollegeLog(College::find($request->$propCollege)->id, $teamleader->name . " is teamleider geworden van dit College");
                    }
                    catch(\Exception $e){ SystemLog::LOG(__FUNCTION__,'SECTOR 2.10', $e->getMessage(), Auth::user()->id); }
                }
            }

            $teamleader->save();

            $attention_old = Attention::find($request->$propAttentionID);
            $attention_old->status = 1;
            $attention_old->fk_users = Auth::user()->id;
            $attention_old->save();
        }

        if (count($exchange_teamleader) > 0) {
            $salutation = count($exchange_teamleader) > 1 ? 'Teamleiders' : "Teamleider";
            $data = array(
                'teamleaders' => $exchange_teamleader,
                'message' => "Wat moet er gebeuren met de volgende " . $salutation
            );
            Session::put('action_teamleader', $data);
            return redirect()->route('add_teamleader_change_save');
        }
        return redirect()->route('teamleaders')->withSuccess('Teamleider is was successvold veranderd !');
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
