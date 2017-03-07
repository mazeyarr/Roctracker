<?php

namespace App\Http\Controllers;

use App\Assessors;
use App\College;
use App\Functions;
use App\Log;
use App\MaintenanceGroups;
use App\Teamleaders;
use App\HistoryData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Validator;

class FunctionalController extends Controller
{
    public $creator;
    public $company;

    function __construct()
    {
        $this->creator = "RocTracker";
        $this->company = "MRG Studios";
    }

    public function ajaxSaveCollege ($id, $name, $location, $team) {
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
        if (is_numeric($location) || $location == "" || empty($location)) {
            return json_encode(array(
                'result' => 'failed',
                'message' => 'Locatie was niet juist ingevuld.'
            ));
        }
        $college = College::find($id);
        $college->name = $name;
        $college->location = $location;
        $college->team = $team;
        $college->save();
        return json_encode(array('result' => 'executed'));
    }

    public function ajaxSaveTeamleader ($id, $name, $team) {
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
        $teamleader->team = $team;
        $teamleader->save();
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

    public function ajaxGetHistoryData () {
        die(HistoryData::all()->toJson());
    }
    public function ajaxGetAssessorData () {

        $DataPastYear = HistoryData::where('year', (date('Y') - 1))->get();
        if ($DataPastYear->isEmpty()) { return null; }

        /** @var  $DataPastYear (Get assessor data of last year*/
        $DataPastYear = $DataPastYear->first();
        $return = array();
        $return['past'] = json_decode($DataPastYear->assessor_data);
        $return['current'] = self::CurrentAssessorData();
        die(json_encode($return));
    }

    public function ajaxGetColleges ($option){
        $json = '<option value="Geen"> Geen </option>';
        switch ($option) {
            case 'select':
                $colleges = College::all();
                if ($colleges->isEmpty()) {
                    $json = '<option value="Geen"> Geen </option>';
                }

                foreach ($colleges as $college) {
                    $json = $json . '<option value="'.$college->id.'"> '.$college->name.' </option>';
                }
                break;
        }
        return json_encode($json);
    }

    public function ajaxAddMaintenanceGroup() {
        $Group = new MaintenanceGroups();
        $Group->title = "Groep " . Log::generateRandomString(5);
        $Group->participants = '{"participants": []}';
        $Group->year = date('Y');
        $Group->save();

        $rows = "";
        for ($i = 1; $i < 16; $i++) {
            $rows = $rows . '<tr>
                                <th scope="row">'.$i.'</th>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>';
        }
        $rows = preg_replace("/\r|\n/", "", trim($rows));
        $element = '
            <div class="panel panel-info">
            <div class="panel-heading"> '. $Group->title .' </div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                    <h4>Deelnemers</h4>
                    <tr>
                        <th>#</th>
                        <th>Naam</th>
                        <th>College</th>
                        <th>Teamleider</th>
                    </tr>
                    </thead>
                      <tbody>
                          '.$rows.'
                      </tbody>
                  </table>
              </div>
            </div>
        ';

        return json_encode(preg_replace("/\r|\n/", "", trim($element)));
    }

    public function downloadExcelAssessorLayout () {
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
                    'Naam deelnemer', 'Naam College', 'Naam Team', 'Geboorte Datum', 'Functie', 'Training verzorgd door', 'Diploma uitgegeven door', 'Naam Teamleider (1 Persoon)', 'Status (Actief, Non-actief, Anders)', 'Basistraining behaald (Ja/Nee)',
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
                    'J' => 40
                ));

                // Set height for a single row
                $sheet->setHeight(1, 50);

                $sheet->cells('A1:J1', function ($cells) {
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
                $sheet->setBorder('A1:J1', 'thin');

                // Set auto filter for a range
                $sheet->setAutoFilter('A1:J1');

                // Set multiple column formats
                $sheet->setColumnFormat(array(
                    'D' => 'yyyy-mm-dd'
                ));

                // Advanced protect
                $sheet->protect('ROCTRACKER', function(\PHPExcel_Worksheet_Protection $protection) {
                    $protection->setSort(true);
                });
            });

        })->download('xlsx');
        exit(200);
    }

    private static function CurrentAssessorData (){
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
    private static function random_color_part() {
        return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
    }

    private static function random_color() {
        return self::random_color_part() . self::random_color_part() . self::random_color_part();
    }
}
