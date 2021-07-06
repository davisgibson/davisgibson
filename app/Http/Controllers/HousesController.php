<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mapper;

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


        return view('housePage', ['id'=>end($URLpart),'null'=>empty($homes)]);
    }
}
