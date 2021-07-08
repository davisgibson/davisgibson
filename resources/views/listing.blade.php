@extends('layouts.app')

@section('content')
<div class="container">

      @if($sale==true)
        @if($own==1)
          <div class="row">
            <div class="col-md-12">
              <h1>Want to purchase this house?</h1>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <ul>
                <li>List Price: ${{ $list }}</li>
                <li>Cash Price: ${{ $cash }}</li>
              </ul>
            </div>
          </div>

          <form action="{{ route('listing.purchase',$id) }}" method="POST">
              @csrf
              <div class="form-group row">
                  <label for="bid" class="col-md-4 col-form-label text-md-right">Make a Bid: $</label>
                  <div class="col-md-6">
                      <input id="bid" type="input" class="form-control" name="bid">
                  </div>
              </div>
              <div class="form-group row mb-0 mt-5">
                  <div class="col-md-8 offset-md-4">
                      <button type="submit" class="btn btn-primary" name="submit" value="bid">Bid on Property</button>
                  </div>
              </div>
              @if($afford == true)
              <div class="form-group row mb-0 mt-5">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary" name="submit" value="purchase">Purchase Cash Price</button>
                </div>
              </div>
              @else
                <div class="form-group row mb-0 mt-5">
                  <div class="col-md-8 offset-md-4">
                      <p>Cannot Afford Cash Price, Add more to balance to purchase this property.</p>
                  </div>
                </div>
              @endif
          </form>
        @else
          @foreach($bids as $bid)
            <form action="{{ route('listing.purchase',$id) }}" method="POST">
              @csrf
              <div class="row">
                <p><b>Name: </b>{{$bid->bidder}}</p>
                <p><b>Bid: </b>{{$bid->bid}}</p>
                <button type="submit" class="btn btn-primary" name="submit" value="{{$bid->id}}">Accept Bid</button>
              </div>
            </form>
          @endforeach
        @endif


      @elseif($escrow==1)
        <h1>This property is in escrow.</h1>
      @else
        <h1>This property is not for sale</h1>
      @endif

      <p>{{$status ?? ''}}</p>
      <p>{{$id}}</p>
</div>
@endsection
