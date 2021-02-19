@extends('layouts.app')

@push('styles')
<style>
.bigBtn {
  box-sizing: border-box;
  -webkit-appearance: none;
     -moz-appearance: none;
          appearance: none;
  background-color: transparent;
  border: 2px solid #e74c3c;
  border-radius: 0.6em;
  cursor: pointer;
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-align-self: center;
      -ms-flex-item-align: center;
          align-self: center;
  font-size: 1rem;
  font-weight: 400;
  line-height: 1;
  margin: 20px;
  padding: 1.2em 2.8em;
  text-decoration: none;
  text-align: center;
  text-transform: uppercase;
  font-family: 'Montserrat', sans-serif;
  font-weight: 700;
}
a,
a:link,
a:visited,
a:hover,
a:active{
    text-decoration: none!important;
}
.bigBtn:hover, .bigBtn:focus {
  color: #fff!important;
  outline: 0;
}
.bigBtn {
  text-align: center!important;
  vertical-align: middle!important;
  height: 100px;
  border-radius: 0;
  position: relative;
  overflow: hidden;
  z-index: 1;
  -webkit-transition: color 150ms ease-in-out;
  transition: color 150ms ease-in-out;
  background-color: #fff;
}
.bigBtn:after {
  content: '';
  position: absolute;
  display: block;
  top: 0;
  left: 50%;
  -webkit-transform: translateX(-50%);
          transform: translateX(-50%);
  width: 0;
  height: 100%;
  z-index: -1;
  -webkit-transition: width 150ms ease-in-out;
  transition: width 150ms ease-in-out;
}
.bigBtn:hover {
  color: #fff;
}
.bigBtn:hover:after {
  width: 110%;
}
#btn1{
    padding-top: 2em;
    color: #e27d60;
    border-color: #e27d60;
}
#btn1:after{
    background: #e27d60;
}
#btn2{
    padding-top: 2.3em; padding-left: 4.4em;
    color: #f38287;
    border-color: #f38287;
}
#btn2:after{
    background: #f38287;
}
.card{
    box-shadow: 5px 5px 10px 1px #e2e2e2;
}
</style>
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
        	<div class="card my-auto">
        		<div class="card-body">
                    <div class="d-flex">
                        <a id="btn1" href="/onboarding/code" class="bigBtn w-50 mr-0">I have an invite code</a>
                        <form action="/onboarding/create" method="post" class="w-50">
                            @csrf
                            <button id="btn2" type="submit" class="bigBtn w-100 ml-0">New Home</button>
                        </form>
                    </div>
                    <small class="text-muted text-center ml-3">Invite codes can be found on your home's page.</small>
        		</div>
        	</div>
        </div>
    </div>
</div>
@endsection