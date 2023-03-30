<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use App\Models\Item;
use App\Models\ItemSold;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //validate customer info form data
    public function checkOrder(Request $request)
    {
        $validateForm = $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'phone' => 'required'
        ]);

        $session_id = $request->session()->getId();
        $ip_address = $request->ip();

        $order = new Order();
        $order->first_name = $validateForm['firstName'];
        $order->last_name = $validateForm['lastName'];
        $order->email = $validateForm['email'];
        $order->phone = $validateForm['phone'];
        $order->session_id = $session_id;
        $order->ip_address = $ip_address;
        $order->save();

        $cartItems = Cart::where('session_id', $session_id)->get();

        $orderID = $order->order_id;

        foreach ($cartItems as $cartItem) {

            if (isset($cartItem->id, $cartItem->price, $cartItem->quantity)) {
                $itemSold = new ItemSold();
                $itemSold->item_id = $cartItem->id;
                $itemSold->order_id = $orderID;
                $itemSold->price = $cartItem->price;
                $itemSold->quantity = $cartItem->quantity;
                $itemSold->save();
            }
            $cartItem->delete();
        };

        return redirect()->route('thanks', ['order' => $order]);
    }


    //show thank you & confirmation of order
    public function thanks(Request $request)
    {
        $session_id = $request->session()->getId();
        $ip_address = $request->ip();
    }
}
