<?php

namespace App\Http\Controllers;

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
            ->addColumn('action', function ($data) {
                return '<a href="' . route('material.edit', $data->id) . '" class="modal-show edit" title="Stock: ' . $data->id . ' ">
                    <i class="fa fa-pencil"></i>
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
     * @param  \App\MaterialGroup  $materialGroup
     * @return \Illuminate\Http\Response
     */
    public function show(MaterialGroup $materialGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MaterialGroup  $materialGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(MaterialGroup $materialGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MaterialGroup  $materialGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MaterialGroup $materialGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MaterialGroup  $materialGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(MaterialGroup $materialGroup)
    {
        //
    }
}
