<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

class moreRowController extends Controller
{
    public function index(Request $request)
    {
      // $data = array();
      //   array_push($data, array(
      //     'sanpham' => $request->sanpham,
      //   'donvi' => $request->donvi,
      //   'sanluong' => $request->sanluong,
      //   ));
      // // $data[] = array(
      // //         'sanpham' => $request->sanpham,
      // //         'donvi' => $request->donvi,
      // //         'sanluong' => $request->sanluong,
      // //       );
      // Log::info($data);
      return view('welcome');
    }
    public function store(Request $request)
    {
        $test = array();
        $count = $request->count;
        for( $i = 1; $i <= $count ; $i++){
            if($request->input('sanpham'.$i) == null){
                continue;
            }
            array_push($test, array(
                'sanpham' => $request->input('sanpham'.$i),
                'donvi' => $request->input('donvi'.$i),
                'sanluong' => $request->input('sanluong'.$i),
            ));
        }
      Log::info($test);
        $data = json_encode($test);

        // DB::table('tasks')->insert([ 'title' => $data ]);
        return redirect("welcome")->withSuccess('Great! Successfully store data in json format in datbase');
    }

}
