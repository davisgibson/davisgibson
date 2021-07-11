@extends('layouts.app')

@section('content')
<div class="container">
      @foreach($files as $file)
        <img class="img-thumbnail" id="image" src="{{ $file ?? '' }}"/>
      @endforeach


      <div class="row m-2">
        @if ($owned == true)
          <a href="/houses/{{$id}}/upload" class="btn btn-primary">Edit House Listing</a>
        @endif
        @if ($sale==true)
          <a href="/listing/{{$id}}/buy" class="btn btn-primary">Check Property Listing</a>
        @endif
      </div>

      <div class="row">
        @if ($null == false)
          <div style="width: 500px; height: 500px;" class="m-2">
            {!! Mapper::render() !!}
          </div>
        @else
          <p> Home not found. </p>
        @endif
      </div>

      @if (!empty($report))
      <div class ="row">
        <a href="{{route('download', $report)}}" class="btn btn-primary">Download Report</a>
      </div>
      @endif
</div>
@endsection
