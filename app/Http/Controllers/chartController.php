<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Charts;

class chartController extends Controller
{
    public function chart(){
        $chart = Charts::database(DB::table('users')->get(),'pie', 'highcharts')
                  ->title('hello, this is my chart')
                  ->dimensions(1000,500)
                  ->responsive(false)
                  ->groupBy('name');
                  $charts = Charts::database(DB::table('users')->get(),'pie', 'highcharts')
                  ->title('hello, this is my chart')
                  ->dimensions(1000,500)
                  ->responsive(false)
                  ->groupBy('name');
        return view('chart', compact('chart','charts'));   
    }       
}
