<?php

use phpDocumentor\Reflection\DocBlock\Tags\Uses;

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
    return view('welcome');
});
/*
Route::group(['prefix' => 'test', 'middleware' => 'shield'], function()
{
    Route::get('/', ['uses' => 'PurchaseOrderService@test']); 
});
*/
Route::post('test', '\BearClaw\Warehousing\PurchaseOrderService@execute')->middleware('shield');