<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\crud_product;
use Symfony\Component\Console\Completion\Output\FishCompletionOutput;

class CrudProductController extends Controller
{
    public function getAllProduct() 
    {
        $data=crud_product::all();
        return view('index',compact('data'));
    }
    public function getProduct($id) 
    {
        $product=crud_product::find($id);
        return response()->json($product);
    }
}
