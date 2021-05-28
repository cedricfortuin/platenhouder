<?php

namespace App\Http\Controllers\Calendar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{
    public function index()
    {
        return view('pages.calendar');
    }

    public function calendarEvents()
    {
        return response()->json(DB::table('event_lists')->get(['id', 'title', 'date', 'description']));
    }

    public function editCalendarEvent(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'date' => 'required'
        ]);

        DB::table('event_lists')->where('id', '=', $request->id)->update(['date' => date('Y-m-d', strtotime($request->date))]);

        return $request;
    }
}
