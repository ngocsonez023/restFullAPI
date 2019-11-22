<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade;
use PDF;
use Validator;
use Auth;
use Illuminate\Support\Facades\Log;
use DB;
//for requesting a value 
use Illuminate\Support\Collection;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Maatwebsite\Excel\Concerns\FromCollection;  
use Maatwebsite\Excel\Concerns\WithHeadings;

class ImportExcel implements ToCollection, WithHeadingRow
{
    public $data;
    public function collection(Collection $rows)
    {
        $code_model = $rows->map->only(['qr_code']);

        $codedb = DB::table('tblqrcode')->select('qr_code')
                    ->whereIn('qr_code',$code_model)->get();
        if($codedb->isEmpty()){
            DB::table('tblqrcode')->insert($rows->toArray());
        }
        return $this->data = $codedb;
    }
}

class ExportsController extends Controller implements FromCollection, WithHeadings{
 // protected $from;
 // protected $to;
 //    public function __construct( $from,$to)
 //    {
 //        $this->from = $from;
 //        $this->to = $to; 
 //    } 
    public function collection()
    {
        $data = DB::table('tblqrcode')->get();
        
        return (collect($data));
    }
    public function headings(): array
    {
        return [
            'id',
            'qr code',
        ];
    }
}

class importExportController extends Controller
{
    public function viewImportExportExcel()
    {
        $data = DB::table('tblqrcode')->get();
        return view('importExport')->with('data',$data);
    }
    // export PDF
    public function exportpdf()
    {
        $data = ['name' => 'hello world'];
        $pdf = PDF::loadView('invoice',  compact('data'));
            return $pdf->download('invoice.pdf');
    }
    // import excel
    public function importExcel()
    {
        $validator = Validator::make(request()->all(), [
        'file' => 'mimes:xlsx',
        ]);
        if ($validator->fails()){
            return redirect()->back()->withErrors("Sai định dạng của file.
            Vui lòng chọn lại");
        }
        if (request()->file('file') == null) {
            return redirect()->back()->withErrors("Bạn Cần Chọn File Nhập.");
        }
        else{
            $use_ImportExcel = new ImportExcel;
            Excel::import($use_ImportExcel, request()->file('file'));
            if($use_ImportExcel->data->isNotEmpty())
            {
                return back()->with('info',$use_ImportExcel->data .'Đã Tồn Tại! Vui lòng chỉnh sửa file Nhập');
            }else{
            return back()->withErrors("Import Thành Công");
            }
        }
    }
    // export excel
     public function exportExcel(Request $request) 
    {
        // không tham số
        return Excel::download(new ExportsController(), 'ListCode.xlsx');
        //có tham số
        // $from = $request->from;
        // $to = $request->to;
        // return Excel::download(new ExportsController($from,$to), 'ListOrder.xlsx');
    }
}
