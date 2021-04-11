<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LogoutController extends Controller
{
    public function logout()
    {
        auth()->logout();

        Alert::toast('Succesvol uitgelogd!', 'success');
        return redirect()->back();
    }
}
