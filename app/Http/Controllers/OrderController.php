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
        foreach ($request->all() as $order) {
            $data = $this->getData($order);
            $orderList = OrderList::create($data);
            $totalPrice += $order['total'];
        }
        Cart::where('user_id', Auth::user()->id)->delete();
        Order::create([
            'user_id' => Auth::user()->id,
            'order_code' => $orderList->order_code,
            'total' => $totalPrice + 3000,
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Order Completed',
        ], 200);
    }

    //Show History
    public function history()
    {
        $orders = Order::when(request('key'), function ($query) {
            $searchKey = request('key');
            $query->where('order_code', 'like', '%' . $searchKey . '%');
        })
            ->where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->paginate(7);
        return view("User.Order.history", compact('orders'));
    }

    //Show order list in admin panel
    function list() {
        $orders = Order::when(request('key'), function ($query) {
            $searchKey = request('key');
            $query->where('order_code', 'like', '%' . $searchKey . '%');
        })
            ->select('orders.*', 'users.name as user_name')
            ->leftJoin('users', 'orders.user_id', 'users.id')
            ->orderBy('id', 'desc')
            ->paginate(7);
        return view('Admin.Order.list', compact('orders'));
    }

    //Show order list in admin panel (Filter by customer)
    public function customerList($id)
    {
        $orders = Order::when(request('key'), function ($query) {
            $searchKey = request('key');
            $query->where('order_code', 'like', '%' . $searchKey . '%');
        })
            ->select('orders.*', 'users.name as user_name')
            ->leftJoin('users', 'orders.user_id', 'users.id')
            ->where('orders.user_id', $id)
            ->orderBy('id', 'desc')
            ->paginate(7);
        return view('Admin.Order.list', compact('orders'));

    }

    //Show order details in admin panal
    public function details($code)
    {
        $items = OrderList::select('order_lists.*', 'orders.total as total_amount', 'orders.status', 'users.name as user_name', 'users.phone_number as user_phone', 'users.email as user_email', 'products.image as product_image', 'products.name as product_name')
            ->leftJoin('orders', 'order_lists.order_code', 'orders.order_code')
            ->leftJoin('users', 'order_lists.user_id', 'users.id')
            ->leftJoin('products', 'order_lists.product_id', 'products.id')
            ->where('order_lists.order_code', $code)->paginate(5);
        return view('Admin.Order.details', compact('items'));
    }

    //Show order details in user panal
    public function showDetails($code)
    {
        $items = OrderList::select('order_lists.*', 'orders.total as total_amount', 'orders.status', 'users.name as user_name', 'users.phone_number as user_phone', 'users.email as user_email', 'products.image as product_image', 'products.name as product_name')
            ->leftJoin('orders', 'order_lists.order_code', 'orders.order_code')
            ->leftJoin('users', 'order_lists.user_id', 'users.id')
            ->leftJoin('products', 'order_lists.product_id', 'products.id')
            ->where('order_lists.order_code', $code)->paginate(5);
        return view('User.Order.details', compact('items'));
    }

    //change order status
    public function changeStatus($orderCode, $status)
    {
        Order::where('order_code', $orderCode)->update(['status' => $status]);
        return back()->with(['updateSuccess' => 'Order Status Updated']);
    }

    //Filter Order By status
    public function filter()
    {
        $orders = Order::when(request('orderStatus'), function ($query) {
            $status = request('orderStatus');
            $query->where('status', $status);
        })
            ->select('orders.*', 'users.name as user_name')
            ->leftJoin('users', 'orders.user_id', 'users.id')
            ->paginate(7);
        return view('Admin.Order.list', compact('orders'));
    }

    //Change array format
    private function getData($request)
    {
        return [
            'user_id' => $request['userID'],
            'product_id' => $request['productID'],
            'quantity' => $request['quantity'],
            'total' => $request['total'],
            'order_code' => $request['order_code'],
        ];
    }
}
