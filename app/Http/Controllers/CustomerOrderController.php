<?php

namespace App\Http\Controllers;

use App\Models\Order;

class CustomerOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items.menuItem')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('customer.orders.index', compact('orders'));
    }


    public function show(Order $order)
    {
        abort_if($order->user_id !== auth()->id(), 403);

        $order->load('items.menuItem');

        return view('customer.orders.show', compact('order'));
    }


    public function cancel(Order $order)
    {
        abort_if($order->user_id !== auth()->id(), 403);

        if ($order->status !== 'Pending') {
            return redirect()
                ->route('customer.orders.show', $order->id)
                ->with('error', 'This order can no longer be cancelled.');
        }

        $order->update([
            'status' => 'Cancelled',
        ]);

        return redirect()
            ->route('customer.orders.show', $order->id)
            ->with('success', 'Your order has been cancelled successfully.');
    }
}