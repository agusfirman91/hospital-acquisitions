<?php

namespace App\Http\Controllers;

use App\Category;
use App\Company;
use Illuminate\Http\Request;
use DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('category');
    }

    public function getData()
    {
        $data = Category::all();
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('company_name', function ($data) {
                return $data->company->name;
            })
            ->addColumn('action', function ($data) {
                return '<a href="' . route('category.edit', $data->id) . '" class="modal-show edit" title="Category: ' . $data->id . ' ">
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
        $category = new Category();
        $company = Company::orderBy('name')->pluck('name', 'id');
        return view('forms.category', compact(['category', 'company']));
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
            'name' => 'required|string',
        ]);
        $category  = new Category();
        $data = [
            'company_id' => $request->company_id,
            'name' => $request->name,
        ];

        $category->create($data);
        return response()->json(['msg' => 'update successfully']);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $company = Company::orderBy('name')->pluck('name', 'id');
        return view('forms.category', compact(['category', 'company']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,  [
            'company_id' => 'required|string',
            'name' => 'required|string',
        ]);
        $category  = Category::findOrFail($id);
        $data = [
            'company_id' => $request->company_id,
            'name' => $request->name,
        ];

        $category->update($data);
        return response()->json(['msg' => 'update successfully']);
    }
}
