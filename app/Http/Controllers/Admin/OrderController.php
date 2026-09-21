<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with([
            'user',
            'items.menuItem'
        ])
        ->latest()
        ->get();

        return view(
            'admin.orders.index',
            compact('orders')
        );
    }


    public function show(Order $order)
    {
        $order->load([
            'user',
            'items.menuItem'
        ]);

        return view(
            'admin.orders.show',
            compact('order')
        );
    }


    public function updateStatus(
        Request $request,
        Order $order
    ) {
        $allowedTransitions = [
            'Pending' => [
                'Preparing',
                'Cancelled',
            ],

            'Preparing' => [
                'Delivered',
            ],

            'Delivered' => [],

            'Cancelled' => [],
        ];

        if (
            !isset($allowedTransitions[$order->status]) ||
            empty($allowedTransitions[$order->status])
        ) {
            return redirect()
                ->route('admin.orders.index')
                ->with(
                    'error',
                    "A {$order->status} order cannot be changed."
                );
        }

        $validated = $request->validate([
            'status' => 'required|string',
        ]);

        if (
            !in_array(
                $validated['status'],
                $allowedTransitions[$order->status],
                true
            )
        ) {
            return redirect()
                ->route('admin.orders.index')
                ->with(
                    'error',
                    'Invalid order status change.'
                );
        }

        $order->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('admin.orders.index')
            ->with(
                'success',
                'Order status updated successfully.'
            );
    }
}