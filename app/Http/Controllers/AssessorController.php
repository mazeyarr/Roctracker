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
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use Validator;

class AssessorController extends Controller
{
    private static function object_2_array($result)
    {
        $array = array();
        foreach ($result as $key => $value) {
            if (is_object($value)) {
                $array[$key] = self::object_2_array(self::object_2_array($value));
            }
            if (is_array($value)) {
                $array[$key] = self::object_2_array(self::object_2_array($value));
            } else {
                $array[$key] = $value;
            }
        }
        return $array;
    }

    private static function convertToObject($array)
    {
        $object = new \stdClass();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $value = self::convertToObject($value);
            }
            $object->$key = $value;
        }
        return $object;
    }

    public function postChangeAssessor($id, Request $request)
    {
        $assessor = Assessors::find($id);
        $old = $assessor;
        $messages = array();
        if (empty($assessor)) {
            return redirect()->back()->withErrors("ERROR: Geen Assessor !");
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|min:2',
            'email' => 'required|email',
            'team' => 'max:255',
            'college' => 'required',
            'status' => 'required|numeric',
        ], array(
            'name.required' => 'Naam van de assessor is verplicht !',
            'name.max' => 'Naam mag niet meer dan 255 karakters bevatten',
            'name.min' => 'Naam mag niet minder dan 2 karakters bevatten',
            'email' => 'Dit email adres is incorrect',
            'status' => 'Status van deze assessor moet worden aangegeven'
        ));

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->getMessageBag()->first());
        }

        switch ($this->DetectChange_name_or_team($old, $request->name, $request->team)) {
            case "both":
                $messages[] = "Naam gewijzigd van: <strong>" . $old->name . "</strong> naar <strong>" . $request->name . "</strong>";
                $messages[] = "Team gewijzigd van: <strong>" . $old->team . "</strong> naar <strong>" . $request->team . "</strong>";
                break;
            case "name":
                $messages[] = "Naam gewijzigd van: <strong>" . $old->name . "</strong> naar <strong>" . $request->name . "</strong>";
                break;
            case "team":
                $messages[] = "Team gewijzigd van: <strong>" . $old->team . "</strong> naar <strong>" . $request->team . "</strong>";
                break;
            default:
                break;
        }
        if ($assessor->status != $request->status) {
            if ($request->status == 1) {
                $messages[] = "Assessor op Actief gezet";
            } else {
                $messages[] = "Assessor op Non-actief gezet";
            }
        }
        $assessor->name = $request->name;
        $assessor->team = $request->team;
        $assessor->status = $request->status;

        if ($assessor->email != $request->email){
            if (!Assessors::where('email', $request->email)->where('id', '!=', $assessor->id)->get()->isEmpty()) {
                return redirect()->back()->withWarning("Email van " . $assessor->name . " bestaat al bij een andere teamleider..");
            }
            $messages[] = "Email is van <i>" . $assessor->email . "</i> Naar <strong>" . $request->email . "</strong> Gewijzigd";
        }
        $assessor->email = $request->email;

        if (empty($assessor->fk_college)) {
            $messages[] = "College gewijzigd naar <strong>" . College::find($request->college)->name . "</strong>";
        } elseif ($assessor->fk_college != $request->college) {
            $messages[] = "College gewijzigd van <strong>" . College::find($assessor->fk_college)->name . "</strong> naar <strong>" . College::find($request->college)->name . "</strong>";
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

        if (Input::has('Filmpje')) {
            $basictraining->requirements->video = true;
            if ($basictraining->requirements->video != $oldLog['video']) {
                $messages[] = "Filmpje van deze assessor is afgevinkt !";
            }
        } else {
            $basictraining->requirements->video = false;
            if ($basictraining->requirements->video != $oldLog['video']) {
                $messages[] = "Filmpje van deze assessor is uitgevinkt !";
            }
        }

        if (Input::has('Portfolio')) {
            $basictraining->requirements->portfolio = true;
            if ($basictraining->requirements->portfolio != $oldLog['portfolio']) {
                $messages[] = "Portfolio van deze assessor was afgevinkt !";
            }
        } else {
            $basictraining->requirements->portfolio = false;
            if ($basictraining->requirements->portfolio != $oldLog['portfolio']) {
                $messages[] = "Portfolio van deze assessor was uitgevinkt !";
            }
        }

        if (Input::has('CV')) {
            $basictraining->requirements->CV = true;
            if ($basictraining->requirements->CV != $oldLog['cv']) {
                $messages[] = "CV van deze assessor was afgevinkt !";
            }
        } else {
            $basictraining->requirements->CV = false;
            if ($basictraining->requirements->CV != $oldLog['cv']) {
                $messages[] = "CV van deze assessor was uitgevinkt !";
            }
        }

        if (Input::has('present_day_1')) {
            $basictraining->date1->present = true;
            if ($basictraining->date1->present != $oldLog['date1']['present']) {
                $messages[] = "Assessor is op aanwezig gezet voor dag 1 van zijn training!";
            }
        } else {
            $basictraining->date1->present = false;
            if ($basictraining->date1->present != $oldLog['date1']['present']) {
                $messages[] = "Assessor is op afwezig gezet voor dag 1 van zijn training.";
            }
        }

        if (Input::has('present_day_2')) {
            $basictraining->date2->present = true;
            if ($basictraining->date2->present != $oldLog['date2']['present']) {
                $messages[] = "Assessor is op aanwezig gezet voor dag 2 van zijn training!";
            }
        } else {
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
                $messages[] = "Datum van basistraining dag 1 veranderd naar <i>" . $request->day1 . "</i>";
            }

            if ($basictraining->date2->date != $oldLog['date2']['date']) {
                $messages[] = "Datum van basistraining dag 2 veranderd naar <i>" . $request->day2 . "</i>";
            }
        }

        if (Input::has('graduated')) {
            $basictraining->graduated = true;
            $basictraining->passed = true;
            if ($basictraining->passed != $oldLog['passed'] && $basictraining->graduated != $oldLog['graduated']) {
                $messages[] = "Assessor heeft basistraining behaald !";
            }
        } else {
            $basictraining->graduated = false;
            $basictraining->passed = false;
            if ($basictraining->passed != $oldLog['passed'] && $basictraining->graduated != $oldLog['graduated']) {
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

    private function DetectChange_name_or_team($object, $value1, $value2)
    {
        if ($object->name != $value1 && $object->team != $value2) {
            return "both";
        } elseif ($object->name != $value1) {
            return "name";
        } elseif ($object->team != $value2) {
            return "team";
        } else {
            return "none";
        }
    }

    public function postAddAssessorAutomatic(Request $request)
    {
        $fileSize = 2;
        $validator = Validator::make($request->all(), array(
            'file' => 'required|between:0,' . ($fileSize * 1000)
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
                    'naam_deelnemer' => 'required|string|max:255|min:2',
                    'naam_college' => 'sometimes|nullable|string',
                    'naam_team' => 'sometimes|nullable|string',
                    'geboorte_datum' => 'required',
                    'functie' => 'required|string|max:255',
                    'training_verzorgd_door' => 'sometimes|string',
                    'diploma_uitgegeven_door' => 'sometimes|string',
                    'beroepskerntaak' => 'required|string',
                    'status_actief_non_actief_anders' => 'required',
                    'basistraining_behaald_janee' => '',
                    'laatste_basistraining_datum' => '',
                    'email' => 'required|email',
                ));
                if ($validator->fails()) {
                    $rejectedRows[] = $row;
                    continue;
                }

                $messages = array();

                if (!Assessors::where('name', $row['naam_deelnemer'])->get()->isEmpty()) {
                    $assessor = Assessors::where('name', $row['naam_deelnemer'])->first();

                    $n_college = (College::where('name', 'like', '%' . $row['naam_college'] . '%')->get()->isEmpty()) ? null : College::where('name', 'like', '%' . $row['naam_college'] . '%')->first()->name;
                    $o_college = (empty(College::find($assessor->fk_college)) ? null : College::find($assessor->fk_college)->name);
                    if ($this->DetectChange($o_college, $n_college)) {
                        if (empty($n_college)) {
                            $assessor->fk_college = null;
                        } else {
                            $assessor->fk_collge = College::where('name', 'like', '%' . $row['naam_college'] . '%')->first()->id;

                            # Teamleader Change-Check
                            if (!TiC::where('fk_college', $assessor->fk_college)->isEmpty()) {
                                $ticRow = TiC::where('fk_college', $assessor->fk_college)->first();
                                if ($this->DetectChange($assessor->fk_teamleader, $ticRow->fk_teamleader)) {
                                    $assessor->fk_teamleader = $ticRow->fk_teamleader;
                                    $o_teamleader = (empty($assessor->fk_teamleader)) ? null : Teamleaders::find($assessor->fk_teamleader)->name;
                                    $n_teamleader = Teamleaders::find($ticRow->fk_teamleader);
                                    $messages[] = "Teamleider wijziging, van " . Functions::nullIsString($o_teamleader, "Geen") . " naar " . $n_teamleader->name;
                                }
                            } else {
                                if ($this->DetectChange($assessor->fk_teamleader, null)) {
                                    $assessor->fk_teamleader = null;
                                    $o_teamleader = (empty($assessor->fk_teamleader)) ? null : Teamleaders::find($assessor->fk_teamleader);
                                    $messages[] = "Teamleider wijziging, van " . Functions::nullIsString($o_teamleader, "Geen") . " naar " . "Geen";
                                }
                            }

                        }
                        $messages[] = "College geqijzigd, van " . Functions::nullIsString($o_college, "Geen") . " naar " . Functions::nullIsString($n_college, "Geen");
                    }

                    $n_email = $row['email'];
                    $o_email = $assessor->email;
                    if ($this->DetectChange($o_email, $n_email)) {
                        $assessor->email = $n_email;
                        $messages[] = "Email wijziging, van " . Functions::nullIsString($o_email, "Geen") . " naar " . Functions::nullIsString($n_email, "Geen");
                    }

                    $n_team = $row['naam_team'];
                    $o_team = $assessor->team;
                    if ($this->DetectChange($o_team, $n_team)) {
                        $assessor->team = $n_team;
                        $messages[] = "Team wijziging, van " . Functions::nullIsString($o_team, "Geen") . " naar " . Functions::nullIsString($n_team, "Geen");
                    }

                    $n_birth = $row['geboorte_datum']->format('Y-m-d');
                    $o_birth = $assessor->birthdate;
                    if ($this->DetectChange($o_birth, $n_birth)) {
                        $assessor->birthdate = $n_birth;
                        $messages[] = "Geboorte datum naar " . $n_birth . " Gewijzigd";
                    }

                    $n_function = $row['functie'];
                    $o_function = $assessor->function;
                    if ($this->DetectChange($o_function, $n_function)) {
                        $assessor->function = $n_function;
                        $messages[] = "Functie gewijzigd, van " . Functions::nullIsString($o_function, "Geen") . " naar " . Functions::nullIsString($n_function, "Geen");
                    }

                    $n_training = $row['training_verzorgd_door'];
                    $o_training = $assessor->trained_by;
                    if ($this->DetectChange($o_training, $n_training)) {
                        $assessor->trained_by = $n_training;
                        $messages[] = "Instelling waar assessor is opgeleid is gewijzigd, van " . Functions::nullIsString($o_training, "Geen") . " naar " . Functions::nullIsString($n_training, "Geen");
                    }

                    $n_certified = $row['diploma_uitgegeven_door'];
                    $o_certified = $assessor->certified_by;
                    if ($this->DetectChange($o_certified, $n_certified)) {
                        $assessor->trained_by = $n_certified;
                        $messages[] = "Instelling waar assessor is gecertificeerd is gewijzigd, van " . Functions::nullIsString($o_certified, "Geen") . " naar " . Functions::nullIsString($n_certified, "Geen");
                    }

                    $n_profession = $row['beroepskerntaak'];
                    $o_profession = $assessor->profession;
                    if ($this->DetectChange($o_profession, $n_profession)) {
                        $assessor->trained_by = $n_profession;
                        $messages[] = "Beroepskerntaak is gewijzigd " . Functions::nullIsString($o_profession, "Geen") . " naar " . Functions::nullIsString($n_profession, "Geen");
                    }

                    if (!Functions::getStatusByString($row['status_actief_non_actief_anders'])) {
                        $rejectedRows[] = $row;
                        continue;
                    } else {
                        $n_status = Functions::getStatusByString($row['status_actief_non_actief_anders']);
                        $o_status = $assessor->status;
                        if ($this->DetectChange($o_status, $n_status)) {
                            $assessor->status = $n_status;
                            $messages[] = "Status van deze assessor gewijzigd van " . Functions::getStringByStatus($o_status) . " naar " . Functions::getStringByStatus($n_status);
                        }
                    }

                    $assessor->save();
                    if (!empty($messages)) {
                        Log::AssessorLog($assessor->id, $messages, true);
                    }
                } else {

                    if (!Assessors::where('email', $row['email'])->get()->isEmpty()){
                        $rejectedRows[] = $row;
                        continue;
                    }

                    $n_assessor = new Assessors();
                    $n_assessor->name = $row['naam_deelnemer'];
                    $n_assessor->email = $row['email'];
                    $n_assessor->birthdate = $row['geboorte_datum']->format('Y-m-d');
                    $n_assessor->fk_college = (College::where('name', 'like', '%' . $row['naam_college'] . '%')->get()->isEmpty()) ? null : College::where('name', 'like', '%' . $row['naam_college'] . '%')->first()->id;
                    $n_assessor->fk_teamleader = (College::where('name', 'like', '%' . $row['naam_college'] . '%')->get()->isEmpty() || TiC::where('fk_college', College::where('name', 'like', '%' . $row['naam_college'] . '%')->first()->id)->get()->isEmpty()) ? null : TiC::where('fk_college', College::where('name', 'like', '%' . $row['naam_college'] . '%')->first()->id)->first()->fk_teamleader;
                    $n_assessor->team = $row['naam_team'];
                    $n_assessor->function = $row['functie'];
                    $n_assessor->trained_by = $row['training_verzorgd_door'];
                    $n_assessor->certified_by = $row['diploma_uitgegeven_door'];
                    $n_assessor->profession = $row['beroepskerntaak'];
                    $n_assessor->status = Functions::getStatusByString($row['status_actief_non_actief_anders']);
                    $n_assessor->fk_exams = Exams::NewAssessor($row['basistraining_behaald_janee'], $row['laatste_basistraining_datum']->format('d-m-Y'));
                    $n_assessor->profession = $row['beroepskerntaak'];
                    $n_assessor->log = '{}';
                    $n_assessor->save();
                    $importdata[]['id'] = $n_assessor->id;
                    Log::AssessorLog($n_assessor->id, "Assessor toegevoegd aan systeem, doormiddel van Excel lijst");
                }

                $approvedRows[] = $row;
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

    private function DetectChange($old, $new)
    {
        if ($old == $new) {
            return false;
        }

        return true;
    }

    public function getUndoAssessorAutomatic($id)
    {
        if (Imports::undo($id)) {
            $message = array(
                'type' => "success",
                'message' => "De geimporteerde assessoren zijn successvol ongedaan gemaakt !",
                'color' => '#23ff00'
            );
        } else {
            $message = array(
                'type' => "error",
                'message' => "er was een fout opgetreden.",
                'color' => '#FB9678'
            );
        }
        return json_encode($message);
    }

    public function postAddAssessorManual($count, Request $request)
    {
        if (empty($count)) {
            return redirect()->back()->withErrors('Error, parameter niet verkregen...');
        }

        for ($i = 1; $i <= $count; $i++) {
            $rules = array(
                'assessor-' . $i . '-name' => 'required|max:255',
                'assessor-' . $i . '-email' => 'required|email',
                'assessor-' . $i . '-birthdate' => 'required|date_format:d/m/Y',
                'assessor-' . $i . '-college' => 'required',
                'assessor-' . $i . '-functie' => 'required',
                'assessor-' . $i . '-kerntaak' => 'required',
                'assessor-' . $i . '-team' => 'required',
                'status-' . $i => 'required|Numeric'
            );

            $validation = Validator::make($request->all(), $rules);

            if ($validation->fails()) {
                return redirect()->back()->withErrors($validation->getMessageBag()->first());
            }

            /* request inputs */
            $propName = 'assessor-' . $i . '-name';
            $propEmail = 'assessor-' . $i . '-email';
            $propBirth = 'assessor-' . $i . '-birthdate';
            $propCollege = 'assessor-' . $i . '-college';
            $propFunc = 'assessor-' . $i . '-functie';
            $propProf = 'assessor-' . $i . '-kerntaak';
            $propTeam = 'assessor-' . $i . '-team';
            $propStat = 'status-' . $i;

            if (!Assessors::where('email', $propEmail)->get()->isEmpty()){
                return redirect()->back()->withErrors("Email: " . $propEmail . " Bestaat al bij een andere assessor" );
            }

            /** @var $propBirth (reformat date for database) */
            $propBirth = date_format(date_create_from_format('d/m/Y', $request->$propBirth), 'Y-m-d');

            $assessor = new Assessors();
            $assessor->name = $request->$propName;
            $assessor->email = $request->$propEmail;
            $assessor->birthdate = $propBirth;
            $assessor->fk_college = $request->$propCollege != "Geen" ? $request->$propCollege : null;
            $assessor->function = $request->$propFunc;
            $assessor->profession = $request->$propProf;
            $assessor->team = $request->$propTeam;
            $assessor->status = $request->$propStat;
            if ($request->$propCollege != "Geen") {
                $college_id = $request->$propCollege;
                $tic = TiC::where('fk_college', $college_id)->first();
                if (!empty($tic)) {
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
}
