<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\SaleProduct;

class CSaleProduct extends Controller
{
    public function saleProduct(Request $request)
    {
        $validated = $request->validate([
            '*.invoice_id'=>'required|string',
            '*.product_id' => 'required|numeric',
            '*.weight' => 'required|numeric'
        ]);
        // $data=$request->all();
         $save = [];
        foreach($validated as $d)
        $save = SaleProduct::create($d);
        return response()->json([
            'message' => 'insert successfully',
            'data' => $save
        ], 201);
    }
    public function getLastInvoice()
    {
        $data=Invoice::orderBy('invoice_id','desc')->first();
        return response()->json([
            'data'=>$data
        ]);
    }
    //------------------------------- insert invoice header -----------------------------------
    public function invoiceHeader(Request $request)
    {
        $validated=$request->validate([
            'invoice_id'=>'required|string',
            'total'=>'required|numeric',
            'date'=>'required|string'
        ]);
        $invoice=Invoice::create($validated);
        return response()->json([
            'message'=>'Invoice header created successfully',
            'data'=>$invoice
        ],201);
    }
    //---------------------------------- get all invoice ---------------------------------------
    public function getAllInvoice()
    {
        $data=Invoice::all();
        return view('invoice.allInvoice',compact('data'));
       
    }
}
