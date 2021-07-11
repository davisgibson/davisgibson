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
            'bed'               =>  'numeric|nullable',
            'baths'             =>  'numeric|nullable',
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
            $checked = $request['selling'];
            if($request['selling'] == 'on'){
              $checked = 1;
            }

            DB::update('update properties set ForSale = ? where id = ?',[$checked, $house]);

            DB::update('update properties set type = ? where id = ?',[$request->prop, $house]);

            if ($request->has('address')){
              if(!empty($request->address)){
                DB::update('update properties set address = ? where id = ?',[$request->address, $house]);
              }
            }

            if ($request->has('description')){
              if(!empty($request->description)){
                DB::update('update properties set description = ? where id = ?',[$request->description, $house]);
              }
            }

            if ($request->has('footage')){
              if(!empty($request->footage)){
                DB::update('update properties set footage = ? where id = ?',[$request->footage, $house]);
              }
            }

            if ($request->has('bed')){
              if(!empty($request->bed)){
                DB::update('update properties set bed = ? where id = ?',[$request->bed, $house]);
              }
            }

            if ($request->has('bath')){
              if(!empty($request->bath)){
                DB::update('update properties set bath = ? where id = ?',[$request->bath, $house]);
              }
            }

            if ($request->has('listPrice')){
              if(!empty($request->listPrice)){
                DB::update('update properties set listPrice = ? where id = ?',[$request->listPrice, $house]);
              }
            }

            if ($request->has('cashPrice')){
              if(!empty($request->cashPrice)){
                DB::update('update properties set cashPrice = ? where id = ?',[$request->cashPrice, $house]);
              }
              else{
                DB::update('update properties set cashPrice = ? where id = ?',[NULL, $house]);
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
              $folder = '/uploads/reports/' . $house . "/";
              $name = 'report';
              $filePath = $folder . $name. '.' . $file->getClientOriginalExtension();
              // Upload image
              $this->uploadOne($file, $folder, 'public', $name);
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
