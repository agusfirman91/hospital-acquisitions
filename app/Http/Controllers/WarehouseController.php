<?php

namespace App\Http\Controllers;

use App\Company;
use App\CompanyWarehouse;
use App\Stock;
use App\Warehouse;
use Illuminate\Http\Request;
use DataTables;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = company::all();
        // return $data;
        return view('warehouse', compact('company'));
    }

    public function getData()
    {
        // if (request()->ajax()) {
        $data = Warehouse::all();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('company_name', function ($data) {
                return $data->company->name;
            })
            ->addColumn('action', function ($data) {
                return '<a href="' . route('warehouse.edit', $data->id) . '" class="modal-show edit" title="Warehouse: ' . $data->id . ' ">
                    <i class="fas fa-edit" data-feather="edit">
                </a>';
            })
            ->rawColumns(['action'])
            ->make(true);
        // }
    }

    public function create()
    {
        $warehouse = new Warehouse();
        $company = Company::orderBy('name')->pluck('name', 'id');
        return view('forms.warehouse', compact('warehouse', 'company'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,  [
            'company_id' => 'required|string',
            'name' => 'required|string'
        ]);
        $warehouse = new Warehouse();

        $data = [
            'company_id' => $request->company_id,
            'name' => $request->name,
        ];
        $warehouse->create($data);
        return response()->json(['msg' => 'Data created successfully']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MaterialGroup  $materialGroup
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $warehouse = Warehouse::findOrFail($id);
        $company = Company::orderBy('name')->pluck('name', 'id');
        return view('forms.warehouse', compact(['warehouse', 'company']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MaterialGroup  $materialGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,  [
            'company_id' => 'required|string',
            'name' => 'required|string',
        ]);
        $warehouse  = Warehouse::findOrFail($id);
        $data = [
            'company_id' => $request->company_id,
            'name' => $request->name,
        ];

        $warehouse->update($data);
        return response()->json(['msg' => 'update successfully']);
    }

    public function getWarehouse($company_id)
    {
        $data = CompanyWarehouse::with(['warehouse:id,name'])
            ->whereHas('warehouse', function ($q) use ($company_id) {
                $q->where('company_id', $company_id);
            })
            ->limit(100)->get()->pluck('warehouse.name', 'warehouse.id');
        return response()->json($data, 200);
    }

    public function getCategory($company_id, $warehouse_id)
    {
        $data = Stock::with(['drug.category:id,name', 'warehouse'])
            ->whereHas('warehouse', function ($q) use ($warehouse_id) {
                $q->where('warehouse_id', $warehouse_id);
            })
            ->whereHas('drug', function ($q) use ($company_id) {
                $q->where('company_id', $company_id);
            })
            ->get()
            ->pluck('drug.category.name', 'drug.category.id');
        return response()->json($data, 200);
    }
}
