<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

use DB;

// use PHPZxing\PHPZxingDecoder;

// use Libern\QRCodeReader;

use Libern\QRCodeReader\lib\QrReader;
// use Illuminate\Support\Facades\Input;
use Image;
// use QrReader;
 use Illuminate\Http\Response;
 use Illuminate\Http\UploadedFile;
 use File;
 use Illuminate\Support\Facades\Input;

class GetCompanyAPI extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getAPI(Request $request)
    {
        $result = DB::table('tblqrcode')->select('qr_code')->get();
        return view('welcome')->with('result',$result);
    }

    public function checkExit (Request $request){
        $input = $request->mst;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://thongtindoanhnghiep.co/api/company/{$input}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => json_encode($input),
            CURLOPT_HTTPHEADER => array(
                // Set here requred headers
                "accept: */*",
                "accept-language: en-US,en;q=0.8",
                "content-type: application/json",
            ),
        ));
        $data = curl_exec($curl);
        $response  = json_decode($data);
        $err = curl_error($curl);
        
        curl_close($curl);

        if($response->ID == 0){
            log::info("err");
            $err = "error";
                return view('welcome')->with('err',$err);
        }
        else{
            log::info("yolo");
            
            return view('welcome')->with('data',$response->ID);
        }
    }

    public function autocomplete(Request $request)
    {
        $query = $request->get('query');
        $data = DB::table('tblqrcode')->select('qr_code')
            ->where('qr_code', 'LIKE', "%{$query}%")->limit(8)->get();
        $output = '<ul class="dropdown-menu" style="display:block; position:relative; width: 100%;">';
        foreach($data as $row)
            {
            
            $output .= '<li value = '. $row->qr_code .' class="autoli" style="padding-left: 19px;cursor: pointer;width: 100%; text-align: left;">'.$row->qr_code.'</li>';
            
            }
        $output .= '</ul>';
        echo $output;
    }

}
