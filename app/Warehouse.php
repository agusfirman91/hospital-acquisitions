<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    public $table = 'warehouse';
    protected $guarded = ['id'];


    public function stock()
    {
        return $this->hasMany(Stock::class);
    }

    public function company()
    {
        return $this->belongsToMany(Company::class);
    }
}
