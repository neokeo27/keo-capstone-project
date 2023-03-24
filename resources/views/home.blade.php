@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (Auth::user())
                    {{ __('You are logged in!') }}
                    <div class="text-center" style="float-left">
				        <a href="products" >Shop!</a>
			        </div>
                    <div class="text-center" style="float-left">
				        <a href="categories" >View All Categories</a>
			        </div>
                    <div class="text-center" style="float-left">
				        <a href="items" >View All Items</a>
			        </div>
                    <div class="text-center" style="float-left">
				        <a href="orders" >View All Orders</a>
			        </div>
                    @else
                    {{__('Please login to edit products or view orders.')}}
                    <br/>
                    <div class="text-left" style="float-left">
				        <a href="products" >Shop!</a>
			        </div>
                    @endif    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
