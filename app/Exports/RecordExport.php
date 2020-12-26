<?php

namespace App\Exports;

use App\Models\RecordModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class RecordExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return RecordModel::all();
    }
}
