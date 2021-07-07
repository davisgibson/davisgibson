@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="container">
          <div class="row justify-content-center">
            <form action="{{ route('settings.update') }}" method="POST" role="form" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-md-6 col-form-label text-md">Name</label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name', auth()->user()->name) }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-md-6 col-form-label text-md">Email</label>
                    <div class="col-md-6">
                        <input id="email" type="text" class="form-control" name="email" value="{{ old('email', auth()->user()->email) }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="balance" class="col-md-6 col-form-label text-md">Balance</label>
                    <div class="col-md-6">
                        <input id="balance" type="text" class="form-control" name="balance" value="{{ old('balance', auth()->user()->balance) }}">
                    </div>
                </div>
                @if ($agent)
                <div class="form-group row">
                    <label for="commision" class="col-md-6 col-form-label text-md">Commision</label>
                    <div class="col-md-6">
                        <input id="commision" type="text" class="form-control" name="commision" value="{{ old('commision', auth()->user()->commision) }}">
                    </div>
                </div>
              @endif
                <div class="form-group row mb-0 mt-5">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </div>
                </div>
            </form>
          </div>
        </div>
    </div>
</div>
@endsection
