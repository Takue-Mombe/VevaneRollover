<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Models\filetable;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
//use App\Models\filetable;

class fileController extends Controller
{


    function upload(Request $request){

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
            $fileSize=$file->getSize();







            //saves the file's metadata to the files table

            filetable::create([
                //original file name
               'file-name'=>$file->getClientOriginalName(),
               //file extension
               'file-type'=>$file->getClientOriginalExtension(),
               //file path
               'file-path'=>$filePath,
                'file-size'=>$fileSize,
                'user-id'=>$userName,
            ]);
            //Sends a JSON response back to the client confirming a successful upload.
            return response()->json(['success'=>'File uploaded successfully. Uploaded By: {$userName}'], 200);
        }
        //an error message that is returned when the file fails to upload for some reason
        return response()->json(['error'=>'File not uploaded.']);
    }
}
