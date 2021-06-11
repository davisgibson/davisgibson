@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        {{-- <div class="col-md-8">
            <h4 class="mb-3"><b>{{ __('Dashboard') }}</b></h4>
            <div class="card mb-3">
                <span class="card-header text-center" style="font-size: 1.2em;">Today's Tasks</span>

                <div class="card-body p-0">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table mb-0">
                        <tbody>
                            @foreach(request()->user()->todays_tasks as $task)
                                <tr>
                                    <td>{{ $task->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($task->pivot->complete_at)->endOfDay()->diffForHumans() }}</td>
                                    <td class="text-right">
                                        <form action="/tasks/{{ $task->id }}/complete">
                                            @csrf
                                            <input type="image" alt="Submit" style="max-height: 25px;" src="/images/check.svg" onclick="return confirm('Are you sure you want to mark this task as complete?');">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <span class="card-header text-center" style="font-size: 1.2em;">Upcoming Tasks</span>

                <div class="card-body p-0">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table mb-0">
                        <tbody>
                            @foreach(request()->user()->upcoming_tasks as $task)
                                <tr>
                                    <td>{{ $task->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($task->pivot->complete_at)->endOfDay()->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> --}}

        <img class="images" id="image" src="{{ asset($user->profilepic) }}"/>


    </div>
</div>
@endsection
