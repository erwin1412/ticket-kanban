<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function purchase()
    {
        $orders = Order::where('user_id', auth()->user()->id)
            ->orderBy('id', 'desc')
            ->get();

        return view('users.purchase', compact('orders'));
    }

    public function detail($orderNumber)
    {
        $order      = Order::where('order_number', $orderNumber)->first();
        $details    = OrderDetail::where('order_id', $order->id)
            ->where('user_id', auth()->user()->id)
            ->get();

        return view('users.detail', compact('order', 'details'));
    }

    public function print($orderNumber)
    {
        $order      = Order::where('order_number', $orderNumber)->first();
        $details    = OrderDetail::where('order_id', $order->id)
            ->where('user_id', auth()->user()->id)
            ->get();

        return view('users.print', compact('order', 'details'));
    }
}
