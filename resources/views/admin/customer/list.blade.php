@extends('layouts.admin')
@section('title', 'Customer Management')
@section('content')
@php
	$pageSize = [20, 40, 60, 80 , 100]
@endphp
<div class=" col-sm-12">
	<form action="{{route('customer.list')}}" method="get" accept-charset="utf-8" class="form-inline col-sm-10">
		<div class="form-group">
			<label> Page Size</label>
			<select name="pageSize">
				@foreach ($pageSize as $ps)
					@php
						$selectedPs = $ps ==$ctlPageSize ? "selected" : "";
					@endphp
					<option value="{{$ps}}" {{$selectedPs}}>{{$ps}}</option>}
				@endforeach
			</select>
		</div>
		<div class="form-group">
			<label>Search</label>
			<input type="text" value="{{$keyword}}" name="keyword" class="form-control">
			<button type="submit" class="btn btn-sm btn-info">
				<span class="glyphicon glyphicon-search"></span>
			</button>
		</div>
	</form>
</div>
<table class="table table-hover">
	<thead>
		<tr>
			<th>#</th>
			<th>Customer Name</th>
			<th>Gender</th>
			<th>Email</th>
			<th>Address</th>
			<th>Phone Number</th>
		</tr>
	</thead>
	<tbody>
	@foreach ($customers as $element)
		<tr>
			<td>{{++$loop->index}}</td>
			<td>{{$element->name}}</td>
			<td>{{$element->gender}}</td>
			<td>{{$element->email}}</td>
			<td>{{$element->address}}</td>
			<td>{{$element->phone_number}}</td>
			<td>
				<a href="{{route('customer.update',['id' => $element->id])}}" class="btn btn-xs btn-info" title="">Edit</a>
				<a href="{{route('customer.remove',['id' => $element->id])}}" class="btn btn-xs btn-info" title="">Remove</a>
				<a href="{{route('customer.detail',['id' => $element->id])}}" class="btn btn-xs btn-info" title="">Details</a>
			</td>
		</tr>
	@endforeach
		<tr>
			<td colspan="7" class="text-center">{{$customers->links()}}</td>
		</tr>
	</tbody>
	
</table>
@endsection