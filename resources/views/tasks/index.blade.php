@extends('layouts.app')

@section('content')
<div class="col-6 mx-md-auto">
	<div class="d-flex justify-content-end mb-2">
		<a class="btn btn-primary btn-sm" href="/tasks/create">New Task</a>
	</div>
	<div class="card">
		<div class="card-header">
			<h4>Tasks</h4>
		</div>
		<div class="card-body">
			<table class="table">
				<thead>
					<tr>
						<th>name</th>
						<th>frequency</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach($tasks as $task)
						<tr>
							<td>{{ $task->name }}</td>
							<td>{{ $task->frequency->name }}</td>
							<td class="text-right"><a href="/tasks/{{ $task->id }}/edit">edit</a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection