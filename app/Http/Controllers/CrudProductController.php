<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\crud_product;
use App\Models\CustomInvoice;
use App\Models\Invoice;
use App\Models\SaleProduct;
use ResourceBundle;
use Symfony\Component\Console\Completion\Output\FishCompletionOutput;

class CrudProductController extends Controller
{
    public function openCreateProduct()
    {
        return view('manageProduct.createProduct');
    }
    public function createProduct(Request $request) 
    {
        $validated=$request->validate([
            'p_name'=>'required|string',
            'p_price'=>'required|numeric'
        ]);
        $product=crud_product::create($validated);
        return response()->json([
            'message'=>'Create product successfully',
            'data'=>$product
        ],201);
    }
    public function getAllProduct()
    {
        $data = crud_product::all();
        
        return view('index', compact('data'));
    }
    public function getAllProduct1()
    {
        $data = crud_product::all();
        return view('manageProduct.allProduct', compact('data'));
    }
    public function getProduct($id)
    {
        $product = crud_product::find($id);
        return response()->json($product);
    }
    public function update(Request $request, $id)
    {
        $product = crud_product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        $product->update($request->only(['p_name', 'p_price']));

        return response()->json([
            'message' => 'Updated Successfully',
            'data' => $product
        ]);
    }
    function delete($id)
    {
        $product=crud_product::find($id);
        if(!$product){
            return response()->json(['message'=>'Product not found'],404);

            
        }
        $product->delete();
        return response()->json(['message'=>'Deleted successfully']);
    }
    public function invoicePage()
    {
        $data=CustomInvoice::all();
        return view('invoice.customInvoice',compact('data'));
    }
    public function getInvoiceInfo()
    {
        $data=CustomInvoice::all();
        return response()->json($data);
    }
    public function customInvoice(Request $request,$id)
    {
        $data=CustomInvoice::find($id);
        if(!$data){
            return response()->json([
                'message'=>'Id not found'
            ],404);
        }
        $data->update($request->only(['name','description','phone_number']));
        return response()->json([
            'message'=> 'updated successfully',
            'data'=>$data
        ]);
    }
    public function deleteInvoice($id)
    {
        $invoice=Invoice::find($id);
        $sale=SaleProduct::find($id);
        $invoice->delete();
        $sale->delete();
        return response()->json(['message'=>'invoice deleted successfully']);

    }
    public function searchProduct(Request $request)
    {
        $q=$request->q;
        $product=crud_product::when($q,function($query) use ($q){
            $query->where('p_name','LIKE',"%{$q}%")
            ->orWhere('p_price','LIKE',"%{$q}");
        })->get();
        return response()->json([
            'data'=>$product
        ]);
    }
    public function searchInvoice(Request $request) 
    {
        $q=$request->q;
        $invoice=Invoice::when($q,function($query) use ($q){
            $query->where('invoice_id','LIKE',"%{$q}%");
        })->get();
        return response()->json([
            'data'=>$invoice
        ]);
    }
}
