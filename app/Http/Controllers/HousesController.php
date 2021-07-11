<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mapper;
use Illuminate\Support\Facades\Storage;

class HousesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'onboarding']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $currentURL = url()->current();
        $URLpart = explode("/", $currentURL);

        $homes = DB::table('properties')->where('id', end($URLpart))->first();

        if (!empty($homes)){
          Mapper::location($homes->address)->streetview(1, 1, ['ui' => false]);
        }

        $owned = false;
        if ($homes->owner == Auth::id()){
          $owned = true;
        }

        $folder = "/uploads/houses/".$homes->id."/";
        $files = Storage::disk('public')->files($folder);
        $allFiles = array();
        foreach($files as $file){
          $new = "/storage/" . $file;
          $allFiles[] = $new;
        }
        $sale = $homes->ForSale;

        $report = "uploads/reports/".$homes->id."/";
        $report = Storage::disk('public')->files($report);
        if (!empty($report)){
          $report = $report[0];
          $report = "/storage/" . $report;
        }

        return view('housePage', ['id'=>end($URLpart),'null'=>empty($homes),'owned'=>$owned,'user'=>Auth::id(),'sale'=>$sale,'files'=>$allFiles, 'report'=>$report]);
    }

    public function download($file){
      return response()->file($file);
    }
}
