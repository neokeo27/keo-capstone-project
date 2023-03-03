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
				        
			        </div>
                    @else
                    {{__('Please login to view categories or items')}}
                    @endif    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
