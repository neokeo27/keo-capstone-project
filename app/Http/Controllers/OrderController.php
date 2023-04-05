<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use App\Models\Item;
use App\Models\ItemSold;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    //validate customer info form data and input in tables
    public function checkOrder(Request $request)
    {
        //get session_id and ip
        $sessionId = $request->session()->getId();
        $ipAddress = session()->get('ip_address');

        Log::info('Order Session ID: ' . $sessionId);

        //validate customer information
        $validateForm = $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'phone' => 'required'
        ]);

        //create new order model and store cust info and session variables
        $order = new Order();
        $order->first_name = $validateForm['firstName'];
        $order->last_name = $validateForm['lastName'];
        $order->email = $validateForm['email'];
        $order->phone = $validateForm['phone'];
        $order->session_id = $sessionId;
        $order->ip_address = $ipAddress;
        $order->save();

        //regenerate a new session_id for next order
        $request->session()->regenerate();

        Log::info('Cart Items Session ID: ' . $sessionId);

        //select cart that matches order
        $cartItems = Cart::where('session_id', $sessionId)->get();

        Log::info('Cart items count: ' . count($cartItems));

        $orderID = $order->id;
        Log::info('OrderID: ' . $orderID);

        //for each item in order, (if order exists) add item to itemsSold
        foreach ($cartItems as $cartItem) {
            $item = Item::find($cartItem->item_id);
            Log::info('Processing cart item: ' . $cartItem->id);
            Log::info('Item name: ' . $item->title);

            if ($order) {
                $itemSold = new ItemSold();
                $itemSold->item_id = $cartItem->item_id;
                $itemSold->order_id = $orderID;
                $itemSold->price = $item->price;
                $itemSold->quantity = $cartItem->quantity;
                $itemSold->save();
                Log::info('Saved item sold: ' . $itemSold->id);

                //after added to itemsSold, reduce quantity in DB
                $item->quantity -= $cartItem->quantity;
                $item->save();

                Log::info('Decreased quantity of item: ' . $cartItem->id);
            }

            //delete item from cart after its added to itemsSold
            $cartItem->delete();
            Log::info('Deleted cart item: ' . $cartItem->id);
        };

        //select itemsSold to send to thankYou page
        $itemsSold = ItemSold::where('order_id', $order->id)->get();

        return redirect()->route('thanks', ['order' => $order, 'itemsSold' => $itemsSold]);
    }


    //show thank you & confirmation of order
    public function thanks(Request $request)
    {
        $sessionId = session()->get('session_id');
        $ipAddress = session()->get('ip_address');

        //select order and itemsSold that matches session_id
        $order = Order::where('session_id', $sessionId)->where('ip_address', $ipAddress)->firstOrFail();
        $itemsSold = ItemSold::where('order_id', $order->order_id)->get();
        $totalCost = 0;

        //calculate total cost of items
        foreach ($itemsSold as $itemSold) {
            $totalCost += $itemSold->price * $itemSold->quantity;
        }

        //return view with order and item info
        return view('thanks', [
            'order' => $order,
            'itemsSold' => $itemsSold,
            'totalCost' => $totalCost,
        ]);
    }

    //show all orders in admin page
    public function orders()
    {
        $orders = Order::all();

        return view('orders', ['orders' => $orders]);
    }

    //show order receipt from orders page
    public function viewOrder($order_id)
    {
        $order = Order::where('order_id', $order_id)->first();
        $itemsSold = ItemSold::where('order_id', $order->order_id)->get();
        $totalCost = 0;

        foreach ($itemsSold as $itemSold) {
            $totalCost += $itemSold->price * $itemSold->quantity;
        }
        return view('viewOrder', [
            'order' => $order,
            'itemsSold' => $itemsSold,
            'totalCost' => $totalCost,
        ]);
    }
}
