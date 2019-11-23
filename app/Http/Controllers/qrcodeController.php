<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
// use QrReader;

class qrcodeController extends Controller
{
    public function qrcode(){
        $list_qr = DB::table('tblqrcode')->get();
        return view('qrcode')->with('list_qr',$list_qr);
    }

    public function getqrcode(Request $request)
    {

        // ================= my code=========================
        // log::info($request->preview);
        // log::info('C:/Users/Fjr3P/Desktop/'.$request->preview);
        // $qrcode = new QrReader($request->preview);
        
        // $text = $qrcode->text();
        // log::info($text);
        // $list_qr = DB::table('tblqrcode')->get();
        if(empty($request->not_found)){
            return view('qrcode')->with('list_qr',$list_qr);
        }else{
            $detail = DB::table('tblqrcode')
            ->leftjoin('tblqrdetail','tblqrcode.id','=','tblqrdetail.id_qrcode')
            ->where('qr_code','=',$request->not_found)
            ->first();
            return view('qrcode')->with('detail',$detail);
        }
    }

    public function viewVueQRcode(){
        return view('index');
    }

    public function vueCallLaravel(){
        $data = DB::table('tblqrcode')->get();
        return $data;
    }
}
