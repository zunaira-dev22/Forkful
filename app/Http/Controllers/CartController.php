<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;

class CartController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ADD ITEM
    |--------------------------------------------------------------------------
    */

    public function add(MenuItem $menuItem)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$menuItem->id])) {

            $cart[$menuItem->id]['quantity']++;

            // Latest database data
            $cart[$menuItem->id]['name'] = $menuItem->name;
            $cart[$menuItem->id]['price'] = (float) $menuItem->price;

        } else {

            $cart[$menuItem->id] = [
                'id' => $menuItem->id,
                'name' => $menuItem->name,
                'price' => (float) $menuItem->price,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->to('/#menu');
    }


    /*
    |--------------------------------------------------------------------------
    | INCREASE QUANTITY
    |--------------------------------------------------------------------------
    */

    public function increase($id)
    {
        $cart = session()->get('cart', []);

        $menuItem = MenuItem::find($id);

        /*
        |--------------------------------------------------------------------------
        | Dish admin ne delete kar di
        |--------------------------------------------------------------------------
        */

        if (!$menuItem) {

            unset($cart[$id]);

            session()->put('cart', $cart);

            return redirect()
                ->to('/#cart')
                ->with(
                    'error',
                    'This item is no longer available and was removed from your cart.'
                );
        }


        if (isset($cart[$id])) {

            $cart[$id]['quantity']++;

            // Latest name and price
            $cart[$id]['name'] = $menuItem->name;
            $cart[$id]['price'] = (float) $menuItem->price;
        }

        session()->put('cart', $cart);

        return redirect()->to('/#cart');
    }


    /*
    |--------------------------------------------------------------------------
    | DECREASE QUANTITY
    |--------------------------------------------------------------------------
    */

    public function decrease($id)
    {
        $cart = session()->get('cart', []);

        $menuItem = MenuItem::find($id);


        /*
        |--------------------------------------------------------------------------
        | Dish no longer exists
        |--------------------------------------------------------------------------
        */

        if (!$menuItem) {

            unset($cart[$id]);

            session()->put('cart', $cart);

            return redirect()
                ->to('/#cart')
                ->with(
                    'error',
                    'This item is no longer available and was removed from your cart.'
                );
        }


        if (isset($cart[$id])) {

            $cart[$id]['quantity']--;

            if ($cart[$id]['quantity'] <= 0) {

                unset($cart[$id]);

            } else {

                // Latest database information
                $cart[$id]['name'] = $menuItem->name;
                $cart[$id]['price'] = (float) $menuItem->price;
            }
        }

        session()->put('cart', $cart);

        return redirect()->to('/#cart');
    }
}