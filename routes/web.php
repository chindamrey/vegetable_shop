<?php

use App\Http\Controllers\CrudProductController;
use App\Http\Controllers\CSaleProduct;
use App\Models\crud_product;
use Illuminate\Support\Facades\Route;

Route::get('/index',[CrudProductController::class,'getAllProduct']);
Route::get('/product-data/{id}',[CrudProductController::class,'getProduct']);
//------------------------------------get all product----------------------------
Route::get('/manageProduct/allProduct',[CrudProductController::class,'getAllProduct1']);
//------------------------------------get all product list ----------------------
Route::get('manage-product/product-list',[CrudProductController::class,'getAllProductList']);
Route::put('/manageProduct/update/{id}',[CrudProductController::class,'update']);
Route::delete('/manageProduct/delete/{id}',[CrudProductController::class,'delete']);
Route::post( '/manageProduct/create',[CrudProductController::class,'createProduct']);
//---------------------------------- order page ---------------------------------
Route::get('/',[CrudProductController::class,'getAllProduct']);
//---------------------------------- open create product ------------------------
Route::get('/manageProduct/createProduct',[CrudProductController::class,'openCreateProduct']);
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
//--------------------------------- open invoice ------------------------------
Route::get('/invoice/openInvoie/{id}',[CSaleProduct::class,'openInvoice']) ;
//----------------------------------delete invoice ----------------------------
Route::delete('/invoice/delete/{id}',[CrudProductController::class,'deleteInvoice']);
//----------------------------------Search Product-----------------------------
Route::get('/manageProduct/search',[CrudProductController::class,'searchProduct']);
//----------------------------------Search Invoice-----------------------------
Route::get('/invoice/all-invoice/search',[CrudProductController::class,'searchInvoice']);