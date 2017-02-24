<?php

namespace App\Http\Controllers;

use App;
use App\Assessors;
use App\College;
use App\HistoryData;
use App\Log;
use App\Teamleaders;
use App\TiC;
use App\User;
use App\Exams;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getDashboard($year=null) {
        $c_assessors = Assessors::where('status', '=', '1')->get()->count();
        $c_teamleaders = Teamleaders::all()->count();
        $c_colleges = College::all()->count();
        $sortedData = HistoryData::sorted($year);
        return view('dashboard')
                    ->withCounta($c_assessors)
                    ->withCountt($c_teamleaders)
                    ->withCountc($c_colleges)
                    ->withHistorydatas($sortedData);
    }

    /**
     * COLLEGES *****************************************************
     */

    /**
     * @return mixed
     */
    public function getColleges() {
        return view('colleges')->withColleges(College::getColleges());
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getCollegeTimeline($id)
    {
        $colleges = College::getColleges($id);
        return view('college-view')->withColleges(College::getColleges($id))->withLogs(json_decode($colleges['college']->log));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getChangeColleges($id) {
        return view('change-college')->withColleges(College::getColleges($id));
    }

    /** END COLLEGES. *********************************************/



    /**
     * TEAMLEADERS ***************************************************
     */

    /**
     * @return mixed
     */
    public function getTeamleaders() {
        return view('teamleaders')->withTeamleaders(Teamleaders::getTeamleaders());
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getTeamleaderTimeline($id) {
        return view('teamleader-view')->withColleges(College::getColleges($id))->withTeamleader(Teamleaders::find($id))->withLogs(json_decode(Teamleaders::find($id)->log));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getChangeTeamleader($id) {
        return view('change-teamleader')->withTeamleader(Teamleaders::find($id))->withAssigned(TiC::AssignedCollege($id))->withColleges(College::all());
    }

    public function getAddTeamleader () {
        return view('teamleader-add-manual')->withColleges(College::all());
    }

    /** END TEAMLEADERS.***********************************************/




    /**
     * ASSESSORS *******************************************************
     */

    /**
     * @return mixed
     */
    public function getAssessors()
    {
        return view('assessoren')->withAssessors(Assessors::getAssessors());
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getAssessorProfile($id)
    {
        return view('assessor-profile')->withAssessor(Assessors::getAssessors($id))->withLogs(Log::limit(Assessors::find($id)->log));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getAssessorTimeline($id) {
        return view('assessor-view')->withAssessor(Assessors::getAssessors($id))->withLogs(json_decode(Assessors::find($id)->log));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getChangeAssessor($id) {
        return view('change-assessor')->withAssessor(Assessors::getAssessors($id))->withColleges(College::all());
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAddAssessor () {
        return view('assessor-add');
    }

    /**
     * @return mixed
     */
    public function getAddAssessorManual () {
        return view('assessor-add-manual')->withColleges(College::all());
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAddAssessorAutomatic () {
        return view('assessor-add-automatic');
    }

    /** END ASSESSORS.**************************************************/


    /**
     * Assessor Maintenance *******************************************************
     */

    public function getAssessorMaintenance () {
        $assessors_need_maintenance = Exams::MaintenanceUpdate();
        return view('maintainance-overview')->withAssessors($assessors_need_maintenance);
    }

    public function getAssessorMaintenanceData () {
        return view('maintenance-add-data');
    }

    /** Assessor Maintenance ******************************************************/

    /**
     * @return mixed
     */
    public function getUsers()
    {
        return view('administrators')->withUsers(User::all());
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getNewUsers()
    {
        return view('new-administrators');
    }
}
