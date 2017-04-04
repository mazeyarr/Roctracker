<?php

namespace App\Http\Controllers;

use App\Assessors;
use App\College;
use App\Exams;
use App\Functions;
use App\Imports;
use App\Log;
use App\Teamleaders;
use App\TiC;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use Illuminate\Support\Facades\Input;

class AssessorController extends Controller
{
    public function postChangeAssessor ($id, Request $request) {
        $assessor = Assessors::find($id);
        $old = $assessor;
        $messages = array();
        if (empty($assessor)) {
            return redirect()->back()->withErrors("ERROR: Geen Assessor !");
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|min:2',
            'team' => 'max:255',
            'college' => 'required',
            'status' => 'required|numeric',
        ],array(
            'name.required' => 'Naam van de assessor is verplicht !',
            'name.max' => 'Naam mag niet meer dan 255 karakters bevatten',
            'name.min' => 'Naam mag niet minder dan 2 karakters bevatten',
            'status' => 'Status van deze assessor moet worden aangegeven'
        ));

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->getMessageBag()->first());
        }

        switch ($this->DetectChange_name_or_team($old, $request->name, $request->team)) {
            case "both":
                $messages[] = "Naam gewijzigd van: <strong>".$old->name."</strong> naar <strong>".$request->name."</strong>";
                $messages[] = "Team gewijzigd van: <strong>".$old->team."</strong> naar <strong>".$request->team."</strong>";
                break;
            case "name":
                $messages[] = "Naam gewijzigd van: <strong>".$old->name."</strong> naar <strong>".$request->name."</strong>";
                break;
            case "team":
                $messages[] = "Team gewijzigd van: <strong>".$old->team."</strong> naar <strong>".$request->team."</strong>";
                break;
            default:
                break;
        }
        if ($assessor->status != $request->status){
            if ($request->status == 1) {
                $messages[] = "Assessor op Actief gezet";
            } else {
                $messages[] = "Assessor op Non-actief gezet";
            }
        }
        $assessor->name = $request->name;
        $assessor->team = $request->team;
        $assessor->status = $request->status;
        if (empty($assessor->fk_college)) {
            $messages[] = "College gewijzigd naar <strong>".College::find($request->college)->name."</strong>";
        }elseif ($assessor->fk_college != $request->college) {
            $messages[] = "College gewijzigd van <strong>". College::find($assessor->fk_college)->name ."</strong> naar <strong>".College::find($request->college)->name."</strong>";
        }
        $assessor->fk_college = $request->college;

        if (empty($assessor->fk_exams)) {
            $assessor->save();
            return redirect()->route('view_assessor_profiel', $id)->withSuccess('Assessor was successvol opgeslagen !');
        }

        $basictraining = Exams::getBasictraining($assessor->fk_exams);

        $oldLog['video'] = $basictraining->requirements->video;
        $oldLog['portfolio'] = $basictraining->requirements->portfolio;
        $oldLog['cv'] = $basictraining->requirements->CV;

        $oldLog['date1']['present'] = $basictraining->date1->present;
        $oldLog['date2']['present'] = $basictraining->date2->present;
        $oldLog['date1']['date'] = $basictraining->date1->date;
        $oldLog['date2']['date'] = $basictraining->date2->date;

        $oldLog['passed'] = $basictraining->passed;
        $oldLog['graduated'] = $basictraining->graduated;

        if(Input::has('Filmpje')){
            $basictraining->requirements->video = true;
            if ($basictraining->requirements->video != $oldLog['video']){
                $messages[] = "Filmpje van deze assessor is afgevinkt !";
            }
        }else{
            $basictraining->requirements->video = false;
            if ($basictraining->requirements->video != $oldLog['video']){
                $messages[] = "Filmpje van deze assessor is uitgevinkt !";
            }
        }

        if(Input::has('Portfolio')){
            $basictraining->requirements->portfolio = true;
            if ($basictraining->requirements->portfolio != $oldLog['portfolio']){
                $messages[] = "Portfolio van deze assessor was afgevinkt !";
            }
        }else{
            $basictraining->requirements->portfolio = false;
            if ($basictraining->requirements->portfolio != $oldLog['portfolio']){
                $messages[] = "Portfolio van deze assessor was uitgevinkt !";
            }
        }

        if(Input::has('CV')){
            $basictraining->requirements->CV = true;
            if ($basictraining->requirements->CV != $oldLog['cv']) {
                $messages[] = "CV van deze assessor was afgevinkt !";
            }
        }else{
            $basictraining->requirements->CV = false;
            if ($basictraining->requirements->CV != $oldLog['cv']) {
                $messages[] = "CV van deze assessor was uitgevinkt !";
            }
        }

        if(Input::has('present_day_1')){
            $basictraining->date1->present = true;
            if ($basictraining->date1->present != $oldLog['date1']['present']) {
                $messages[] = "Assessor is op aanwezig gezet voor dag 1 van zijn training!";
            }
        }else{
            $basictraining->date1->present = false;
            if ($basictraining->date1->present != $oldLog['date1']['present']) {
                $messages[] = "Assessor is op afwezig gezet voor dag 1 van zijn training.";
            }
        }

        if(Input::has('present_day_2')){
            $basictraining->date2->present = true;
            if ($basictraining->date2->present != $oldLog['date2']['present']) {
                $messages[] = "Assessor is op aanwezig gezet voor dag 2 van zijn training!";
            }
        }else{
            $basictraining->date2->present = false;
            if ($basictraining->date2->present != $oldLog['date2']['present']) {
                $messages[] = "Assessor is op afwezig gezet voor dag 2 van zijn training.";
            }
        }

        $validator = Validator::make($request->all(), [
            'day1' => 'required',
            'day2' => 'required',
        ]);
        if (!$validator->fails()) {
            $validator = Validator::make($request->all(), [
                'day1' => 'required|date_format:"d-m-Y"',
                'day2' => 'required|date_format:"d-m-Y"',
            ], array(
                'day1.date_format' => 'Basistraining Dag 1 was verkeerd ingevuld,<br> Graag houden aan het dd-mm-yyyy format',
                'day2.date_format' => 'Basistraining Dag 2 was verkeerd ingevuld,<br> Graag houden aan het dd-mm-yyyy format'
            ));

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->getMessageBag()->first());
            }
            $basictraining->date1->date = $request->day1;
            $basictraining->date2->date = $request->day2;

            if ($basictraining->date1->date != $oldLog['date1']['date']) {
                $messages[] = "Datum van basistraining dag 1 veranderd naar <i>".$request->day1."</i>";
            }

            if ($basictraining->date2->date != $oldLog['date2']['date']) {
                $messages[] = "Datum van basistraining dag 2 veranderd naar <i>".$request->day2."</i>";
            }
        }

        if(Input::has('graduated')){
            $basictraining->graduated = true;
            $basictraining->passed = true;
            if ($basictraining->passed != $oldLog['passed'] && $basictraining->graduated != $oldLog['graduated']){
                $messages[] = "Assessor heeft basistraining behaald !";
            }
        }else{
            $basictraining->graduated = false;
            $basictraining->passed = false;
            if ($basictraining->passed != $oldLog['passed'] && $basictraining->graduated != $oldLog['graduated']){
                $messages[] = "Basistraining van deze assessor is op niet behaald gezet !";
            }
        }

        Exams::saveBasictraining($assessor->fk_exams, $basictraining);

        $assessor->save();
        if (empty($messages)) {
            return redirect()->back()->withWarning('Geen wijzegingen verkregen...');
        }
        Log::AssessorLog($id, $messages, true);
        return redirect()->route('view_assessor_profiel', $id)->withSuccess('Assessor was successvol opgeslagen !');

    }

    public function postAddAssessorAutomatic (Request $request) {
        // TODO: FIX THIS FUNCTION
        $ret['message'] = "Deze functie is nog onder constructie !";
        $ret['status'] = "error";
        $ret['header'] = "Info";
        die(json_encode($ret));


        $fileSize = 2;
        $validator = Validator::make($request->all(),array(
            'file' => 'required|between:0,'.($fileSize*1000)
        ));

        if ($validator->fails()) {
            $ret['message'] = $validator->getMessageBag()->first();
            $ret['status'] = "error";
            $ret['header'] = "Error";
            die(json_encode($ret));
        }

        Excel::load(Input::file('file'), function ($reader) {
            $reader = $reader->toArray();
            $sheet = $reader;
            $rows = $sheet;

            $approvedRows = array();
            $rejectedRows = array();
            $importdata = array();

            foreach ($rows as $row) {
                $validator = Validator::make($row, array(
                    'naam_deelnemer'                    => 'required|max:255|min:2',
                    'naam_college'                      => '',
                    'naam_team'                         => '',
                    'geboorte_datum'                    => 'required',
                    'functie'                           => 'required|max:255',
                    'training_verzorgd_door'            => '',
                    'diploma_uitgegeven_door'           => '',
                    'naam_teamleider_1_persoon'         => '',
                    'status_actief_non_actief_anders'   => 'required',
                    'basistraining_behaald_janee'       => '',
                    'laatste_basistraining_datum'       => '',
                ));

                if ($validator->fails()) {
                    $rejectedRows[] = $row;
                    continue;
                }

                $messages = array();

                if (!Assessors::where('name', $row['naam_deelnemer'])->isEmpty()) {
                    $assessor = Assessors::where('name', $row['naam_deelnemer'])->first();

                    $n_college = (College::where('name', 'like', '%' . $row['naam_college'] . '%')->isEmpty()) ? null : College::where('name', 'like', '%' . $row['naam_college'] . '%')->first()->name;
                    $o_college = (empty(College::find($assessor->fk_college)) ? null : College::find($assessor->fk_college)->name);
                    if ($this->DetectChange($o_college, $n_college)) {
                        if (!empty($n_college)) {
                            $assessor->fk_college = null;
                        }else {
                            $assessor->fk_collge = College::where('name', 'like', '%' . $row['naam_college'] . '%')->id;
                        }
                        $messages[] = "College geqijzigd van " . empty($o_college) ? "Geen" : $o_college . " naar " . empty($n_college) ? "Geen" : $n_college;
                    }

                    $n_team = $row['naam_team'];
                    $o_team = $assessor->team;
                    if ($this->DetectChange($o_team, $n_team)) {
                        $assessor->team = $n_team;
                        $messages[] = "Team wijziging van " . empty($o_team) ? "Geen" : $o_team . " naar " . empty($n_team) ? "Geen" : $n_team;
                    }

                    /*$n_birth = $row['geboorte_datum'];
                    $o_birth = $assessor->birthdate;
                    if ($this->DetectChange($o_birth, $n_birth)) {
                        $assessor->birthdate = $n_birth;
                        $messages[] = "Geboorte datum naar " . $n_birth . " Gewijzigd";
                    }*/

                    $n_function = $row['functie'];
                    $o_function = $assessor->function;
                    if ($this->DetectChange($o_function, $n_function)) {
                        $assessor->function = $n_function;
                        $messages[] = "Functie gewijzigd van " . $o_function . " naar " . $n_function;
                    }



                }

                /*$approvedRows[] = $row;
                $importdata[]['id'] = $assessor->id;*/
            }

            $import = new Imports();
            $import->filename = Input::file('file')->getClientOriginalName();
            $import->function = "add";
            $import->tablename = Functions::getTablename($model = new Assessors());
            $import->data = json_encode($importdata);
            $import->status = 1;
            $import->save();

            $ret['message'] = "Lijst was successvol geimporteerd !";
            $ret['status'] = "success";
            $ret['header'] = "Voltooid";
            $ret['result'] = array(
                'approved' => $approvedRows,
                'rejected' => $rejectedRows,
                'importid' => $import->id
            );
            die(json_encode($ret));
        });
    }

    public function getUndoAssessorAutomatic ($id) {
        if (Imports::undo($id)) {
            $message = array(
                'type' => "success",
                'message' => "De geimporteerde assessoren zijn successvol ongedaan gemaakt !",
                'color' => '#23ff00'
            );
        }else{
            $message = array(
                'type' => "error",
                'message' => "er was een fout opgetreden.",
                'color' => '#FB9678'
            );
        }
        return json_encode($message);
    }

    public function postAddAssessorManual ($count, Request $request) {
        if (empty($count)) {
            return redirect()->back()->withErrors('Error, parameter niet verkregen...');
        }

        for ($i = 1; $i <= $count; $i++) {
            $rules = array(
                'assessor-'.$i.'-name' => 'required|max:255',
                'assessor-'.$i.'-birthdate' => 'required|date_format:d/m/Y',
                'assessor-'.$i.'-college' => 'required',
                'assessor-'.$i.'-functie' => 'required',
                'assessor-'.$i.'-kerntaak' => 'required',
                'assessor-'.$i.'-team' => 'required',
                'status-'.$i => 'required|Numeric'
            );

            $validation = Validator::make($request->all(), $rules);

            if ($validation->fails()) {
                return redirect()->back()->withErrors($validation->getMessageBag()->first());
            }

            /* request inputs */
            $propName = 'assessor-'.$i.'-name';
            $propBirth = 'assessor-'.$i.'-birthdate';
            $propCollege = 'assessor-'.$i.'-college';
            $propFunc = 'assessor-'.$i.'-functie';
            $propProf = 'assessor-'.$i.'-kerntaak';
            $propTeam = 'assessor-'.$i.'-team';
            $propStat = 'status-'.$i;

            /** @var $propBirth  (reformat date for database) */
            $propBirth = date_format(date_create_from_format('d/m/Y',$request->$propBirth), 'Y-m-d');

            $assessor = new Assessors();
            $assessor->name = $request->$propName;
            $assessor->birthdate = $propBirth;
            $assessor->fk_college = $request->$propCollege != "Geen" ? $request->$propCollege : null;
            $assessor->function = $request->$propFunc;
            $assessor->profession = $request->$propProf;
            $assessor->team = $request->$propTeam;
            $assessor->status = $request->$propStat;
            if ($request->$propCollege != "Geen") {
                $college_id = $request->$propCollege;
                $tic = TiC::where('fk_college', $college_id)->first();
                if (!empty($tic)){
                    $teamleader = Teamleaders::find($tic->fk_teamleader)->id;
                    $assessor->fk_teamleader = $teamleader;
                }
            }
            $assessor->fk_exams = Exams::NewAssessor();
            $assessor->log = '{"log" : {}}';
            $assessor->save();
        }

        $salutation = $count > 1 ? 'Assesoren' : "Assessor";
        return redirect()->route('assessors')->withSuccess($salutation . ", Zijn successvol opgeslagen");
    }

    private function DetectChange_name_or_team ($object, $value1, $value2) {
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

    private function DetectChange($old, $new)
    {
        if ($old == $new) {
            return false;
        }

        return true;
    }

    private static function object_2_array($result)
    {
        $array = array();
        foreach ($result as $key=>$value)
        {
            if (is_object($value))
            {
                $array[$key]=self::object_2_array(self::object_2_array($value));
            }
            if (is_array($value))
            {
                $array[$key]=self::object_2_array(self::object_2_array($value));
            }
            else
            {
                $array[$key]=$value;
            }
        }
        return $array;
    }

    private static function convertToObject($array) {
        $object = new \stdClass();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $value = self::convertToObject($value);
            }
            $object->$key = $value;
        }
        return $object;
    }
}
