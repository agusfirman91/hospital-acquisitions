<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Warehouse;
use App\Drug;

class Stock extends Model
{
    public $table = 'stock';


    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }

    public function warehouse_drug()
    {
        return $this->belongsToMany('App\Warehouse', 'App\Drug', 'drug_code', 'warehouse_id', 'code', 'id');
    }
    // public function warehouse_drug()
    // {
    //     return $this->belongsToMany(Warehouse::class, Drug::class, 'drug_code', 'warehouse_id', 'code', 'id');
    // }

    public function drug()
    {
        return $this->belongsTo(Drug::class, 'drug_code', 'code');
    }

    protected $guarded = ['id'];

    public function createdbys()
    {
        return $this->belongsTo(User::class, 'createdby', 'id');
    }

    public function updatedbys()
    {
        return $this->belongsTo(User::class, 'updatedby', 'id');
    }
}
