<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    protected $guarded = ['id'];

    protected $fillable = ['owner','type','footage','address','address','infoFolder','listPrice','cashPrice','ForSale','bed','bath','bidId'];
}
