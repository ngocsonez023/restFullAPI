<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Log;

class imageController extends Controller
{
    public function viewImage()
    {
        $data = DB::table('tblimage')->get(); 
        return view('uploadImage', compact('data'));
    }

    public function uploadOneImage(Request $request)
    {
        request()->validate([
 
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
 
        ]);
        $extensions = array('gif','jpg','jpeg','png');
        
        if($request->hasFile('image') and in_array($request->image->extension(), $extensions)){
            $image = $request->image;
            $fileName = time().'.'.$image->getClientOriginalName();
            $image->move('resources/assets/image/', $fileName);
            $name_image = 'resources/assets/image/'.$fileName;
            
            DB::table('tblimage')->insert(['image' => $name_image]);
        }
        return view('welcome');
    }

    public function uploadMultiImage(Request $request)
    {
        if ($image = $request->file('images')) {
           
            foreach ($image as $files) {
            // $filename = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $filename = date('YmdHis') . "." . $files->getClientOriginalName();
            $filepath = 'resources/assets/image/' . $filename;
            $files->move('resources/assets/image/', $filename);
            $listimg[]['image'] = "$filepath";
            
            }
            DB::table('tblimage')->insert($listimg);
        }
        return view('welcome');
    }
}
