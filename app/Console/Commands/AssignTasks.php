<?php

namespace App\Console\Commands;

use App\User;
use App\Task;
use App\Home;
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
        $this->start();
    }

    public function fire()
    {
        $this->start();
    }

    public function start()
    {
        foreach(Home::whereHas('users')->get() as $home)
        {
            $this->assignTasks($home->tasks);
        }
    }

    public function assignTasks($tasks)
    {
        foreach($tasks as $task)
        {
            if(!$task->has_current_assignee)
            {
                $this->assignTask($task);
            }
        }
    }

    public function assignTask($task)
    {
        if($task->has_everyone_done_this)
            $user = $task->next_user_in_rotation;
        else
            $user = $this->getBestUser($task->home);
        $user->tasks()->attach([ $task->id => [
            'complete_at' => Carbon::parse($task->last_complete)->addDays($task->frequency->days),
        ]]);
    }

    public function getBestUser($home)
    {
        return $home->users->sortBy(function ($user) {
            return $user->upcoming_tasks->count() + 1;
        })->first();
    }

}
