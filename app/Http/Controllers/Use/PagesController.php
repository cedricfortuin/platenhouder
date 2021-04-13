<?php

namespace App\Http\Controllers\Use;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('index');
    }

    public function music()
    {
        return view('pages.music');
    }
}
