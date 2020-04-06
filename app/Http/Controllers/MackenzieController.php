<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MackenzieController extends Controller
{
    public function show()
    {
    	return view('mackenzie.hello');
    }

    public function love()
    {
    	return view('mackenzie.love');
    }
}
