@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-4">
        <img class="rounded-circle" id="image" src="{{ $pic ?? '' }}"/>
      </div>
      <div class="col-8">
        <h1 class="banner-text">{{ $name }}</h1>
      </div>
    </div>

    <br>
    <h1>Properties: </h1>
    <a href="/house">Add Property</a>

    <table class="table table-borderless">
      <thead>
        <tr>
          <th>Address</th>
          <th>Description</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($homes as $home)
          <tr>
            <td><a href="/houses/{{ $home->id }}">{{ $home->address }}<a></td>
            <td>{{ $home->description }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>



    <table class="table table-borderless">
      <thead>
        <tr>
          <th>Address</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($events as $event)
          <tr>
            <td>{{ $event['address'] }}</td>
            <td>{{ $event['status'] }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
</div>
@endsection
