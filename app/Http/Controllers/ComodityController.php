<?php

namespace App\Http\Controllers;

use App\Comodity;
use Illuminate\Http\Request;
use DataTables;

class ComodityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('comodity');
    }


    public function getData()
    {
        $data = Comodity::all();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return '<a href="' . route('stock.edit', $data->id) . '" class="modal-show edit" title="Stock: ' . $data->id . ' ">
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
     * @param  \App\Comodity  $comodity
     * @return \Illuminate\Http\Response
     */
    public function show(Comodity $comodity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comodity  $comodity
     * @return \Illuminate\Http\Response
     */
    public function edit(Comodity $comodity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comodity  $comodity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comodity $comodity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comodity  $comodity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comodity $comodity)
    {
        //
    }
}
