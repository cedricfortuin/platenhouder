<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    /**
     * ConfigurationController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     * @param $key
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function updatePagination(Request $request)
    {
        $request->validate([
            'value' => 'required'
        ]);

        if ($request->value == 'on') {
            $update = '1';
        } elseif($request->value == null) {
            $update = '0';
        }

        dd($update);

        Configuration::where('key', '=', 'CONFIG_ENABLE_PAGINATION')
            ->update([
                'value' => $update
            ]);

        return redirect()->route('index')->with('message', 'Instelling is bijgewerkt');
    }

    /**
     * @param $key
     * @return mixed
     */
    public function getConfigValueByKey($key)
    {
        return Configuration::where('key', '=', $key)->pluck('value');
    }
}
