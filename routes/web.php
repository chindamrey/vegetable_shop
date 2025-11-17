<?php

use App\Http\Controllers\CrudProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('manageProduct.createProduct');
});
Route::get('/index',[CrudProductController::class,'getAllProduct']);
Route::get('/product-data/{id}',[CrudProductController::class,'getProduct']);