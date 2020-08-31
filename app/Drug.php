<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    protected $guarded = ['id'];

    public function stock()
    {
        return $this->hasMany(Stock::class, 'code');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_type_id');
    }

    public function category()
    {
        return $this->belongsTo(Unit::class, 'category_id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function comodity()
    {
        return $this->belongsTo(Group::class, 'comodity_id');
    }

    public function material()
    {
        return $this->belongsTo(Group::class, 'material_id');
    }
}
