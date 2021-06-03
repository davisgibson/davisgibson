<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mapper;

class SearchController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware(['auth', 'onboarding']);
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index(Request $request)
    // {
    //     return view('search.index')->with([
    //         'search' => $request->user()->search,
    //     ]);
    // }

    // public function dashboard(Request $request)
    // {
    //     return view('search');
    // }

    public function index()
    {
    	Mapper::location('710 N Preston St Ennis, TX')->streetview(1, 1, ['ui' => false]);

    	return view('search');
    }
}
