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
			<h4>Edit Task</h4>
		</div>
		<div class="card-body">
			<form method="post" action="/tasks/{{ $task->id }}" class="col-8">
				@csrf
				@method('put')
				<div class="form-group">
					<label for="name">Task</label>
					<input value="{{ $task->name }}" required type="text" class="form-control" name="name" id="name">
				</div>

				<div class="form-group">
					<label for="frequency">How often does this need to be done?</label>
					<select required class="custom-select" name="frequency" id="frequency">
						@foreach($frequencies as $frequency)
							<option value="{{ $frequency->id }}" {{ $task->frequency->id == $frequency->id ? 'selected' : '' }}>{{ $frequency->name }}</option>
						@endforeach
					</select>
				</div>

				<button class="btn btn-primary mt-2" type="submit">Save</button>
			</form>
		</div>
	</div>
	<div class="d-flex justify-content-end mt-2">
		<form method="post" action="/tasks/{{ $task->id }}">
			@csrf
			@method('delete')
			<button onclick="return confirm('Are you sure you want to delete the task {{ $task->name }}?');" type="submit" class="btn btn-sm btn-danger">Delete Task</button>
		</form>
	</div>
</div>
@endsection