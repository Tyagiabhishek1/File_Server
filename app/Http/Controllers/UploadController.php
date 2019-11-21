<?php

namespace App\Http\Controllers;


require '../vendor/autoload.php';
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB; 


class UploadController extends Controller
{
    public function UploadVideo(Request $request){
        $user = Auth::user();
        $id=$user->user_id;
        $date_time=now();
        $video_size = $_FILES['video']['size'];
        $video_size_in_kb=$video_size/1024;
        $video_name = $_FILES['video']['name'];
        
        $validator = Validator::make($request->all(), [ 
           'login_id' => 'required|exists:users,login_id',
           'video_type'=>'required',
           'video_expiry' => 'required|numeric|max:12',
           'is_rental' => 'required|in:Y,N',  
           'video_provider_expiry' => 'required|numeric',
           'actual_price' => 'required|numeric', 
           'discount_price' => 'required|numeric',
           'rental_price' => 'required_if:is_rental,Y',
           'video_description' => 'required|max:250', 
           'video_title' => 'required|max:250',
        ]);   
        if ($validator->fails()) {          
           return response()->json(['error'=>$validator->errors()], 200);                        
        }  
        $input = $request->all(); 
        $user_id=$user->user_id;
        $video_details['video_type']=$input['video_type'];
        $video_details['video_expiry']=$input['video_expiry'];
        $video_details['is_rental']=$input['is_rental'];
        $video_details['video_provider_expiry']=$input['video_provider_expiry'];
        $video_details['actual_price']=$input['actual_price'];
        $video_details['discount_price']=$input['discount_price'];
        $video_details['rental_price']=$input['rental_price'];
        $video_details['video_description']=$input['video_description'];
        $video_details['video_title']=$input['video_title'];
        $video_details['update_dt']=$date_time;
        $video_details['user_id']=$user_id;    
        $video_details['video_size']=$video_size;
        $video_details['video_name']=$video_name;    


 
    if($request->hasFile('video')) {
      
 
    
    $extension = $request->file('video')->getClientOriginalExtension(); //file extension

    $url="https://vocab-test.s3.ap-south-1.amazonaws.com/";
    $new_filename = time().'.'.$extension;//new filename
    $video_url=$url.$new_filename;

    $video_details['video_url']=$video_url;    

    
    Storage::disk('s3')->put($new_filename, fopen($request->file('video'), 'r+','public'));  //Upload File

    DB::table('video')
    ->insert($video_details);

    $response = array("code"=>"200",'message'=>'Video Upload Successful');   
    return response()->json(['userMessages' => array($response)]);
 }
}
   
}