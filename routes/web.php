<?php

use App\Http\Controllers\CrudProductController;
use App\Http\Controllers\CSaleProduct;
use App\Models\crud_product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('manageProduct.createProduct');
});
Route::get('/index',[CrudProductController::class,'getAllProduct']);
Route::get('/product-data/{id}',[CrudProductController::class,'getProduct']);
Route::get('/manageProduct/allProduct',[CrudProductController::class,'getAllProduct1']);
Route::put('/manageProduct/update/{id}',[CrudProductController::class,'update']);
Route::delete('/manageProduct/delete/{id}',[CrudProductController::class,'delete']);
Route::post('/manageProduct/create',[CrudProductController::class,'createProduct']);
//--------------------------------- invoice page --------------------------------
Route::get('invoice/customInvoice',[CrudProductController::class,'invoicePage']); 
//--------------------------------- get invoice info ----------------------------
Route::get('/invoiceInfo',[CrudProductController::class,'getInvoiceInfo']);
//--------------------------------- sale product --------------------------------
Route::post('/index/sale',[CSaleProduct::class,'saleProduct']) ;
//-------------------------------- get last invoice -----------------------------
Route::get('/index/all',[CSaleProduct::class,'getLastInvoice']);
//-------------------------------- insert invoice header ------------------------
Route::post('/invoice/headerCreate',[CSaleProduct::class,'invoiceHeader']);
//-------------------------------- get all invoice ------------------------------
Route::get('/invoice/allInvoice',[CSaleProduct::class,'getAllInvoice']);