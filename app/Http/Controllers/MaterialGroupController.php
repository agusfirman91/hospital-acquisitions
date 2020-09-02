<?php

namespace App\Http\Controllers;

use App\Company;
use App\MaterialGroup;
use Illuminate\Http\Request;
use DataTables;

class MaterialGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('material');
    }

    public function getData()
    {
        $data = MaterialGroup::all();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('company_name', function ($data) {
                return $data->company->name;
            })
            ->addColumn('action', function ($data) {
                return '<a href="' . route('material.edit', $data->id) . '" class="modal-show edit" title="Material Group: ' . $data->id . ' ">
                <i class="fas fa-edit" data-feather="edit">
                </a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $material = new MaterialGroup();
        $company = Company::orderBy('name')->pluck('name', 'id');
        return view('forms.material', compact('material', 'company'));
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
        $material = new MaterialGroup();

        $data = [
            'company_id' => $request->company_id,
            'name' => $request->name,
        ];
        $material->create($data);
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
        $material = MaterialGroup::findOrFail($id);
        $company = Company::orderBy('name')->pluck('name', 'id');
        return view('forms.material', compact(['material', 'company']));
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
        $company  = MaterialGroup::findOrFail($id);
        $data = [
            'company_id' => $request->company_id,
            'name' => $request->name,
        ];

        $company->update($data);
        return response()->json(['msg' => 'update successfully']);
    }
}
