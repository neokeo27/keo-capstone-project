@extends('common') 

@section('pagetitle')
Category List
@endsection

@section('pagename')
Capstone Project
@endsection

@section('content')
@if (Auth::user())
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Category List</h1>
		</div>
			<div class="col-md-2">
				<a href="{{ route('categories.create') }}" class="btn btn-med btn-block btn-primary btn-h1-spacing">Add Category</a>
			</div>
		<div class="col-md-12">
			<hr />
		</div>
	</div>

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<table class="table">
				<thead>
					<th>#</th>
					<th>Name</th>
					<th>Count</th>
					<th>Created At</th>
					<th>Last Modified</th>
					<th></th>
				</thead>
				<tbody>
					@foreach ($categories as $category)
						<tr>
							<th>{{ $category->id }}</th>
							<td>{{ $category->name }}</td>
							<td>{{$category->items()->count()}}</td>
							<td style='width:100px;'>{{ date('M j, Y', strtotime($category->created_at)) }}</td>
							<td style='width:100px;'>{{ date('M j, Y', strtotime($category->updated_at)) }}</td>
							<td style='width:150px;'><div style='float:left; margin-right:5px;'><a href="{{ route('categories.edit', $category->id) }}" class="btn btn-success btn-sm">Edit</a></div>
								@if($category->items()->count() == 0)
								<div style="float:left; margin-left:5px">
									{!! Form::open([
										'route'=> ['categories.destroy', $category->id], 
										'method' => 'DELETE', 
										'onsubmit' => 'return confirm("Delete Category? Are you sure?")'
									]) !!}
									{{ Form::submit('Delete', ['class'=>'btn btn-sm btn-danger']) }}
									{!! Form::close() !!}
                                </div>
								@endif
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		<!-- end of .col-md-8 -->
	</div>
@else
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Category List Unavailable</h1>
			<p>Please login to add/view categories.</p>
		</div>
	</div>	
@endif

@endsection