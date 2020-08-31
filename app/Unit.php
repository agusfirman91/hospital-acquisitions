<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    public $table = 'unit_types';
    protected $guarded = ['id'];
}
