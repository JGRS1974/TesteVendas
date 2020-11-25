<?php

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
    return view('vendas');
});

Route::get('/procuraProdutoajax','App\Http\Controllers\AutocompleteController@searchProduto');
Route::get('/dadosProduto','App\Http\Controllers\ProductoController@show');
Route::post('/salvaVenda','App\Http\Controllers\VendasController@create');