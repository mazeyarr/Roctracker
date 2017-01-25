<?php

namespace App\Http\Controllers;

use App\Assessors;
use App\College;
use App\Teamleaders;
use App\TiC;
use App\User;
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
    public function getDashboard()
    {
        return view('dashboard');
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
        return view('college-view')->withColleges($colleges)->withLogs(json_decode($colleges['college']->log));
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
        $colleges = College::getColleges($id);
        return view('teamleader-view')->withColleges($colleges)->withTeamleader(Teamleaders::find($id))->withLogs(json_decode(Teamleaders::find($id)->log));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getChangeTeamleader($id) {
        return view('change-teamleader')->withTeamleader(Teamleaders::find($id))->withAssigned(TiC::AssignedCollege($id))->withColleges(College::all());
    }



    /** END TEAMLEADERS.***********************************************/




    /**
     * ASSESSORS *******************************************************
     */

    public function getAssessors()
    {
        return view('assessoren')->withAssessors(Assessors::getAssessors());
    }
    /** END ASSESSORS.**************************************************/




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
