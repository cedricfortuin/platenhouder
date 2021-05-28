<?php

namespace App\Http\Controllers\Use;

use App\Http\Controllers\Controller;
use App\Models\WaterMeasurementsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $thing[] = DB::table('watermeasurements')->orderByDesc('created_at')->first();
        $thing2 = $thing[0];
        unset($thing2->id);
        unset($thing2->created_at);
        unset($thing2->updated_at);

        return view('index')->with('thing', json_encode($thing2,JSON_NUMERIC_CHECK));
    }

    public function music()
    {
        return view('pages.music');
    }
}
