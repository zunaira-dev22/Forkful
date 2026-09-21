<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MenuItem;

class MenuController extends Controller
{
    public function index()
    {
        $categories = Category::with('menuItems')->get();

        // Cart ko latest database data ke saath sync karo
        $cart = $this->syncCartWithDatabase();

        $cartCount = collect($cart)->sum('quantity');

        $subtotal = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        $delivery = $subtotal > 0 ? 1.00 : 0;

        $total = $subtotal + $delivery;

        return view('home', compact(
            'categories',
            'cart',
            'cartCount',
            'subtotal',
            'delivery',
            'total'
        ));
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

            /*
            |--------------------------------------------------------------------------
            | Item delete ho chuka hai
            |--------------------------------------------------------------------------
            |
            | Cart se automatically remove ho jayega.
            |
            */

            if (!$menuItem) {
                continue;
            }

            $quantity = (int) ($item['quantity'] ?? 0);

            if ($quantity < 1) {
                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | Latest database data
            |--------------------------------------------------------------------------
            */

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