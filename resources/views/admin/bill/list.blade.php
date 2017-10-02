@extends('layouts.admin')
@section('title', 'Bills Management')
@section('content')
<div class="col-xs-6">
	<table class="table table-hover">
		@php
			$total = count($info);
		@endphp
		<thead>
			<tr>
				<th>Date Order</th>
				<th>Payment</th>
				<th>Total Price</th>
				<th>Note</th>
			</tr>

		</thead>
		<tbody>
		<tr>
			@foreach ($bills as $b)
				<td>{{$b->date_order}}</td>
				<td>{{$b->payment}}</td>
				<td>{{$b->total}}</td>
				<td>{{$b->note}}</td>
			@endforeach
		</tr>
		</tbody>
	</table>
</div>
<div class="col-xs-1">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Quantity</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($info as $i)
				<tr>
					<td>{{$i->quantity}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
<div class="col-xs-2">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Price</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($info as $i)
				<tr>
					<td>{{$i->unit_price}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
<div class="col-xs-2">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Product Name</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($product as $p)
				<tr>
					<td>{{$p->name}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
<div class="col-xs-1">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Unit</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($product as $p)
				<tr>
					<td>{{$p->unit}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>
<div class="text-center">
	<a href="{{route('customer.list')}}" title="" class="btn btn-info">Back to Customer list</a>
</div>

@endsection