@extends('layouts.admin')
@section('title', 'Slide Management')
@section('content')
@php
	$pageSize = [5, 10, 15, 20 , 25]
@endphp
<div class=" col-sm-12">
	<form action="{{route('slide.list')}}" method="get" accept-charset="utf-8" class="form-inline col-sm-10">
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
			<th width="140">Image</th>
			<th>Alt</th>
			<th><a href="{{route('slide.create')}}" class="btn btn-xs btn-success" title="">Create</a></th>
		</tr>
	</thead>
	<tbody>
	@foreach ($slides as $element)
		<tr>
			<td>{{++$loop->index}}</td>
			<td>
			@if ($element->id < 5)
				<img src="{{asset($element->image)}}" alt="">
			@else
				<img src="{{asset($element->image)}}" alt="">
			@endif
			</td>
			<td>{{$element->alt}}</td>
			<td>
				<a href="{{route('slide.update',['id' => $element->id])}}" class="btn btn-xs btn-info" title="">Edit</a>
				<a href="{{route('slide.remove',['id' => $element->id])}}" class="btn btn-xs btn-info" title="">Remove</a>
			</td>
		</tr>
	@endforeach
		<tr>
			<td colspan="7" class="text-center">{{$slides->links()}}</td>
		</tr>
	</tbody>
	
</table>

@endsection