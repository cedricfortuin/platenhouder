<?php

namespace App\Http\Controllers;

use Aerni\Spotify\Spotify;
use App\Exports\RecordExport;
use App\Models\RecordModel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class IndexController extends Controller
{
    /**
     * IndexController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $pagination = (new ConfigurationController)->getConfigValueByKey('CONFIG_ENABLE_PAGINATION');

        if ($pagination[0] == '1') {
            $records = RecordModel::orderBy('id')->paginate(30);
        } else {
            $records = RecordModel::all();
        }
        $total = RecordModel::all()->count();
        $megaTotal = Request::all()->sum('amount');

        return view('index', compact('records', 'total', 'pagination', 'megaTotal'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteRecord($id)
    {
        RecordModel::where('id', '=', $id)->delete();
        return redirect()->route('index')->with('message', 'Plaat succesvol verwijderd');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAllRecords()
    {
        RecordModel::truncate();
        return redirect()->route('index')->with('message', 'Alles is succesvol verwijderd');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportRecords()
    {
        return Excel::download(new RecordExport, 'recordExport_'. date('d-m-Y') . '.xlsx');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateRecord(Request $request, $id)
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

        return redirect()->route('index')->with('message', 'Succesvol aangepast');
    }
}
