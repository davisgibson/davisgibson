@extends('layouts.app')

@section('content')
<div class="col-6 mx-md-auto">
	@if ($errors->any())
	    <div class="alert alert-danger">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	@endif
	<div class="card">
		<div class="card-header">
			<h4>Create Task</h4>
		</div>
		<div class="card-body">
			<form method="post" action="/tasks/create" class="col-8">
				@csrf
				<div class="form-group">
					<label for="name">Task</label>
					<input required type="text" class="form-control" name="name" id="name">
				</div>

				<div class="form-group">
					<label for="frequency">How often does this need to be done?</label>
					<select required class="custom-select" name="frequency" id="frequency">
						@foreach($frequencies as $frequency)
							<option value="{{ $frequency->id }}">{{ $frequency->name }}</option>
						@endforeach
					</select>
				</div>

				<button class="btn btn-primary mt-2" type="submit">Save</button>
			</form>
		</div>
	</div>
</div>
@endsection