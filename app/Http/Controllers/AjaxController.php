<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    //Ajax Sorting
    public function sorting(Request $request){
        $status = $request->sort;
        if ($status == 'asc'){
            $product = Product::get();
        }else if ($status == 'desc'){
            $product = Product::orderBy('created_at', 'desc')->get();
        }
        return $product;
    }
}
