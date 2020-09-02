<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $guarded = ['id'];


    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
