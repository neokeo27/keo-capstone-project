@extends('common') 

@section('pagetitle')
Edit Category
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
	@if (Auth::user())	
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Edit Category</h1>
			<hr/>

			{!! Form::model($category, ['route' => ['categories.update', $category->id], 'method'=>'PUT', 'data-parsley-validate' => '']) !!}

			<div class="row">
				<div class="col-md-12">
				    {{ Form::label('name', 'Name:') }}
				    {{ Form::text('name', null, ['class'=>'form-control', 'style'=>'', 
				                                  'data-parsley-required'=>'', 'data-parsley-maxlength'=>'100']) }}
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
				{!! Html::linkRoute('categories.index', 'Cancel', [], ['class'=>'btn btn-lg btn-danger btn-block', 'style'=>'margin-top:20px']) !!}
				</div>
				<div class="col-md-6">
			    {{ Form::submit('Update Category', ['class'=>'btn btn-success btn-lg btn-block', 'style'=>'margin-top:20px']) }}
				</div>
			</div>

			{!! Form::close() !!}

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