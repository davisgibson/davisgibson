@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      @if ($null == false)
        <div style="width: 500px; height: 500px;">
          {!! Mapper::render() !!}
        </div>
      @else
        <p> Home not found. </p>
      @endif
      @if ($owned == true)
        <a href="/houses/{{$id}}/upload">Edit House Listing</a>
      @endif
      @if ($sale==true)
        <a href="/listing/{{$id}}/buy">Check Property Listing</a>
      @endif
    </div>
</div>
@endsection
