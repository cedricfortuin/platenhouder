<?php

namespace App\Http\Controllers;

use Aerni\Spotify\Spotify;
use App\Exports\RecordExport;
use App\Models\RecordModel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class IndexController extends Controller
{
    public function index()
    {

        $name = 'Wish You Were Here';
        $double = RecordModel::where('name', '=', $name)->first();
        if ($double !== null) {
            dd($double);
        } else {
            dd('Hello World');
        }

        $records = RecordModel::orderBy('id')->paginate(30);
        $total = RecordModel::all()->count();

        return view('index', compact('records', 'total'));
    }

    public function addRecord(Request $request)
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

        return redirect()->route('index')->with('message', 'Plaat succesvol toegevoegd');
    }

    public function deleteRecord($id)
    {
        RecordModel::where('id', '=', $id)->delete();
        return redirect()->route('index')->with('message', 'Plaat succesvol verwijderd');
    }

    public function deleteAllRecords()
    {
        RecordModel::truncate();
        return redirect()->route('index')->with('message', 'Alles is succesvol verwijderd');
    }

    public function exportRecords()
    {
        return Excel::download(new RecordExport, 'recordExport_'. date('d-m-Y') . '.xlsx');
    }

    public function updateRecord(Request $request, $id)
    {
        $request->validate([
            'new_amount' => 'required|max:256'
        ]);

        RecordModel::where('id', '=', $id)
            ->update([
                'amount' => $request->new_amount
            ]);

        return redirect()->route('index')->with('message', 'Succesvol aangepast');
    }

    public function checkIfExists($name)
    {

    }
}
