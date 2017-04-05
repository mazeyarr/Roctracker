<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Validator;

class UserController extends Controller
{
    public function postNewAdmin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput(Input::all());
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        if (!empty($request->send_mail)) {
            /* Send mail to this user */

        }

        return redirect()->route('add_users')->withSuccess('Gebruiker was opgeslagen !')->withUser($user);
    }

    public function getLockScreen()
    {
        if (!Session::has('locked')) {
            Session::put('locked');
        }
        return view('auth.lock')->withUser(Auth::user());
    }

    public function postUnlockScreen(Request $request)
    {
        if (Hash::check($request->password, Auth::user()->password)) {
            Session::forget('locked');
            return redirect()->route('dashboard');
        } else {
            return redirect()->back();
        }
    }
}
