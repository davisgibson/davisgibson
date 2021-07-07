<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
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
      $user = User::findOrFail(auth()->user()->id);
      $agent = $user->agent;
      return view('settings',['agent'=>$agent]);
    }

    public function update(Request $request)
    {
        // Form validation
        $request->validate([
            'name'              =>  'required',
            'email'             =>  'required'
        ]);

        // Get current user
        $user = User::findOrFail(auth()->user()->id);
        // Set user name
        $user->name = $request->input('name');

        $user->email = $request->input('email');

        $user->balance = $request->input('balance');

        $agent = $user->agent;

        $user->commision = $request->input('commision');
        // Persist user record to database
        $user->save();

        // Return user back and show a flash message
        return redirect()->back()->with(['status' => 'Profile updated successfully.','agent'=>$agent]);
    }
}
