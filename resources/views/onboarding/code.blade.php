@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-6">
        	<div class="card" style="box-shadow: 5px 5px 10px 1px #e2e2e2;">
        		<div class="card-header text-center">
        			<h5>Do you already have an invite code?</h5>
        		</div>
        		<div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
        			<form method="post" action="/onboarding">
        				@csrf
        				@method('put')
        				<div class="form-group">
        					<label for="key">If so, paste it here.</label>
        					<input type="text" class="form-control" name="key" id="key">
        				</div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
        			</form>
        		</div>
        	</div>
        </div>
    </div>
</div>
@endsection