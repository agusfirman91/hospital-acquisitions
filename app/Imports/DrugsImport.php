<?php

namespace App\Imports;

use App\Drug;
use App\Stock;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DrugsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // return [
        //     new Drug([
        //         'code' => $row['code'],
        //         'unit_type_id' => $row['unit_type_id'],
        //         'company_id' => $row['company_id'],
        //         'comodity_id' => $row['comodity_id'],
        //         'category_id' => $row['category_id'],
        //         'material_id' => $row['material_id'],
        //         'group_id' => $row['group_id'],
        //         'name' => $row['name'],
        //         'price' => $row['price'],
        //         'description' => $row['description'],
        //         'created_at' => $row['created_at'],
        //         'updated_at' => $row['updated_at'],
        //         'createdby' => Auth::user()->id
        //     ]),
        //     new Stock([
        //         'warehouse_id' => $row['warehouse_id'],
        //         'drug_code' => $row['code'],
        //         'qty' => 0,
        //         'description' => $row['description'],
        //         'created_at' => $row['created_at'],
        //         'updated_at' => $row['updated_at'],
        //         'createdby' => Auth::user()->id
        //     ])
        // ];

        return $row;
    }
}
