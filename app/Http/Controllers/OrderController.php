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
        // $session_id = $request->session()->getId();
        // $ip_address = $request->ip();
        // session(['session_id' => $session_id, 'ip_address' => $ip_address]);
        $sessionId = $request->session()->getId();
        $ipAddress = session()->get('ip_address');


        Log::info('Order Session ID: ' . $sessionId);

        $validateForm = $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'phone' => 'required'
        ]);

        $order = new Order();
        $order->first_name = $validateForm['firstName'];
        $order->last_name = $validateForm['lastName'];
        $order->email = $validateForm['email'];
        $order->phone = $validateForm['phone'];
        $order->session_id = $sessionId;
        $order->ip_address = $ipAddress;
        $order->save();

        $request->session()->regenerate();

        Log::info('Cart Items Session ID: ' . $sessionId);
        //$cartItems = Cart::where('session_id', $sessionId)->get();
        $cartItems = Cart::where('session_id', $sessionId)->get();
        Log::info('Cart items count: ' . count($cartItems));

        $orderID = $order->id;
        Log::info('OrderID: ' . $orderID);
        foreach ($cartItems as $cartItem) {
            $item = Item::find($cartItem->item_id);
            Log::info('Processing cart item: ' . $cartItem->id);
            Log::info('Item name: ' . $item->title);

            if ($order) {
                //if (isset($cartItem->id, $cartItem->quantity)) {
                $itemSold = new ItemSold();
                $itemSold->item_id = $cartItem->item_id;
                $itemSold->order_id = $orderID;
                $itemSold->price = $item->price;
                $itemSold->quantity = $cartItem->quantity;
                $itemSold->save();
                Log::info('Saved item sold: ' . $itemSold->id);
                // dd($itemSold);

                $item->quantity -= $cartItem->quantity;
                $item->save();
                //dd($item);
                Log::info('Decreased quantity of item: ' . $cartItem->id);
            }

            $cartItem->delete();
            Log::info('Deleted cart item: ' . $cartItem->id);
        };

        $itemsSold = $this->getItemsSold($order->id);
        //session()->forget('session_id');
        return redirect()->route('thanks', ['order' => $order, 'itemsSold' => $itemsSold]);
    }

    public function getItemsSold($orderId)
    {
        $itemsSold = ItemSold::where('order_id', $orderId)->get();
        return $itemsSold;
    }


    //show thank you & confirmation of order
    public function thanks(Request $request)
    {
        $sessionId = session()->get('session_id');
        $ipAddress = session()->get('ip_address');

        $order = Order::where('session_id', $sessionId)->where('ip_address', $ipAddress)->firstOrFail();

        $itemsSold = ItemSold::where('order_id', $order->order_id)->get();
        $totalCost = 0;

        foreach ($itemsSold as $itemSold) {
            $totalCost += $itemSold->price * $itemSold->quantity;
        }

        // $request->session()->forget('session_id');
        // $request->session()->forget('ip_address');

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

    //show order receipt
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
