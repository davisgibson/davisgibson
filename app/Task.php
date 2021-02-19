<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = ['id'];

    public function frequency()
    {
    	return $this->belongsTo(Frequency::class);
    }

    public function home()
    {
        return $this->belongsTo(Home::class);
    }

    public function assigneesLog()
    {
    	return $this->belongsToMany(User::class)->withPivot(['is_complete', 'complete_at'])->withTimestamps();
    }

    public function getLastAssigneeAttribute()
    {
    	return $this->assigneesLog()->orderBy('complete_at', 'desc')->first();
    }

    public function getHasCurrentAssigneeAttribute()
    {
    	if($this->last_assignee)
    		return !$this->last_complete->addHours(24)->isPast();
		else
			return false;
    }

    public function getNextUserInRotationAttribute()
    {
    	if($this->last_assignee)
    		return $this->assigneesLog()->orderBy('complete_at', 'desc')->distinct('user_id')->first();
    	else
    		return false;
    }

    public function getLastCompleteAttribute()
    {
    	if($this->last_assignee)
    		return Carbon::parse($this->last_assignee->pivot->complete_at);
    	else
    		return false;
    }

    public function getCurrentAssigneeAttribute()
    {
        return $this->assigneesLog()->where('complete_at', '>', Carbon::yesterday())->orderBy('complete_at', 'asc')->first();
    }

    public function getHasEveryoneDoneThisAttribute()
    {
        return $this->assigneesLog()->distinct('user_id')->pluck('user_id')->diffKeys($this->home->users()->pluck('id'))->count();
    }
}
