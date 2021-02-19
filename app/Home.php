<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    protected $guarded = ['id'];

    protected $fillable = ['key'];

   	public function users()
   	{
   		return $this->hasMany(User::class);
   	}

   	public function scopeFindKey($query, $key)
   	{
   		return $query->where('key', $key)->first();
   	}

    public function tasks()
    {
      return $this->hasMany(Task::class);
    }
}
