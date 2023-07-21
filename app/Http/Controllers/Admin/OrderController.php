<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $startDate = request()->start_date;
        $endDate = request()->end_date;

        if ($startDate == '' && $endDate == '') {
            $orders = Order::all();
        } else {
            $orders = Order::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:23:23'])
                ->get();
        }

        return view('admin.orders.index', compact('orders', 'startDate', 'endDate'));
    }

    public function print()
    {
        $startDate = request()->start_date;
        $endDate = request()->end_date;

        if ($startDate == '' && $endDate == '') {
            $orders = Order::all();
        } else {
            $orders = Order::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:23:23'])
                ->get();
        }

        return view('admin.orders.print', compact('orders'));
    }

    public function detail($orderNumber)
    {
        $order      = Order::where('order_number', $orderNumber)
            ->first();
        $details    = OrderDetail::where('order_id', $order->id)
            ->get();

        return view('admin.orders.detail', compact('order', 'details'));
    }

    public function printDetail($orderNumber)
    {
        $order      = Order::where('order_number', $orderNumber)
            ->first();
        $details    = OrderDetail::where('order_id', $order->id)
            ->get();

        return view('admin.orders.print_detail', compact('order', 'details'));
    }
}
