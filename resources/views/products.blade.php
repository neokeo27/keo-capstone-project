@extends('common') 

@section('pagetitle')
Products
@endsection

@section('pagename')
Capstone Project
@endsection

@section('content')
{{-- @if ($selectedCategory == 0)


@elseif ($selectedCategory == 1)

@endif --}}
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>All Products</h1>
		</div>

		<div class="col-md-12">
			<hr />
		</div>
	</div>

	<div class="row">
		<div class="col-sm-1">
			<table class="table">
				<thead>
					<th>Categories</th>
				</thead>
				<tbody>
					@foreach ($categories as $category)
					{{-- <tr><td><a href="products/{{$category->id}}" >{{$category->name}}</a></td></tr> --}}
					<tr><td><a href="{{ url('/products/' . $category->id)}}">{{$category->name}}</a></td></tr>
					@endforeach					
				</tbody>
			</table>
		</div>
		<div class="col-md-8 col-md-offset-2">
				@forelse ($items as $item)
				<table class="table">
					<tbody>
					<?php
					$counter = 0;
					echo "<tr>";
					foreach ($items as $item)
					{
						echo "<td>" . "<a href=''><img src=" . Storage::url('images/items/tn_'.$item->picture) . " alt='" . $item->title . "'></a><br/>";
						echo "<a href=''>" . $item->title . "</a><br/>";
						echo "Price: $" . $item->price . "<br/>";
						echo "<a href='' class='btn btn-success btn-sm'>Buy</a></td>"; 
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
				@empty
				<div>
					<h4>No Products Available for {{ $category->name }}</h4>
				</div>
				@endforelse
		</div>
	</div>
	
@endsection