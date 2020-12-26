<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.auth.login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (!auth()->attempt($request->only('firstname', 'email', 'password'), $request->only('email'))) {
            return back()->with('message', 'Verkeerde inloggegevens.');
        }
        return redirect()->route('index')->with('message', 'Je bent succesvol aangemeld en ingelogd');
    }
}
