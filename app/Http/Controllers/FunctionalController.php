<?php

namespace App\Http\Controllers;

use App\Assessors;
use App\College;
use App\Log;
use App\Teamleaders;
use App\HistoryData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class FunctionalController extends Controller
{
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
