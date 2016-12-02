<?php

namespace App\Http\Controllers;

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
