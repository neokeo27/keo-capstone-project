<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    //show cart page
    public function index(Request $request)
    {
        $session_id = $request->session()->getId();
        $ip_address = $request->ip();

        $carts = Cart::with('item')->where('session_id', $session_id)->get();
        $subtotal = 0;

        foreach ($carts as $cart) {
            $subtotal += $cart->quantity * $cart->item->price;
            session()->put('quantity', $cart->quantity);
        }

        return view('cart', compact('carts', 'subtotal'));
    }

    //add items to cart
    public function add(Request $request, $id)
    {
        $session_id = $request->session()->getId();
        $ip_address = $request->ip();
        $cart = Cart::where('session_id', $session_id)->where('item_id', $id)->first();

        if (!$cart) {
            $cart = new Cart();
            $cart->session_id = $session_id;
            $cart->item_id = $id;
            $cart->quantity = 1;
            $cart->ip_address = $ip_address;
        } else {
            $cart->quantity += 1;
        }

        $cart->save();

        return redirect()->back()->with('success', 'Item added to cart!');
    }

    //update quantity of selected item in cart
    public function update(Request $request, $cart_id)
    {
        $cart = Cart::findOrFail($cart_id);
        $cart->quantity = $request->input('quantity');
        $cart->save();

        return redirect()->back()->with('success', 'Cart Updated');
    }

    //remove item from cart
    public function remove($cart_id)
    {
        $cart = Cart::findOrFail($cart_id);
        $cart->delete();

        return redirect()->back()->with('success', 'Item removed from cart.');
    }

    //clear all items in cart
    public function clearCart()
    {
        Cart::truncate();

        return redirect()->route('cart')->with('success', 'Cart has been cleared.');
    }
}
