@extends('common') 

@section('pagetitle')
Order Confirmation
@endsection

@section('pagename')
Capstone Project
@endsection

@section('content')

@if(!session('session_id'))
    {{ redirect()->route('product.index') }}
@endif
<div class="col-md-8 col-sm-offset-2">
    <h2>Receipt</h2>

    <h3>Customer Information</h3>
    <p>Name: {{ $order->first_name }} {{ $order->last_name}}</p>
    <p>Phone: {{ $order->phone }}</p>
    <p>Email: {{ $order->email }}</p>

    <h3>Items Ordered</h3>
    <table class="table">
    <thead>
        <tr>
            <th>Item</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($itemsSold as $itemSold)
        <tr>
            <td>{{ $itemSold->item->title }}</td>
            <td>{{ $itemSold->quantity }}</td>
            <td>${{ $itemSold->item->price }}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2"><strong>Total Cost:</strong></td>
            <td><strong>${{ $totalCost }}</strong></td>
        </tr>
    </tfoot>
    </table>
</div>
{{ session()->forget('session_id') }}

@endsection