<?php

use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    Route::resource('stock', 'StockWarehouseController');
    Route::resource('warehouse', 'WarehouseController');
    Route::resource('company', 'CompanyController');
    Route::resource('material', 'MaterialGroupController');
    Route::resource('comodity', 'ComodityController');
    Route::resource('group', 'GroupController');
    Route::resource('drug', 'DrugController');
    Route::resource('category', 'CategoryController');
    Route::get('stock-freeze', 'StockFreezeController@index')->name('stock-freeze.index');
    Route::get('stock-opname', 'StockOpnameController@index')->name('stock-opname.index');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('report/stock-opname', 'StockOpnameController@report')->name('stock.report');
    Route::get('getdata/stock-warehouse', 'StockWarehouseController@getData')->name('get.stock.warehouse');
    Route::get('getdata/company', 'CompanyController@getData')->name('get.company');
    Route::get('getdata/material', 'MaterialGroupController@getData')->name('get.material');
    Route::get('getdata/komoditas', 'ComodityController@getData')->name('get.comodity');
    Route::get('getdata/golongan', 'GroupController@getData')->name('get.group');
    Route::get('getdata/kategori', 'CategoryController@getData')->name('get.category');
    Route::get('getdata/report', 'StockOpnameController@getDataReport')->name('get.report');
    Route::get('getdata/drug', 'DrugController@getData')->name('get.drug');
    Route::get('getdata/warehouse', 'WarehouseController@getData')->name('get.warehouse');
    Route::get('getdata/stock-opname', 'StockOpnameController@getData')->name('get.stock.opname');
    Route::post('stock-opname', 'StockOpnameController@update')->name('stock.opname.post');
    Route::post('stock-freeze/update', 'StockFreezeController@update')->name('stock.freeze.post');
    Route::post('getdata/stock-freeze', 'StockFreezeController@getData')->name('get.stock.freeze');
});
