<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = $this->syncCartWithDatabase();

        if (empty($cart)) {
            return redirect()
                ->route('home')
                ->with(
                    'error',
                    'Your cart is empty or its items are no longer available.'
                );
        }

        $subtotal = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        $delivery = 1.00;
        $total = $subtotal + $delivery;

        return view('checkout', compact(
            'cart',
            'subtotal',
            'delivery',
            'total'
        ));
    }


    public function store(Request $request)
    {
        $request->validate([
            'delivery_address' => 'required|string|max:1000',
            'phone' => 'required|string|max:30',
        ]);

        $cart = $this->syncCartWithDatabase();

        if (empty($cart)) {
            return redirect()
                ->route('home')
                ->with(
                    'error',
                    'Your cart is empty or its items are no longer available.'
                );
        }

        DB::transaction(function () use ($request, $cart) {

            $subtotal = collect($cart)->sum(function ($item) {
                return $item['price'] * $item['quantity'];
            });

            $delivery = 1.00;
            $total = $subtotal + $delivery;

            $order = Order::create([
                'user_id' => auth()->id(),
                'total_price' => $total,
                'status' => 'Pending',
                'delivery_address' => $request->delivery_address,
                'phone' => $request->phone,
            ]);

            foreach ($cart as $item) {

                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_item_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }
        });

        session()->forget('cart');

        return redirect()
            ->route('home')
            ->with(
                'success',
                'Your order has been placed successfully!'
            );
    }


    private function syncCartWithDatabase(): array
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return [];
        }

        $menuItems = MenuItem::whereIn(
            'id',
            array_keys($cart)
        )
        ->get()
        ->keyBy('id');

        $syncedCart = [];

        foreach ($cart as $id => $item) {

            $menuItem = $menuItems->get((int) $id);

            if (!$menuItem) {
                continue;
            }

            $quantity = (int) ($item['quantity'] ?? 0);

            if ($quantity < 1) {
                continue;
            }

            $syncedCart[$menuItem->id] = [
                'id' => $menuItem->id,
                'name' => $menuItem->name,
                'price' => (float) $menuItem->price,
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $syncedCart);

        return $syncedCart;
    }
}