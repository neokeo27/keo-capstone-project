@extends('common') 

@section('pagetitle')
Shopping Cart
@endsection

@section('pagename')
Capstone Project
@endsection

@section('content')
@if (Auth::user())
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Shopping Cart</h1>
		</div>

		<div class="col-md-12">
			<hr />
		</div>
	</div>

	<div class="row">
		<div class="col-md-8 col-md-offset-1">
			<table class="table">
				<thead>
					<tr>
						<th>Product</th>
						<th>Price</th>
						<th>Quantity</th>
					</tr>
				</thead>
				<tbody>
					 @foreach ($carts as $cart)
					<tr>
						<td>{{ $cart->item->title }}</td>
						<td>${{ $cart->item->price }}</td>
						<td>
							<form action="{{ route('updateCart', $cart->id) }}" method="POST">
								@csrf
								@method('PUT')
								<input type="number" name="quantity" value="{{ $cart->quantity }}" min="1" max="100">
								<button type="submit">Update</button>
							</form>
						</td>
						<td>${{ $cart->quantity * $cart->item->price }}</td>
						<td>
							<form action="{{ route('removeCart', $cart->id) }}" method="POST">
								@csrf
								@method('DELETE')
								<button type="submit">Remove</button>
							</form>
						</td>
					</tr>
                    @endforeach
				</tbody>
			</table>
			<p>Subtotal: ${{ $subtotal }}</p>
		</div>
	</div>
@else
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Page Unavailable</h1>
			<p>Please login.</p>
		</div>
	</div>	
@endif
@endsection