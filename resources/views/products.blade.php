@extends('common') 

@section('pagetitle')
Products
@endsection

@section('pagename')
Capstone Project
@endsection

@section('content')
	@if (Auth::user())
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
					<tr><td>Test1</td></tr>
					<tr><td>Test2</td></tr>
					<tr><td>Test3</td></tr>
				</tbody>
			</table>
		</div>
		<div class="col-md-8 col-md-offset-2">
			{{-- <table class="table">
				<thead>
					<th>#</th>
					<th>Title</th>					
					<th>Created At</th>
					<th>Last Modified</th>
					<th>Category #</th>
					<th></th>
				</thead>
				<tbody>
					@foreach ($items as $item)
						<tr>
							<th>{{ $item->id }}</th>
							<td>{{ $item->title }}</td>							
							<td style="width: 100px;">{{ date('M j, Y', strtotime($item->created_at)) }}</td>
							<td>{{ date('M j, Y', strtotime($item->updated_at)) }}</td>
							<td>{{ $item->category_id }}</td>
							<td style="width: 175px;"><div style='float:left; margin-right:5px;'><a href="{{ route('items.edit', $item->id) }}" class="btn btn-success btn-sm">Edit</a></div><div style='float:left;'>
								{!! Form::open(['route' => ['items.destroy', $item->id], 'method'=>'DELETE']) !!}
							    	{{ Form::submit('Delete', ['class'=>'btn btn-sm btn-danger btn-block', 'style'=>'', 'onclick'=>'return confirm("Are you sure?")']) }}
								{!! Form::close() !!}</div>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table> --}}
		</div>
	</div>
@else
	
@endif
@endsection