@extends('layouts.admin')
@section('title', 'Product Management')
@section('content')
@php
	$pageSize = [20, 40, 60, 80 , 100]
@endphp
<div class=" col-sm-12">
	<form action="{{route('type.list')}}" method="get" accept-charset="utf-8" class="form-inline col-sm-10">
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
			<th>Type Name</th>
			<th width="70">Image</th>
			<th>Description</th>
			<th><a href="{{route('type.create')}}" class="btn btn-xs btn-success" title="">Create</a></th>
		</tr>
	</thead>
	<tbody>
	@foreach ($types as $element)
		<tr>
			<td>{{++$loop->index}}</td>
			<td>{{$element->name}}</td>
			<td><img src="{{asset($element->image)}}" alt=""></td>
			<td>{{$element->description}}</td>
			<td>
				<a href="{{route('type.update',['id' => $element->id])}}" class="btn btn-xs btn-info" title="">Edit</a>
				<a href="{{route('type.remove',['id' => $element->id])}}" class="btn btn-xs btn-info" title="">Remove</a>
			</td>
		</tr>
	@endforeach
		<tr>
			<td colspan="7" class="text-center">{{$types->links()}}</td>
		</tr>
	</tbody>
	
</table>

@endsection