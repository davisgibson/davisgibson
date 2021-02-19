<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use App\Frequency;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
    	return $this->middleware('auth');
    }

    public function index()
    {
    	return view('tasks.index')->with([
    		'tasks' => Task::all(),
    	]);
    }

    public function create()
    {
    	return view('tasks.create')->with([
    		'frequencies' => Frequency::all(),
    	]);
    }

    public function store(Request $request)
    {
    	$request->validate([
    		'name' => 'required|max:255',
        	'frequency' => 'required',
    	]);

    	Task::create([
    		'name' => $request->name,
    		'frequency_id' => $request->frequency,
    	]);

    	return redirect('/tasks');
    }

    public function complete($taskId, Request $request)
    {
        $request->user()->tasks()->updateExistingPivot($taskId, ['is_complete' => 1]);

        return redirect('/home');
    }

    public function edit($taskId)
    {
        return view('tasks.edit')->with([
            'task' => Task::find($taskId),
            'frequencies' => Frequency::all(),
        ]);
    }

    public function update($taskId, Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'frequency' => 'required',
        ]);

        Task::where('id', $taskId)->update([
            'name' => $request->name,
            'frequency_id' => $request->frequency,
        ]);

        return redirect('/tasks');
    }

    public function delete($taskId)
    {
        Task::find($taskId)->delete();

        return redirect('/tasks');
    }
}
