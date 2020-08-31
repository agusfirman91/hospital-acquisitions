<?php

namespace App\Http\Controllers;

use App\Company;
use App\Drug;
use App\Warehouse;
use Illuminate\Http\Request;
use DataTables;

class DrugController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::select('id', 'name')->get();
        return view('drug', compact('companies'));
    }

    public function getData(Request $request)
    {
        if (request()->ajax()) {
            if ($request) {
                $company_id =  $request->company_id;
                $data = Drug::with(['unit', 'company', 'category', 'group', 'comodity', 'material'])->where('company_id', $company_id)->get();
            } else {
                $data = Drug::with(['unit', 'company', 'category', 'group', 'comodity', 'material'])->get();
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('company_name', function ($data) {
                    if ($data->company_id === null) {
                        return '-';
                    } else {
                        return $data->company->name;
                    }
                })
                ->addColumn('unit_name', function ($data) {
                    if ($data->unit_type_id === null) {
                        return '-';
                    } else {
                        return $data->unit->name;
                    }
                })
                ->addColumn('category_name', function ($data) {
                    if ($data->category_id === null) {
                        return '-';
                    } else {
                        return $data->category->name;
                    }
                })
                ->addColumn('group_name', function ($data) {
                    if ($data->group_id === null) {
                        return '-';
                    } else {
                        return $data->group->name;
                    }
                })
                ->addColumn('comodity_name', function ($data) {
                    if ($data->comodity_id === null) {
                        return '-';
                    } else {
                        return $data->comodity->name;
                    }
                })
                ->addColumn('material_name', function ($data) {
                    if ($data->material_id === null) {
                        return '-';
                    } else {
                        return $data->material->name;
                    }
                })
                // ->addColumn('warehouse_name', function ($data) {
                //     return $data->warehouse->name;
                // })
                ->make(true);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
