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

        $homes = DB::table('properties')->where('owner', $id)->get();
        return view('home',['pic'=>$user_profilepic, 'name'=>$name, 'homes'=>$homes]);
    }
}
