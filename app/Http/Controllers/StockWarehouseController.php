<?php

namespace App\Http\Controllers;

use App\Category;
use App\Stock;
use DataTables;
use App\Company;
use App\Warehouse;
use App\Jobs\ImportJob;
use Illuminate\Http\Request;

class StockWarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::select('id', 'name')->get();
        $warehouses = Warehouse::select('id', 'name')->get();
        $categories = Category::select('id', 'name')->get();
        return view('stock-warehouse', compact('companies', 'warehouses', 'categories'));
    }


    public function stockOpname()
    {
        return view('stock-opname');
    }


    public function getData(Request $request)
    {
        if (request()->ajax()) {
            if ($request) {
                $company_id =  $request->company_id;
                $warehouse_id =  $request->warehouse_id;
                $category_id =  $request->category_id;
                $q = new Stock();
                if ($warehouse_id == "" && $category_id == "") {
                    $q = $q->whereHas('drug', function ($s) use ($company_id) {
                        $s->where('company_id', $company_id);
                    });
                } else if ($warehouse_id != "" && $category_id == "") {
                    $q = $q
                        ->whereHas('drug', function ($s) use ($company_id) {
                            $s->where('company_id', $company_id);
                        })
                        ->whereHas('warehouse', function ($s) use ($warehouse_id) {
                            $s->where('id', $warehouse_id);
                        });
                } else {
                    $q = $q
                        ->whereHas('drug', function ($s) use ($company_id) {
                            $s->where('company_id', $company_id);
                        })
                        ->whereHas('drug', function ($s) use ($category_id) {
                            $s->where('category_id', $category_id);
                        })
                        ->whereHas('warehouse', function ($s) use ($warehouse_id) {
                            $s->where('id', $warehouse_id);
                        });
                }
                $data = $q
                    ->with(['warehouse', 'drug'])
                    ->get();
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('drug_code', function ($data) {
                        return $data->drug->code;
                    })
                    ->addColumn('drug_name', function ($data) {
                        return $data->drug->name;
                    })
                    ->addColumn('unit_name', function ($data) {
                        return $data->drug->unit->name;
                    })
                    ->addColumn('action', function ($data) {
                        return '<a href="' . route('stock.edit', $data->id) . '" class="modal-show edit" title="Stock: ' . $data->id . ' ">
                    <i class="fa fa-pencil"></i>
                </a>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        }
    }
}
