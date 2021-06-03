@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div style="width: 500px; height: 500px;">
            	{!! Mapper::render() !!}
            </div>
        </div>
    </div>
</div>
@endsection
