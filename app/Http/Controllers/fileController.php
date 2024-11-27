<?php

namespace App\Http\Controllers;

use Illuminate\Http\File;
use Illuminate\Http\Request;

class fileController extends Controller
{

    function validateFile(Request $request){
        $request->validate([
            'file' => 'required|file|mimes:jpeg,jpg,png|max:2048'
        ]);

        //Store FIle
        if($request->hasFile('file')){

            $file = $request->file('file');
            $fileName=time() . '_'. $file->getClientOriginalName();
            $filePath=$file->storeAs('uploads',$fileName,'public');



            File::create([
               'name'=>$file->getClientOriginalName(),
               'type'=>$file->getClientOriginalExtension(),
               'path'=>$filePath,
            ]);
        }

    }
}
