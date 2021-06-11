<?php

namespace App;

use App\Task;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'is_admin', 'home_id', 'agent', 'profilepic',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tasks()
    {
        return $this->belongsToMany(Task::class)->withPivot('complete_at');
    }

    public function home()
    {
        return $this->belongsTo(Home::class);
    }

    public function getImageAttribute(){
        return $this->profilepic;
    }

    public function getTodaysTasksAttribute()
    {
        return $this->tasks()->whereDate('complete_at', Carbon::today())->orderBy('complete_at', 'desc')->get();
    }

    public function getUpcomingTasksAttribute()
    {
        return $this->tasks()->whereDate('complete_at', '>', Carbon::today())->orderBy('complete_at', 'desc')->get();
    }

    public function getCompletedTasksAttribute()
    {
        return $this->tasks()->where('is_complete', 1)->orderBy('complete_at', 'desc')->get();
    }
}
