@extends('common') 

@section('pagetitle')
Shopping Cart
@endsection

@section('pagename')
Capstone Project
@endsection

@section('scripts')
{!! Html::script('/bower_components/parsleyjs/dist/parsley.min.js') !!}
@endsection

@section('css')
{!! Html::style('/css/parsley.css') !!}
@endsection

@section('content')
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
								<input type="number" name="quantity" value="{{ $cart->quantity }}" min="1" max="{{$cart->item->quantity}}">
								<button type="submit">Update</button>
							</form>
						</td>
						<td>${{ $cart->quantity * $cart->item->price }}</td>
						<td>
							<form action="{{ route('removeItem', $cart->id) }}" method="POST">
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
			<div>
				{!! Form::open(['route' => 'clearCart', 'data-parsley-validate' => '']) !!}
				{{ Form::submit('Clear Cart', ['class'=>'btn btn-danger btn-lg', 'style'=>'margin-top:20px']) }}
				{!! Form::close() !!}
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Order Info</h1>
			<hr/>
			{!! Form::open(['route' => 'checkOrder', 'data-parsley-validate' => '']) !!}
			{{ Form::label('firstName', 'First Name:') }}
			{{ Form::text('firstName', null, ['class'=>'form-control', 'style'=>'', 'data-parsley-required'=>'', 'data-parsley-maxlength'=>'255']) }}
			{{ Form::label('lastName', 'Last Name:') }}
			{{ Form::text('lastName', null, ['class'=>'form-control', 'style'=>'', 'data-parsley-required'=>'', 'data-parsley-maxlength'=>'255']) }}
			{{ Form::label('phone', 'Phone Number:') }}
			{{ Form::text('phone', null, ['class'=>'form-control', 'style'=>'', 'data-parsley-required'=>'', 'data-parsley-maxlength'=>'255']) }}
			{{ Form::label('email', 'Email Address:') }}
			{{ Form::text('email', null, ['class'=>'form-control', 'style'=>'', 'data-parsley-required'=>'', 'data-parsley-maxlength'=>'255']) }}
 			{{ Form::submit('Submit Order', ['class'=>'btn btn-success btn-lg btn-block', 'style'=>'margin-top:20px']) }}
			{!! Form::close() !!}
		</div>	
@endsection