<?php

namespace App\Http\Controllers;

use App\College;
use App\Colleges;
use App\Teamleaders;
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
     * @return mixed
     */
    public function getColleges() {
        return view('colleges')->withColleges(College::teamleaders());
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getCollegeTimeline($id)
    {
        $colleges = College::teamleaders($id);
        return view('college-view')->withColleges($colleges)->withLogs(json_decode($colleges['college']->log));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getChangeColleges($id) {
        return view('change-college')->withColleges(College::teamleaders($id));
    }

    /**
     * @return mixed
     */
    public function getTeamleaders() {
        return view('teamleaders')->withTeamleaders(College::teamleaders());
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getTeamleaderTimeline($id) {
        $colleges = College::teamleaders($id);
        return view('teamleader-view')->withColleges($colleges)->withTeamleader(Teamleaders::find($id))->withLogs(json_decode(Teamleaders::find($id)->log));;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getChangeTeamleader($id) {
        return view('change-teamleader')->withTeamleader(Teamleaders::find($id));
    }

    /**
     *
     */
    public function getAssessors()
    {

    }

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
