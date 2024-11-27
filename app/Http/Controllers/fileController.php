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

        //validating if the file has the correct parameters/extensions
        if($request->hasFile('file')){


            $file = $request->file('file');
            //adding a timestamp to the filename to prevent it from being overwritten
            $fileName=time() . '_'. $file->getClientOriginalName();
            //aves the file in the storage/app/public/uploads directory with the given name.
            $filePath=$file->storeAs('uploads',$fileName,'public');



            //saves the file's metadata to the files table
            File::create([
                //original file name
               'name'=>$file->getClientOriginalName(),
               //file extension
               'type'=>$file->getClientOriginalExtension(),
               //file path
               'path'=>$filePath,
            ]);
            //Sends a JSON response back to the client confirming a successful upload.
            return response()->json(['success'=>'File uploaded successfully.']);
        }
        //an error message that is returned when the file fails to upload for some reason
        return response()->json(['error'=>'File not uploaded.']);
    }
}
