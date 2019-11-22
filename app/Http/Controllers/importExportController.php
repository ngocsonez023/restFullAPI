<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade;
use PDF;

class importExportController extends Controller
{
    public function exportpdf()
    {
        $data = ['name' => 'hello world'];
        $pdf = PDF::loadView('invoice',  compact('data'));
            return $pdf->download('invoice.pdf');
    }
}
