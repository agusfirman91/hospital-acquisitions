<?php

namespace App\Http\Controllers;

use App\Category;
use App\CompanyWarehouse;
use App\Stock;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockOpnameController extends Controller
{
    function index()
    {
        $companies = new CompanyWarehouse();
        $companies = $companies->select('company_id')->groupBy('company_id')->get();
        foreach ($companies as $cp) {
            $company_id[] = $cp->company_id;
        }
        $companies = $this->getCompany($company_id);
        $warehouses = $this->getWarehouse($company_id);
        // return $warehouses;
        $categories = Category::select('id', 'name')->get();
        return view('stock-opname', compact('companies', 'warehouses', 'categories'));
    }

    public function getCompany($id)
    {
        return DB::table('companies')->select('id', 'name')->whereIn('id', $id)->get();
    }


    public function getWarehouse($id)
    {
        return DB::table('company_warehouse as cw')
            ->leftJoin('warehouse as w', 'w.id', '=', 'cw.warehouse_id')
            ->whereIn('cw.company_id', $id)
            ->get();
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
                    // ->limit(1000)
                    ->get();
                // return $data;
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->setRowAttr([
                        'class' => function ($data) {
                            return $data->updatedby ? 'bg-primary text-white'  : '';
                        }
                    ])
                    ->editColumn('id', function ($data) {
                        return "<input type='text' value='$data->id' class='form-control form-control-sm' name='id[]' readonly style='background-color: transparent;border: 0px solid';outline: none />";
                        // return "<span name='id[]'>$data->id </span>";
                    })
                    ->editColumn('qty', function ($data) {
                        return "<input type='number' value='$data->qty' class='form-control form-control-sm'  name='qty[]' />";
                    })
                    ->editColumn('description', function ($data) {
                        return "<input type='text' value='$data->description' class='form-control form-control-sm' name='description[]' />";
                    })
                    ->addColumn('drug_name', function ($data) {
                        return $data->drug->name;
                    })
                    ->addColumn('warehouse_name', function ($data) {
                        return $data->warehouse->name;
                    })
                    ->addColumn('unit_name', function ($data) {
                        return $data->drug->unit->name;
                    })
                    ->rawColumns(['id', 'qty', 'description', 'user_id'])
                    ->make(true);
            }
        }
    }


    public function update(Request $request)
    {
        $id = $request->id;
        $qty = $request->qty;
        $desc = $request->description;
        $userID = Auth::user()->id;
        for ($i = 0; $i < count($id); $i++) {
            $data = [
                'qty' => $qty[$i],
                'description' => $desc[$i],
                'updatedby' => $userID
            ];
            Stock::find($id[$i])->update($data);
        }

        return response()->json(['msg' => 'Data has been updated'], 200);
    }


    public function report()
    {
        $companies = new CompanyWarehouse();
        $companies = $companies->select('company_id',)->groupBy('company_id')->get();
        foreach ($companies as $cp) {
            $company_id[] = $cp->company_id;
        }
        $companies = $this->getCompany($company_id);
        $warehouses = $this->getWarehouse($company_id);
        $categories = Category::all();
        return view('report', compact('companies', 'warehouses', 'categories'));
    }


    public function getDataReport(Request $request)
    {
        if (request()->ajax()) {
            if ($request) {
                $company_id =  1;
                $warehouse_id =  1;
                $category_id =  1;
                $company_id =  $request->company_id;
                $warehouse_id = $request->warehouse_id;
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
            }
            $data = $q
                ->with(['warehouse', 'drug'])
                ->whereNotNull('updatedby')
                ->get();
            // return $data;
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('drug_name', function ($data) {
                    return $data->drug->name;
                })
                ->addColumn('warehouse_name', function ($data) {
                    return $data->warehouse->name;
                })
                ->addColumn('unit_name', function ($data) {
                    return $data->drug->unit->name;
                })
                ->make(true);
        }
    }
}
