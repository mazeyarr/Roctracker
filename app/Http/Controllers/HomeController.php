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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDashboard()
    {
        return view('dashboard');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getColleges()
    {
        $colleges = College::teamleaders();
        return view('colleges')->withColleges($colleges);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getChangeColleges($id)
    {
        $colleges = College::teamleaders($id);
        return view('change-college')->withColleges($colleges);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTeamleaders()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAssessors()
    {

    }

    /**
     * Show the application Administrators.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUsers()
    {
        return view('administrators')->withUsers(User::all());
    }

    /**
     * Show the New Administrator form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getNewUsers()
    {
        return view('new-administrators');
    }
}
