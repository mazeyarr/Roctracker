<?php

namespace App\Http\Controllers;

use App;
use App\Assessors;
use App\College;
use App\Exams;
use App\HistoryData;
use App\Log;
use App\MaintenanceGroups;
use App\Teamleaders;
use App\TiC;
use App\User;
use App\Email;
use App\MailTexts;
use App\ScheduleEmailTasks;
use App\Constructors;
use App\Functions;

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
    public function getDashboard()
    {
        return view('dashboard')->withColleges(College::all())->withGraph(HistoryData::generate());
    }

    public function getAdvancedSearch()
    {
        $searchables = array(
            'none' => "Geen",
            Functions::getTablename($model = new Assessors()) => "Assessoren",
            Functions::getTablename($model = new Teamleaders()) => 'Teamleiders',
            Functions::getTablename($model = new College()) => 'Colleges',
        );
        return view('advanced-search')->withSearch_tables($searchables);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getProfile()
    {
        return view('profile')->withUser(\Auth::user());
    }

    /**
     * COLLEGES *****************************************************
     */

    /**
     * @return mixed
     */
    public function getColleges()
    {
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
    public function getChangeColleges($id)
    {
        return view('change-college')->withColleges(College::getColleges($id));
    }

    public function getAddNewCollege()
    {
        return view('college-add')->withTeamleaders(Teamleaders::all());
    }

    /** END COLLEGES. *********************************************/


    /**
     * TEAMLEADERS ***************************************************
     */

    /**
     * @return mixed
     */
    public function getTeamleaders()
    {
        return view('teamleaders')->withTeamleaders(Teamleaders::getTeamleaders());
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getTeamleaderTimeline($id)
    {

        return view('teamleader-view')->withTeamleader(Teamleaders::find($id))->withLogs(json_decode(Teamleaders::find($id)->log));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getChangeTeamleader($id)
    {
        return view('change-teamleader')->withTeamleader(Teamleaders::find($id))->withAssigned(TiC::AssignedCollege($id))->withColleges(College::all());
    }

    public function getAddTeamleader()
    {
        return view('teamleader-add-manual')->withColleges(College::all());
    }

    /** END TEAMLEADERS.***********************************************/


    /**
     * ASSESSORS *******************************************************
     */

    /**
     * @return mixed
     */
    public function getAssessors($collegeid = false)
    {
        if ($collegeid) {
            return view('assessoren')->withAssessors(Assessors::getCollegeAssessors($collegeid));
        }
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
    public function getAssessorTimeline($id)
    {
        return view('assessor-view')->withAssessor(Assessors::getAssessors($id))->withLogs(json_decode(Assessors::find($id)->log));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getChangeAssessor($id)
    {
        return view('change-assessor')->withAssessor(Assessors::getAssessors($id))->withColleges(College::all());
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAddAssessor()
    {
        return view('assessor-add');
    }

    /**
     * @return mixed
     */
    public function getAddAssessorManual()
    {
        return view('assessor-add-manual')->withColleges(College::all());
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAddAssessorAutomatic()
    {
        return view('assessor-add-automatic');
    }

    /** END ASSESSORS.**************************************************/


    /**
     * Assessor Maintenance *******************************************************
     */

    public function getAssessorMaintenance()
    {
        $assessors_need_maintenance = Exams::MaintenanceUpdate();
        return view('maintainance-overview')->withAssessors($assessors_need_maintenance);
    }

    public function getAssessorMaintenanceGroup()
    {
        return view('maintenance-groups')->withAssessors(Exams::MaintenanceUpdate())->withGroups(MaintenanceGroups::GetGroups());
    }

    /** END Assessor Maintenance ******************************************************/


    /**
     * Officials *******************************************************
     */

    public function getContructors($collegeid = false)
    {
        if ($collegeid) {
            return view('constructors')->withContructors(Constructors::getCollegeConstructors($collegeid));
        }
        return view('constructors')->withContructors(Constructors::get());
    }
    public function getAddContructors()
    {
        return view('constructors');
    }

    public function getDetectors()
    {
        return view('detectors');
    }

    public function getExamCommittee()
    {
        return view('exam-comittee');
    }

    public function getSurveyors()
    {
        return view('surveyors');
    }

    public function getStaffExamOffice()
    {
        return view('staff-exam-office');
    }

    /** END Officials ******************************************************/


    /** Notificaions ******************************************************/

    public function getNotifications()
    {
        $emails = Email::orderBy('updated_at', 'desc')->paginate(15);
        return view('notifications')->withEmails($emails);
    }

    public function getNotification($id)
    {
        $email = Email::find($id);
        $teamleader = Teamleaders::findByMail($email->to);
        if (empty($email)) {
            return redirect()->back()->withInfo("Email niet gevonden !");
        }
        return view('notification-view')->withEmail($email)->withTeamleader($teamleader);
    }

    public function getCreeateNotifications()
    {
        return view('notification-create')->withTexts(ScheduleEmailTasks::getAll())->withTypes(MailTexts::$mailTypes);
    }

    /** END Notificaions **************************************************/

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
