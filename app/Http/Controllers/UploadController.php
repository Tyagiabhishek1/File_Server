<?php

namespace App\Http\Controllers;


require '../vendor/autoload.php';
use Illuminate\Http\Request;
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    public function fileUpload(Request $request){
 
    if($request->hasFile('uploaded_file')) {
      
 
    //file extension
    $extension = $request->file('uploaded_file')->getClientOriginalExtension();

    //new filename
    $new_filename = time().'.'.$extension;
    //Upload File
    Storage::disk('s3')->put($new_filename, fopen($request->file('uploaded_file'), 'r+'));
    die("Hg");

    //Do the DB queries to save file URL
 }
}
   
}