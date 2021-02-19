<?php

namespace App\Http\Controllers;

use App\Home;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
    	return $this->middleware('auth');
    }

    public function onboarding()
    {
    	return view('onboarding.select');
    }

    public function code(Request $request)
    {
    	return view('onboarding.code');
    }

    public function assignHome(Request $request)
    {
    	$request->validate([
    		'key' => 'required|exists:homes',
    	]);

    	$request->user()->update(['home_id' => Home::findKey($request->key)->id]);

    	return redirect('/home');
    }

    public function newHome(Request $request)
    {
    	$home = Home::create([
    		'key' => Str::random(10),
    	]);

    	$request->user()->update(['home_id' => $home->id]);

    	return redirect('/home');
    }
}
