<?php

namespace App\Http\Controllers;

use App\Company;
use App\Group;
use Illuminate\Http\Request;
use DataTables;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('group');
    }

    public function getData()
    {
        $data = Group::with('company')->get();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('company_name', function ($data) {
                return $data->company->name;
            })
            ->addColumn('action', function ($data) {
                return '<a href="' . route('group.edit', $data->id) . '" class="modal-show edit" title="Golongan: ' . $data->id . ' ">
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
        $group = new Group();
        $company = Company::orderBy('name')->pluck('name', 'id');
        return view('forms.group', compact(['group', 'company']));
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
            'code' => 'required|string',
            'company_id' => 'required|string',
            'name' => 'required|string'
        ]);
        $group = new Group();

        $data = [
            'code' => $request->code,
            'company_id' => $request->company_id,
            'name' => $request->name,
        ];
        $group->create($data);
        return response()->json(['msg' => 'Data created successfully']);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = Group::findOrFail($id);
        $company = Company::orderBy('name')->pluck('name', 'id');
        return view('forms.group', compact(['group', 'company']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,  [
            'code' => 'required|string',
            'company_id' => 'required|string',
            'name' => 'required|string',
        ]);
        $group  = Group::findOrFail($id);
        $data = [
            'code' => $request->code,
            'company_id' => $request->company_id,
            'name' => $request->name,
        ];

        $group->update($data);
        return response()->json(['msg' => 'update successfully']);
    }
}
