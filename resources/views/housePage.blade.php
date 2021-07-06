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
    </div>
</div>
@endsection
