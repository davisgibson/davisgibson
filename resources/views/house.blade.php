@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <form method="POST" action="{{ route('regHouse') }}">
          @csrf

          <div class="form-group row">
              <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

              <div class="col-md-6">
                  <input id="address" type="address" class="form-control" name="address" required autocomplete="address" autofocus>
              </div>
          </div>

          <div class="form-group row">
              <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

              <div class="col-md-6">
                  <textarea id="description" type="description" class="form-control" name="description" required autocomplete="description" autofocus></textarea>
              </div>
          </div>

          <div class="form-group row">
              <label for="footage" class="col-md-4 col-form-label text-md-right">{{ __('Sq. Ft.') }}</label>

              <div class="col-md-6">
                  <input id="footage" type="footage" class="form-control" name="footage" autocomplete="ft" autofocus>
              </div>
          </div>

          <div class="form-group row">
              <label for="beds" class="col-md-4 col-form-label text-md-right">{{ __('Beds') }}</label>

              <div class="col-md-6">
                  <input id="beds" type="beds" class="form-control" name="beds" autocomplete="beds" autofocus>
              </div>
          </div>

          <div class="form-group row">
              <label for="baths" class="col-md-4 col-form-label text-md-right">{{ __('Baths') }}</label>

              <div class="col-md-6">
                  <input id="baths" type="baths" class="form-control" name="baths" autocomplete="baths" autofocus>
              </div>
          </div>

          <div class="form-group row">
              <label for="list" class="col-md-4 col-form-label text-md-right">{{ __('List Price $') }}</label>

              <div class="col-md-6">
                  <input id="list" type="list" class="form-control" name="list" autocomplete="list" autofocus>
              </div>
          </div>

          <div class="form-group row">
              <label for="cash" class="col-md-4 col-form-label text-md-right">{{ __('Cash Price $') }}</label>

              <div class="col-md-6">
                  <input id="cash" type="cash" class="form-control" name="cash" autocomplete="cash" autofocus>
              </div>
          </div>

          <div class="form-group row">
              <label for="selling" class="col-md-4 col-form-label text-md-right">{{ __('For Sale?') }}</label>

              <div class="col-md-6">
                  <input type="hidden" name="selling" value="0">
                  <input id="selling" name="selling" type="checkbox" class="form-control" name="selling">
              </div>
          </div>

          <div class="form-group row mb-0">
            <p>Residential or Comercial?</p>
              <div class="col-md-8 offset-md-4">

                <input type="radio" id="residential" name="prop" value="residential">
                <label for="residential">Residential</label><br>
                <input type="radio" id="comercial" name="prop" value="comercial">
                <label for="comercial">Comercial</label><br>
              </div>
          </div>

          <div class="form-group row mb-0">
              <div class="col-md-8 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                      {{ __('Create') }}
                  </button>
              </div>
          </div>

      </form>


    </div>
</div>
@endsection
