<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\crud_product;
use ResourceBundle;
use Symfony\Component\Console\Completion\Output\FishCompletionOutput;

class CrudProductController extends Controller
{
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
}
