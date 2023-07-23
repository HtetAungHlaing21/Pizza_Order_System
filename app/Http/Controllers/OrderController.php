<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    //Add order
    public function addOrder(Request $request)
    {
        $totalPrice = 0;
        foreach($request->all() as $order){
            $data = $this->getData($order);
            $orderList = OrderList::create($data);
            $totalPrice += $order['total'];
        }
        Cart::where('user_id', Auth::user()->id)->delete();
        Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $orderList->order_code,
            'total' => $totalPrice + 3000
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Order Completed'
        ], 200);
    }

    //Show History
    public function history(){
        $orders = Order::where('user_id', Auth::user()->id)->get();
        return view("User.Order.history", compact('orders'));
    }

    //Change array format
    private function getData($request)
    {
        return [
            'user_id' => $request['userID'],
            'product_id' => $request['productID'],
            'quantity' => $request['quantity'],
            'total' => $request['total'],
            'order_code' => $request['order_code']
        ];
    }
}
