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
        return view('welcome');
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


}
