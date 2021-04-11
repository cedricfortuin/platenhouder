<?php

namespace App\Http\Controllers;

use App\Models\RecordModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $records = DB::table('records')->get();
        $total = DB::table('records')->count();
        $megaTotal = DB::table('records')->sum('amount');

        return view('index', compact('total', 'megaTotal', 'records'));
    }

    protected function addRecord(Request $request)
    {
        $request->validate([
            'name' => 'required|max:256',
            'artist' => 'required|max:256',
            'owner' => 'required|max:256',
            'amount' => 'required|max:256',
            'type' => 'required|max:256'
        ]);

        RecordModel::create([
            'name' => $request->name,
            'artist' => $request->artist,
            'owner' => $request->owner,
            'amount' => $request->amount,
            'type' => $request->type
        ]);

        Alert::toast('Succesvol toegevoegd!', 'success');
        return redirect()->back();
    }

    protected function updateRecord(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:256',
            'artist' => 'required|max:256',
            'amount' => 'max:256',
            'owner' => 'max:256'
        ]);

        RecordModel::where('id', '=', $id)
            ->update([
                'name' => $request->name,
                'artist' => $request->artist,
                'owner' => $request->owner,
                'amount' => $request->amount
            ]);

        Alert::toast('Succesvol aangepast!', 'success');
        return redirect()->back();
    }
}
