<?php

namespace App\Http\Controllers;

use App\Email;
use App\SystemLog;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Mockery\Exception;
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
            $email = new Email();
            $email->to = $user->email;
            $email->from = "roctracker@gmail.com";

            $text = "<p>U bent successvold geregistreerd in ons systeem,</p><br>";
            $text = $text . "<p>Dit zijn uw login gegevens, Houd deze voor u zelf.<br>
                                Wij zullen u nooit vragen voor uw wachtwoord
                            </p><br>
                             <p>Gebruikersnaam: ". $user->email ." <br> Wachtwoord: ". $request->password ."</p>";
            try {
                Email::send($user->email, "success", "Registratie ROCTracker", "Uw Registratie gegevens.", $text);
                $email->text = $text;
                $email->send = 1;
                $email->save();
            } catch (\Exception $e) {
                $email->text = $text;
                $email->send = 0;
                $email->save();

                SystemLog::create(array(
                    'title' => 'Email Registration',
                    'subject' => "Error on send()",
                    'fk_users' => Auth::user()->id,
                    'message' => $e->getMessage(),
                ));
            }
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
