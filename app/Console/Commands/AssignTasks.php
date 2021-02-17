<?php

namespace App\Console\Commands;

use App\User;
use App\Task;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AssignTasks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:assign';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assigns existing tasks to existing users.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->assignTasks();
    }

    public function fire()
    {
        $this->assignTasks();
    }

    public function assignTasks()
    {
        foreach(Task::all() as $task)
        {
            if(!$task->has_current_assignee)
            {
                $this->assignTask($task);
            }
        }
    }

    public function assignTask($task)
    {
        $user = $task->next_user;
        if( ! $user)
            $user = $this->getBestUser();
        $user->tasks()->attach([ $task->id => [
            'complete_at' => Carbon::parse($task->last_complete)->addDays($task->frequency->days),
        ]]);
    }

    public function getBestUser()
    {
        return User::all()->sortBy(function ($user) {
            return $user->todays_tasks->count();
        })->first();
    }

}
