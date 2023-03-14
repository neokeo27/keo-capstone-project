@extends('common') 

@section('pagetitle')
{{$item->title}}
@endsection

@section('pagename')
Capstone Project
@endsection

@section('content')

<div class="col-sm-2">
			<table class="table">
				<tbody>
					<tr> 
                        <?php echo "<img src=" . Storage::url('images/items/'.$item->picture) . " alt='" . $item->title . "'>" ?>
                    </tr>				
				</tbody>
			</table>
		</div>
		<div class="col-md-8 col-sm-offset-2">
				@if ($item)
				<table class="table">
					<tbody>
                        {{-- Image, Title, Product_ID, Description, Price, Quantity, SKU --}}
                        <tr><td><h4>{{$item->title}}</h4></td></tr>
                        <tr><td>Product ID: {{$item->id}}</td></tr>
                        <tr><td>Description: <?php echo "$item->description"?></td></tr>
                        <tr><td>Price: ${{$item->price}}</td></tr>
                        <tr><td>Stock: {{$item->quantity}}</td><td>SKU: {{$item->sku}}</td></tr>
					</tbody>
				</table>
				@else
				<div>
					<h4>404 Not Found</h4>
				</div>
				@endif
		</div>
	</div>
	

	<div class="row">
		<div class="col-sm-2">
			
		</div>
		<div class="col-md-8 col-md-offset-1">
            <table>
            <div>
              
     
                 <br/>
        
                
            </div><br/>
            <div>
                
            </div><br/>
            <div>
                
            </div><br/>
            <div>
                
            </div><br/>
            <div>
                
            </div>
		</div>
	</div>
	


@endsection