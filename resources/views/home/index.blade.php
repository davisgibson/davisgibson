@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between mb-2">
                <h4>My Home</h4>
                <div>
                    <div class="input-group">
                        <input readonly="readonly" class="form-control" type="text" id="inviteKey" value="{{ $home->key }}">
                        <div class="input-group-append">
                            <button id="copyBtn" class="btn btn-primary">Copy</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Slaves</h5>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tbody>
                                    @foreach($home->users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td class="text-right">{{ $user->completed_tasks->count() }} completed tasks</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5>Tasks</h5>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tbody>
                                    @foreach($home->tasks as $task)
                                        <tr>
                                            <td>{{ $task->name }}</td>
                                            <td class="text-right">
                                                @if($task->current_assignee)
                                                    <span class="badge badge-danger">{{ $task->current_assignee->name }}</span>
                                                @else
                                                    <span>No one assigned</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $('#copyBtn').click(function(e) {
        e.preventDefault();
        $('#inviteKey').focus();
        $('#inviteKey').select();
        document.execCommand("copy");
    });
</script>
@endsection 
