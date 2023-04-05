@extends('common') 

@section('pagetitle')
Orders
@endsection

@section('pagename')
Capstone Project
@endsection

@section('content')
@if (Auth::user())
	<div>
		<div>
			<h2>All Orders</h2>
            @if ($orders)
            <table class="table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->order_id }}</td>
                        <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->email }}</td>
                        <td>{{ $order->created_at }}</td>
                        <td><a href='/order/{{$order->order_id}}' class='btn btn-success btn-sm'>View Order</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @else
            <div>
                <h4>No Orders Available</h4>
            </div>
            @endif
		</div>
	</div>
@else
  <div>
    <h4>Please Login</h4>
</div>
@endif
@endsection