<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    //show cart page
    public function index(Request $request)
    {
        $session_id = $request->session()->getId();
        $ip_address = $request->ip();
        session(['session_id' => $session_id, 'ip_address' => $ip_address]);

        Log::info('Initial Cart Session ID: ' . $session_id);
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
        // Retrieve or create the session_id and ip_address session variables
        $sessionId = session()->get('session_id', null);
        $ipAddress = session()->get('ip_address', null);
        if (!$sessionId || !$ipAddress) {
            $sessionId = $request->session()->getId();
            $ipAddress = $request->ip();
            session(['session_id' => $sessionId, 'ip_address' => $ipAddress]);
        }

        Log::info('Cart Session ID: ' . $sessionId);
        $cart = Cart::where('session_id', $sessionId)->where('item_id', $id)->first();

        //if cart doesnt exist then create new one
        if (!$cart) {
            $cart = new Cart();
            $cart->session_id = $sessionId;
            $cart->item_id = $id;
            $cart->quantity = 1;
            $cart->ip_address = $ipAddress;
        } else {
            $cart->quantity += 1;
        }
        $item = Item::find($cart->item_id);
        Log::info('Item added: ' . $item->title);
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
