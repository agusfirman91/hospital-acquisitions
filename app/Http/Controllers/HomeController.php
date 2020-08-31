<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comodity;
use App\Company;
use App\Group;
use App\MaterialGroup;
use App\Stock;
use App\Warehouse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cCompany = Company::count();
        $cMaterial = MaterialGroup::count();
        $cComodity = Comodity::count();
        $cGroup = Group::count();
        $cCategory = Category::count();
        $cWarehouse = Warehouse::count();
        $cStock = Stock::count();
        // return $cCompany;
        return view('home', compact(['cCompany', 'cMaterial', 'cComodity', 'cGroup', 'cCategory', 'cWarehouse', 'cStock']));
    }
}
