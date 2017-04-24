<?php

namespace App\Http\Controllers;

use App\Assessors;
use App\College;
use App\Email;
use App\Functions;
use App\HistoryData;
use App\Log;
use App\MailTexts;
use App\ScheduleEmailTasks;
use App\Teamleaders;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use DB;

class FunctionalController extends Controller
{
    public $creator;
    public $company;

    function __construct()
    {
        $this->creator = "RocTracker";
        $this->company = "MRG Studios";
    }

    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), array('search' => 'required|string'), ['search.required' => "U heeft niks ingevuld"]);
        if ($validator->fails()) {
            return back()->withErrors($validator->getMessageBag()->first());
        }

        $search_result = array();
        $cols = array();

        $cols = null;


        return view('search-results');

    }

    public function ajaxSaveCollege($id, $name)
    {
        if (!is_numeric($id)) {
            return json_encode(array(
                'result' => 'failed',
                'message' => 'ERROR ID'
            ));
        }
        if (is_numeric($name) || $name == "" || empty($name)) {
            return json_encode(array(
                'result' => 'failed',
                'message' => 'Naam was niet juist ingevuld.'
            ));
        }
        $college = College::find($id);
        $college->name = $name;
        $college->save();
        return json_encode(array('result' => 'executed'));
    }

    public function ajaxSaveTeamleader($id, $name)
    {
        if (!is_numeric($id)) {
            return json_encode(array(
                'result' => 'failed',
                'message' => 'ERROR ID'
            ));
        }
        if (is_numeric($name) || $name == "" || empty($name)) {
            return json_encode(array(
                'result' => 'failed',
                'message' => 'Naam was niet juist ingevuld.'
            ));
        }
        $teamleader = Teamleaders::find($id);
        $teamleader->name = $name;
        $teamleader->save();
        return json_encode(array('result' => 'executed'));
    }

    public function ajaxSaveAssessorToCollege($id, $college_id)
    {

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
        } else {
            $assessor->fk_college = $college_id;
            $assessor->save();
            Log::AssessorLog($id, 'College veranderd, van <strong>' . (College::find($old_college)->name) . '</strong> Naar <strong>' . (College::find($assessor->fk_college)->name) . '</strong>');
        }
        return json_encode(array('result' => 'executed'));
    }

    public function ajaxGetHistoryData()
    {
        die(HistoryData::all()->toJson());
    }

    public function ajaxGetAssessorData()
    {

        $DataPastYear = HistoryData::where('year', (date('Y') - 1))->get();
        if ($DataPastYear->isEmpty()) {
            return null;
        }

        /** @var  $DataPastYear (Get assessor data of last year */
        $DataPastYear = $DataPastYear->first();
        $return = array();
        $return['past'] = json_decode($DataPastYear->assessor_data);
        $return['current'] = self::CurrentAssessorData();
        die(json_encode($return));
    }

    public function ajaxGetActieveFrom($table)
    {
        if (Schema::hasTable($table)) {

            if (Functions::getTablename($A = new Assessors()) == $table) {
                $assessors = Assessors::where('status', 1)->where('email', '!=', '')->orderBy('name', 'asc')->get();
                if ($assessors->isEmpty()) {
                    return array(
                        'status' => false,
                        'message' => 'Er waren geen Assessoren gevonden die actief waren en/of geen e-mail hebben.'
                    );
                }
                return $assessors;
            }elseif (Functions::getTablename($T = new Teamleaders()) == $table) {
                $teamleaders = Teamleaders::where('email', '!=', '')->orderBy('name', 'asc')->get();
                if ($teamleaders->isEmpty()) {
                    return array(
                        'status' => false,
                        'message' => 'Er waren geen Teamleiders gevonden die actief waren en/of geen e-mail hebben.'
                    );
                }
                return $teamleaders;
            }
        }
    }

    public function ajaxGetColleges($option)
    {
        $json = '<option value="Geen"> Geen </option>';
        switch ($option) {
            case 'select':
                $colleges = College::all();
                if ($colleges->isEmpty()) {
                    $json = '<option value="Geen"> Geen </option>';
                }

                foreach ($colleges as $college) {
                    $json = $json . '<option value="' . $college->id . '"> ' . $college->name . ' </option>';
                }
                break;
        }
        return json_encode($json);
    }

    public function ajaxGetAssessor($id)
    {
        $assessor = Assessors::find($id);
        if (empty($assessor)) {
            return json_encode(false);
        }
        $assessor->fk_college = College::find($assessor->fk_college);
        $assessor->fk_teamleader = Teamleaders::find($assessor->fk_teamleader);
        return json_encode($assessor);
    }

    public function ajaxCheckPassword($password)
    {
        return json_encode(Hash::check($password, Auth::user()->password));
    }

    public function ajaxResendMails(Request $request)
    {
        $validator = Validator::make($request->all(), array(
            'emails' => 'required'
        ));

        if ($validator->fails()) {
            return false;
        }

        $status = array(
            'sended' => array(),
            'failed' => array()
        );

        foreach ($request->emails as $key => $mail_id) {
            $email = Email::find($mail_id);
            if (empty($email)) {
                $status['failed'][] = $mail_id;
            } else {
               $sendStatus = Email::resend($mail_id);
                if ($sendStatus) {
                    $status['sended'][] = $mail_id;
                    $email->send = 1;
                    $email->save();
                } else {
                    $status['failed'][] = $mail_id;
                    $email->send = 0;
                    $email->save();
                }
            }
        }

        return $status;
    }

    public function downloadExcelAssessorLayout()
    {
        Excel::create('Assessor Lijst Layout', function ($excel) {

            // Set the title
            $excel->setTitle('Assessor Lijst Layout');

            // Chain the setters
            $excel->setCreator($this->creator)
                ->setCompany($this->company)
                ->setTitle('Assessor Lijst')
                ->setDescription('Deze layout zal gebruikt worden om assessoren lijsten te importeren in het systeem');

            // Our first sheet
            $excel->sheet('Lijst', function ($sheet) {
                $sheet->row(1, array(
                    'Naam deelnemer', 'Naam College', 'Naam Team', 'Geboorte Datum', 'Functie', 'Training verzorgd door', 'Diploma uitgegeven door', 'Beroepskerntaak', 'Status (Actief, Non-actief, Anders)', 'Basistraining behaald (Ja/Nee)', 'Laatste basistraining datum', 'Email'
                ));

                // Set width for multiple cells
                $sheet->setWidth(array(
                    'A' => 25,
                    'B' => 25,
                    'C' => 20,
                    'D' => 20,
                    'E' => 11,
                    'F' => 38,
                    'G' => 30,
                    'H' => 30,
                    'I' => 38,
                    'J' => 40,
                    'K' => 40,
                    'L' => 25
                ));

                // Set height for a single row
                $sheet->setHeight(1, 50);

                $sheet->cells('A1:L1', function ($cells) {
                    // manipulate the range of cells
                    $cells->setBackground('#FFFF00');
                    // Set font
                    $cells->setFont(array(
                        'family' => 'Verdana',
                        'size' => '12',
                        'bold' => true
                    ));
                    // Set all borders (top, right, bottom, left)
                    $cells->setBorder('solid', 'solid', 'solid', 'solid');
                    // Set vertical alignment to middle
                    $cells->setValignment('center');
                });

                // Set border for range
                $sheet->setBorder('A1:L1', 'thin');

                // Set auto filter for a range
                $sheet->setAutoFilter('A1:L1');

                // Set multiple column formats
                $sheet->setColumnFormat(array(
                    'D' => 'yyyy-mm-dd',
                    'K' => 'yyyy-mm-dd',
                ));

                /*// Advanced protect
                $sheet->protect('ROCTRACKER', function(\PHPExcel_Worksheet_Protection $protection) {
                    $protection->setSort(true);
                });*/
            });

        })->download('xlsx');
        exit(200);
    }

    public function CronJobs()
    {
        $schedule = ScheduleEmailTasks::where('at_date', '!=', null)->where('done', 0)->get();
        if (!$schedule->isEmpty()) {
            foreach ($schedule as $email) {
                $date_deployment = Carbon::createFromFormat('Y-m-d H:i:s', $email->at_date);
                $date_now = Carbon::now();
                if ($date_now > $date_deployment) {
                    $mailtext = MailTexts::find($email->fk_mail_texts);
                    $mail_receivers = json_decode($email->to);
                    $receiverTable = $email->table;
                    foreach ($mail_receivers as $key => $receiverID) {
                        $receiver = DB::table($receiverTable)->find($receiverID);
                        $validation = Validator::make(array('email' => $receiver->email), array('email' => 'email'));
                        if ($validation->fails()) {
                            $registerMail = new Email();
                            $registerMail->to = $receiver->name;
                            $registerMail->from = Email::$from;
                            $registerMail->subject = $mailtext->subject;
                            $registerMail->text = $mailtext->text;
                            $registerMail->send = 0;
                            $registerMail->save();
                        }

                        $attachments = !empty($email->uploaded_files) ? json_decode($email->uploaded_files) : null;
                        /*echo "sended mail to: " . $receiver->email . "<br>";*/
                        Email::send($receiver->email, $mailtext->type, $mailtext->subject, $mailtext->title, $mailtext->text, $attachments);
                    }

                    $email->done = 1;
                    $email->save();
                }
            }
            return response(200);
        }

        if (Carbon::now()->format('m') == 12) {
            $schedule_repeated = ScheduleEmailTasks::where('done', 1)->where('repeat', 1)->get();
            if (!$schedule_repeated->isEmpty()) {
                foreach ($schedule_repeated as $emailTask) {
                    $emailTask->at_date = Carbon::createFromFormat('Y-m-d H:i:s', $emailTask->at_date)->addYear()->toDateTimeString();
                    $emailTask->done = 0;
                    $emailTask->save();
                }
                return response(200);
            }
        }

        return response(202);
    }

    public static function random_color()
    {
        return self::random_color_part() . self::random_color_part() . self::random_color_part();
    }

    private static function CurrentAssessorData()
    {
        $colleges = College::all();
        if ($colleges->isEmpty()) {
            return null;
        }
        $counts = array();
        foreach ($colleges as $college) {
            $counts['data'][] = array(
                'label' => $college->name,
                'data' => Assessors::where('fk_college', $college->id)->count(),
                'value' => Assessors::where('fk_college', $college->id)->count(),
                'color' => "#" . self::random_color(),
            );
        }
        return $counts;
    }

    private static function random_color_part()
    {
        return str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
    }
}
