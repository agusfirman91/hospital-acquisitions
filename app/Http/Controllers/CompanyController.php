<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use DataTables;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('company');
    }

    public function getData()
    {
        $data = Company::all();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                return '<a href="' . route('company.edit', $data->id) . '" class="modal-show edit" title="Company: ' . $data->name . ' ">
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

        $company = new Company();
        return view('forms.company', compact(['company']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request,  [
            'name' => 'required|string'
        ]);
        $company = new Company();

        $data = [
            'name' => $request->title,
            'description' => $request->description
        ];
        $company->create($data);
        return response()->json(['data' => $data, 'msg' => 'Data created successfully']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $company = Company::findOrFail($id);
        return view('forms.company', compact(['company']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,  [
            'name' => 'required|string',
        ]);
        $company  = Company::findOrFail($id);
        $data = [
            'name' => $request->name,
            'description' => $request->description
        ];

        $company->update($data);
        return response()->json(['msg' => 'update successfully']);
    }
}
