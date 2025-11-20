<?php

use App\Http\Controllers\CrudProductController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('manageProduct.allProduct');
// });
Route::get('/index',[CrudProductController::class,'getAllProduct']);
Route::get('/product-data/{id}',[CrudProductController::class,'getProduct']);
Route::get('/manageProduct/allProduct',[CrudProductController::class,'getAllProduct1']);
Route::put('/manageProduct/update/{id}',[CrudProductController::class,'update']);