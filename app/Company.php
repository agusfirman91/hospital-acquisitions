<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Company extends Model
{
    protected $guarded = ['id'];

    public function getWarehouse()
    {
        return $this->belongsToMany(Warehouse::class)->wherePivotNotNull('company_id');
    }
    /**
     * get data company yang  masuk ke pivot table company_warehouse
     */
    public function getCompany()
    {
        return $this->DB::table('companies as c')
            ->leftJoin('company_warehouse as cw', 'cw.company_id', '=', 'c.id')
            ->get();
    }
}
