<?php

namespace App\Http\Controllers\Export;

use App\Exports\RecordExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportRecords()
    {
        return Excel::download(new RecordExport(), 'recordExport_'. date('m-Y_H:i') .'.csv');
    }
}
