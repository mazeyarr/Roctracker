<?php

namespace App\Http\Controllers;

use App\Assessors;
use App\College;
use App\Exams;
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
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->getMessageBag()->first());
        }

        switch ($this->DetectChange($old, $request->name, $request->team)) {
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
        $assessor->name = $request->name;
        $assessor->team = $request->team;

        if ($assessor->fk_college != $request->college) {
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

        $exams = Exams::find($assessor->fk_exams);
        $validator = Validator::make($request->all(), [
            'training_next_on' => 'required',
        ]);
        if (!$validator->fails()) {
            $new_validation = Validator::make($request->all(), [
                'training_next_on' => 'date_format:d/m/Y',
            ]);
            if (!$new_validation->fails()){
                $training_date = date_format(date_create_from_format('d/m/Y',$request->training_next_on), 'Y-m-d');
                if ($exams->training_next_on != $training_date) {
                    $messages[] = "Training datum gewijzigd van: <br><i>". $exams->training_next_on . "</i><br>Naar<br><i>". $training_date ."</i>";
                }
                $exams->training_next_on = $training_date;
            }else{
                return redirect()->back()->withErrors('Error, Het ingevulde datum:<br><i>'. date_format(date_create($request->training_next_on), 'd-m-Y') .'</i> is incorrect...');
            }
        }

        $validator = Validator::make($request->all(), [
            'exam_next_on' => 'required',
        ]);
        if (!$validator->fails()) {
            $new_validation = Validator::make($request->all(), [
                'exam_next_on' => 'date_format:d/m/Y',
            ]);
            if (!$new_validation->fails()){
                $exam_date = date_format(date_create_from_format('d/m/Y',$request->exam_next_on), 'Y-m-d');
                date_format(date_create_from_format('d/m/Y',$request->exam_next_on), 'Y-m-d');
                if ($exams->exam_next_on != $exam_date) {
                    $messages[] = "Examen datum gewijzigd van: <br><i>". $exams->exam_next_on . "</i><br>Naar<br><i>". $exam_date ."</i>";
                }
                $exams->exam_next_on = $exam_date;
            }else{
                return redirect()->back()->withErrors('Error, Het ingevulde datum:<br><i>'. date_format(date_create($request->exam_next_on), 'd-m-Y') .'</i> is incorrect...');
            }
        }
        $exams->save();

        $assessor->save();
        if (empty($messages)) {
            return redirect()->back()->withWarning('Geen wijzegingen verkregen...');
        }
        Log::AssessorLog($id, $messages, true);
        return redirect()->route('view_assessor_profiel', $id)->withSuccess('Assessor was successvol opgeslagen !');

    }

    public function postAddAssessorAutomatic (Request $request) {
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
            dd($reader);

            $reader->each(function($sheet) {
                foreach ($sheet->toArray() as $row) {

                }
            });
        });
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
            $propTeam = 'assessor-'.$i.'-team';
            $propStat = 'status-'.$i;

            /** @var $propBirth  (reformat date for database) */
            $propBirth = date_format(date_create_from_format('d/m/Y',$request->$propBirth), 'Y-m-d');

            $assessor = new Assessors();
            $assessor->name = $request->$propName;
            $assessor->birthdate = $propBirth;
            $assessor->fk_college = $request->$propCollege != "Geen" ? $request->$propCollege : null;
            $assessor->function = $request->$propFunc;
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
