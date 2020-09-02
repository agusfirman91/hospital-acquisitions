<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CompanyWarehouse extends Model
{
    protected $table = "company_warehouse";

    protected $guarded = ['id'];


    public function getCompany($id)
    {
        // return $this->belongsTo(Company::class, 'company_id', 'id');
        return DB::table('company')->select('id', 'name')->whereIn('id', $id)->get();
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
