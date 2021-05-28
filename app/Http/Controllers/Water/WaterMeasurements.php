<?php

namespace App\Http\Controllers\Water;

use App\Http\Controllers\Controller;
use App\Models\WaterMeasurementsModel;
use Illuminate\Http\Request;

class WaterMeasurements extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return WaterMeasurementsModel::orderby('id')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return WaterMeasurementsModel
     */
    public function store(Request $request)
    {
        $newItem = new WaterMeasurementsModel;
        $newItem->NO3 = $request->measurement["NO3"];
        $newItem->NO2 = $request->measurement["NO2"];
        $newItem->GH = $request->measurement["GH"];
        $newItem->KH = $request->measurement["KH"];
        $newItem->PH = $request->measurement["PH"];
        $newItem->Cl2 = $request->measurement["Cl2"];

        $newItem->save();

        return $newItem;
    }
}
