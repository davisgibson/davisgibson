<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class HouseController extends Controller
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

    public function insert(Request $request)
    {
         $checked = $request['selling'];
         if($request['selling'] == 'on'){
           $checked = 1;
         }

        $type = $request['prop'];
        $footage = $request['footage'];
        $address = $request['address'];
        $ForSale = $checked;
        $description = $request['description'];
        $beds = $request['beds'];
        $baths = $request['baths'];
        $list_price = $request['list'];
        $cash = $request['cash'];
        $owner = Auth::id();

        $data = array('owner' => $owner, 'type' => $type, 'description' => $description, 'footage' => $footage, 'address' => $address, 'listPrice' => $list_price, 'cashPrice' => $cash, 'ForSale' => $ForSale, 'bed' => $beds,
         'bath' => $baths);

        DB::table('properties')->insert($data);

        return redirect('/home');
    }

    public function index()
    {
        return view('house');
    }
}
