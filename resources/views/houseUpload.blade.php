@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Update House</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    @if ($errors->any())
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>
                                                        {{ $error }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form action="{{ route('house.update', $id) }}" method="POST" role="form" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>
                                            <div class="col-md-6">
                                                <input id="address" type="text" class="form-control" name="address" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="footage" class="col-md-4 col-form-label text-md-right">Footage</label>
                                            <div class="col-md-6">
                                                <input id="footage" type="text" class="form-control" name="footage" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="bed" class="col-md-4 col-form-label text-md-right">Beds</label>
                                            <div class="col-md-6">
                                                <input id="bed" type="text" class="form-control" name="bed" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="bath" class="col-md-4 col-form-label text-md-right">Baths</label>
                                            <div class="col-md-6">
                                                <input id="bath" type="text" class="form-control" name="bath" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>
                                            <div class="col-md-6">
                                                <input id="description" type="text" class="form-control" name="description" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="listPrice" class="col-md-4 col-form-label text-md-right">List Price $</label>
                                            <div class="col-md-6">
                                                <input id="listPrice" type="text" class="form-control" name="listPrice" value="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="cashPrice" class="col-md-4 col-form-label text-md-right">Cash Price $</label>
                                            <div class="col-md-6">
                                                <input id="cashPrice" type="text" class="form-control" name="cashPrice" value="">
                                                <p>If left blank, there will be not cash price.</p>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="selling" class="col-md-4 col-form-label text-md-right">For Sale?</label>

                                            <div class="col-md-6">
                                                <input type="hidden" name="selling" value="1">
                                                <input id="selling" name="selling" type="checkbox" class="form-control" name="selling">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-0">
                                          <p>Residential or Comercial?</p>
                                            <div class="col-md-8 offset-md-4">

                                              <input type="radio" id="residential" name="prop" value="residential" checked="checked">
                                              <label for="residential">Residential</label><br>
                                              <input type="radio" id="comercial" name="prop" value="comercial">
                                              <label for="comercial">Comercial</label><br>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="profile_image" class="col-md-4 col-form-label text-md-right">Images</label>
                                            <div class="col-md-6">
                                                <input id="profile_image" type="file" class="form-control" name="profile_image">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="report_file" class="col-md-4 col-form-label text-md-right">Report</label>
                                            <div class="col-md-6">
                                                <input id="report_file" type="file" class="form-control" name="report_file">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-0 mt-5">
                                            <div class="col-md-8 offset-md-4">
                                                <button type="submit" class="btn btn-primary" name="submit" value="update">Update House</button>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-0 mt-5">
                                          <div class="col-md-8 offset-md-4">
                                              <button type="submit" class="btn btn-primary" name="submit" value="delete">Delete House</button>
                                          </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
