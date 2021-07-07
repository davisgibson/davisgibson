<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HouseUploadController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }

    public function index(){
      $currentURL = url()->current();
      $URLpart = explode("/", $currentURL);

      $house = $URLpart[4];
      $homes = DB::table('properties')->where('id', $house)->first();
      $owner = false;
      if($homes->owner == Auth::id()){
        $owner = true;
      }
      return view('houseUpload',['id'=>$URLpart[4],'owner'=>$owner]);
    }

    public function uploadFiles(Request $request)
    {
        // Form validation
        $request->validate([
            'profile_image'     =>  'image',
            'report_file'       =>  'file',
        ]);

        // Get current user
        $currentURL = url()->current();
        $URLpart = explode("/", $currentURL);

        $house = $URLpart[4];
        $homes = DB::table('properties')->where('id', $house)->first();
        $owner = false;
        if($homes->owner == Auth::id()){
          $owner = true;
        }

        if($request->submit == "update"){

            if ($request->has('address')){
              if(!empty($request->address)){
                DB::update('update properties set address = ? where id = ?',[$request->address, $house]);
              }
            }

            // Check if a profile image has been uploaded
            if ($request->has('profile_image')) {
                // Get image file
                $image = $request->file('profile_image');
                // Define folder path
                $folder = '/uploads/houses/' . $house . "/";
                if (!file_exists($folder)){
                  Storage::disk('public')->makeDirectory($folder);
                }
                $files = Storage::disk('public')->files($folder);
                // $files = array_diff(scandir($folder), array('.', '..'));
                // Make a image name based on user name and current timestamp
                $last = 0;
                foreach($files as $file){
                  $name = explode(".", $file);
                  $num = preg_replace('/[^0-9.]+/', '', $name);
                  $num = intval($num);
                  if ($num > $last){
                    $last = $num;
                  }
                }
                $last = $last + 1;
                $name = 'house'.$last;
                // Make a file path where image will be stored [ folder path + file name + file extension]
                $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
                // Upload image
                $this->uploadOne($image, $folder, 'public', $name);
            }

            if ($request->has('report_file')){
              // Get image file
              $file = $request->file('report_file');
              // Define folder path
              $folder = '/uploads/houses/' . $house . "/";
              $name = 'report';
              $filePath = $folder . $name. '.' . $file->getClientOriginalExtension();
              // Upload image
              $this->uploadOne($image, $folder, 'public', $name);
            }
          }

        if ($request->submit== "delete"){
          DB::delete('delete from properties where id = ?',[$house]);
          return redirect('home');
        }

        // Return user back and show a flash message
        return redirect()->back()->with(['status' => 'Profile updated successfully.','id'=>$URLpart[4],'owner'=>$owner]);
    }

      public function uploadOne(UploadedFile $uploadedFile, $folder = null, $disk = 'public', $filename = null)
      {
          $name = !is_null($filename) ? $filename : Str::random(25);

          $file = $uploadedFile->storeAs($folder, $name.'.'.$uploadedFile->getClientOriginalExtension(), $disk);

          return $file;
      }

}
