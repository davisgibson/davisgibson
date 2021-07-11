<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mapper;

class ListingController extends Controller
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
        $currentURL = url()->current();
        $URLpart = explode("/", $currentURL);

        $homes = DB::table('properties')->where('id', $URLpart[4])->first();

        $owner = 1;
        if ($homes->owner==Auth::id()){
          $owner = 2;
        }

        $purchase = false;

        if ($user->balance > $homes->cashPrice){
          $purchase=true;
        }

        $bids = DB::table('bids')->where('property', $homes->id)->get();
        foreach($bids as $bid){
          $bidder = DB::table('users')->where('id',$bid->bidder)->first();
          $bid->bidder = $bidder->name;
        }

        return view('listing',['bids'=>$bids,'id'=>$URLpart[4],'escrow'=>$homes->escrow,'sale'=>$homes->ForSale,'list'=>$homes->listPrice,'cash'=>$homes->cashPrice,'own'=>$owner,'afford'=>$purchase]);
    }

    public function purchase(Request $request)
    {
        // Form validation
        $request->validate([
            'bid'     =>  'numeric|gt:0|nullable'
        ]);

        $checked = $request['anon'];
        if($request['anon'] == 'on'){
          $checked = 1;
        }

        // Get current user
        $currentURL = url()->current();
        $URLpart = explode("/", $currentURL);

        $status = 'uh oh';

        $house = $URLpart[4];
        $homes = DB::table('properties')->where('id', $house)->first();
        $owner = false;
        if($homes->owner == Auth::id()){
          $owner = true;
        }

        if($request->submit == "bid"){
          $seller = $homes->owner;
          $buyer = Auth::id();
          $bid = $request->bid;
          $homeid = $homes->id;

          $data = array('bidder' => $buyer, 'bid' => $bid, 'property' => $homeid, 'anon'=>$anon);
          DB::table('bids')->insert($data);
        }

        if ($request->submit == "purchase"){
          $seller = $homes->owner;
          $buyer = Auth::id();
          $price = $homes->cashPrice;
          $homeid = $homes->id;

          $data = array('buyer' => $buyer, 'seller' => $seller, 'moneyTransfer' => $price, 'houseid' => $homeid, 'anon'=>$anon);

          DB::table('escrow')->insert($data);

          $escrow = DB::table('users')->where('escrow', 1)->first();
          $newBalance = $escrow->balance + $price;

          DB::update('update users set balance = ? where id = ?',[$newBalance, $escrow->id]);

          $buyer = DB::table('users')->where('id', $buyer)->first();
          $newBalance = $buyer->balance - $price;

          DB::update('update users set balance = ? where id = ?',[$newBalance, $buyer->id]);

          DB::update('update properties set escrow = ? where id = ?',[1, $homeid]);
          DB::update('update properties set owner = ? where id = ?',[$buyer->id, $homeid]);
          DB::update('update properties set ForSale = ? where id = ?',[0, $homeid]);

          }

          $bids = DB::table('bids')->where('property', $homes->id)->get();
          foreach($bids as $bid){
            if($request->submit == $bid->id){
              $seller = $homes->owner;
              $buyer = $bid->bidder;
              $price = $bid->bid;
              $homeid = $homes->id;
              $anon = $bid->anon

              $data = array('buyer' => $buyer, 'seller' => $seller, 'moneyTransfer' => $price, 'houseid' => $homeid, 'anon'=>$anon);

              DB::table('escrow')->insert($data);

              $escrow = DB::table('users')->where('escrow', 1)->first();
              $newBalance = $escrow->balance + $price;

              DB::update('update users set balance = ? where id = ?',[$newBalance, $escrow->id]);

              $buyer = DB::table('users')->where('id', $buyer)->first();
              $newBalance = $buyer->balance - $price;

              DB::update('update users set balance = ? where id = ?',[$newBalance, $buyer->id]);

              DB::update('update properties set escrow = ? where id = ?',[1, $homeid]);
              DB::update('update properties set owner = ? where id = ?',[$buyer->id, $homeid]);
              DB::update('update properties set ForSale = ? where id = ?',[0, $homeid]);

              DB::delete('delete from bids where property = ?',[$homeid]);
            }

          return redirect('home');
        }

        // Return user back and show a flash message
        return redirect()->back()->with(['status' => $status,'id'=>$URLpart[4]]);
    }
}
