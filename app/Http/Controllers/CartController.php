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

    //Cart Update
    public function update(Request $request){
        if ($request->quantity == 0){
            Cart::where('id', $request->cartID)->delete();
        }
        Cart::where('id', $request->cartID)->update([
            "quantity" => $request->quantity
        ]);
    }

    //Cart delete
    public function delete(Request $request){
        Cart::where('id', $request->cartID)->delete();
    }

    //To delete everything in a cart
    public function deleteAll(){
        Cart::where('user_id', Auth::user()->id)->delete();
    }

    //Cart Add (From Icon)
    public function add($id){
        Cart::create([
            'user_id' => Auth::user()->id,
            'product_id' => $id,
            'quantity' => 1
        ]);
        return redirect()->route('user#home')->with(['createSuccess' => 'Successfully Added to Cart!']);
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
