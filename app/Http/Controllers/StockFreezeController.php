<?php

namespace App\Http\Controllers;

use App\Company;
use App\Warehouse;
use Illuminate\Http\Request;

class StockFreezeController extends Controller
{
    public function index()
    {
        $companies  = Company::all();
        $warehouses  = Warehouse::all();
        return view('stock-freeze', compact('companies', 'warehouses'));
    }

    public function getData(Request $request)
    {
        $company = Company::find($request->company_id);
        $listId = [];
        $listId = $company->getWarehouse;
        return response()->json($listId, 200);
    }

    public function update(Request $request)
    {
        $company  = Company::findOrFail($request->id);
        $company->getWarehouse()->sync($request->warehouse_list_id);

        return response()->json(['data' => $request->warehouse_list_id, 'msg' => 'update successfully']);
    }
}
