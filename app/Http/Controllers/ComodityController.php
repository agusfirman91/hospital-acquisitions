<?php

namespace App\Http\Controllers;

use App\Comodity;
use App\Company;
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
        // $data = Comodity::all();
        // return $data;
        return view('comodity');
    }


    public function getData()
    {
        $data = Comodity::all();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('company_name', function ($data) {
                return $data->company->name;
            })
            ->addColumn('action', function ($data) {
                return '<a href="' . route('comodity.edit', $data->id) . '" class="modal-show edit" title="Comodity: ' . $data->name . ' ">
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
        $comodity = new Comodity();
        $company = Company::orderBy('name')->pluck('name', 'id');
        return view('forms.comodity', compact(['comodity', 'company']));
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
        $comodity = new Comodity();

        $data = [
            'company_id' => $request->company_id,
            'name' => $request->name,
        ];
        $comodity->create($data);
        return response()->json(['msg' => 'Data created successfully']);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comodity  $comodity
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comodity = Comodity::findOrFail($id);
        $company = Company::orderBy('name')->pluck('name', 'id');
        return view('forms.comodity', compact(['comodity', 'company']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comodity  $comodity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,  [
            'company_id' => 'required|string',
            'name' => 'required|string',
        ]);
        $comodity  = Comodity::findOrFail($id);
        $data = [
            'company_id' => $request->company_id,
            'name' => $request->name,
        ];

        $comodity->update($data);
        return response()->json(['msg' => 'update successfully']);
    }
}
