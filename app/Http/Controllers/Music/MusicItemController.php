<?php

namespace App\Http\Controllers\Music;

use App\Http\Controllers\Controller;
use App\Models\RecordModel;
use Illuminate\Http\Request;

class MusicItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return RecordModel::orderBy('id')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RecordModel
     */
    public function store(Request $request)
    {
        $newItem = new RecordModel;
        $newItem->name = $request->record["name"];
        $newItem->artist = $request->record["artist"];
        $newItem->owner = $request->record["owner"];
        $newItem->amount = $request->record["amount"];
        $newItem->type = $request->record["type"];

        $newItem->save();

        return $newItem;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}