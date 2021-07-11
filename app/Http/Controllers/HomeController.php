<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
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
    public function index(Request $request)
    {
        return view('home.index')->with([
            'home' => $request->user()->home,
        ]);
    }

    public function dashboard(Request $request)
    {
        $user = Auth::user();
        $id = Auth::id();
        $user_profilepic = "storage".$user->profilepic;
        $name = $user->name;

        $sales = DB::table('escrow')->where('seller',$id)->get();
        $buys = DB::table('escrow')->where('buyer',$id)->get();
        $listings = DB::table('properties')->where('owner',$id)->get();

        $events = array();
        foreach($sales as $sale){
          $house = DB::table('properties')->where('id', $sale->houseid)->first();
          $data = array('address'=>$house->address, 'status'=>"Escrow - selling");
          $events[] = $data;
        }
        foreach($buys as $buy){
          $house = DB::table('properties')->where('id', $buy->houseid)->first();
          $data = array('address'=>$house->address, 'status'=>"Escrow - buying");
          $events[] = $data;
        }
        foreach($listings as $listing){
          $data = array('address'=>$listing->address, 'status'=>"For Sale");
          $events[] = $data;
        }

        $collects = collect($events);

        $homes = DB::table('properties')->where('owner', $id)->get();

        return view('home',['pic'=>$user_profilepic, 'name'=>$name, 'homes'=>$homes,'events'=>$collects]);
    }
}
