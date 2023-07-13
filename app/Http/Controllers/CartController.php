<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //cart details with ajax
    public function details(Request $request){
        $data = $this->getData($request);
        Cart::create($data);
        $message = [
            'status' => 'success',
            'text' => 'Cart Created'
        ];
        return response()->json($message, 200);
    }

    //Cart summary
    public function summary(){
        $carts = Cart::select('carts.*', 'products.name as product_name', 'products.image as product_image', 'products.price as product_price')
                ->where('carts.user_id', Auth::user()->id)
                ->leftJoin('products', 'carts.product_id', 'products.id')
                ->get();
        $total = 0;
        foreach($carts as $cart){
            $total += ($cart->product_price * $cart->quantity);
        }
        return view ('User.Order.cart', compact('carts', 'total'));
    }

    //Get Data Function
    private function getData($request){
        return [
            'user_id' => $request-> userID,
            'product_id' => $request->productID,
            'quantity' =>$request->quantity
        ];
    }
}
