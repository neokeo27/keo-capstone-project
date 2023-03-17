@extends('common') 

@section('pagetitle')
Products
@endsection

@section('pagename')
Capstone Project
@endsection

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Products</h1>
		</div>

		<div class="col-md-12">
			<hr />
		</div>
	</div>

	<div class="row">
		<div class="col-sm-2">
			<table class="table">
				<thead>
					<th>Categories</th>
				</thead>
				<tbody>
					<tr><td><a href="{{url('/products/')}}">ALL</a></td></tr>
					@foreach ($categories as $category)
					<tr><td><a href="{{ url('/products/' . $category->id)}}">{{$category->name}}</a></td></tr>
					@endforeach					
				</tbody>
			</table>
		</div>
		<div class="col-md-8 col-md-offset-1">
				@if ($items)
				<table class="table">
					<tbody>
					<?php
					$counter = 0;
					echo "<tr>";
					foreach ($items as $item)
					{
						echo "<td>" . "<a href='/products/". $item->category_id . "/" . $item->id ."'><img src=" . Storage::url('images/items/tn_'.$item->picture) . " alt='" . $item->title . "'></a><br/>";
						echo  "<a href='/products/". $item->category_id . "/" . $item->id ."'>" . $item->title . "</a><br/>";
						echo "Price: $" . $item->price . "<br/>";
						echo "<a href='/cart/add/" . $item->id . "' class='btn btn-success btn-sm'>Add To Cart</a></td>"; 
						$counter++;

						if ($counter % 5 == 0) {
							echo "</tr><tr>";
						} else {
							continue;
						}
					}
					?>
					</tbody>
				</table>
				@else
				<div>
					<h4>No Products Available for {{ $category->name }}</h4>
				</div>
				@endif
		</div>
	</div>
	
@endsection