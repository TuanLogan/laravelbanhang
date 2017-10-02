@extends('layouts.admin')
@section('title', 'User Management')
@section('content')
@php
	$pageSize = [20, 40, 60, 80 , 100]
@endphp
<div class=" col-sm-12">
	<form action="{{route('user.list')}}" method="get" accept-charset="utf-8" class="form-inline col-sm-10">
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
			<th>Full Name</th>
			<th width="70">Image</th>
			<th>Email</th>
			<th>Phone Number</th>
			<th>Address</th>
			<th>Role</th>
			<th><a href="{{route('user.create')}}" class="btn btn-xs btn-success" title="">Create</a></th>
		</tr>
	</thead>
	<tbody>
	@foreach ($users as $key => $element)
		<tr>
			<td>{{++$loop->index}}</td>
			<td>{{$element->full_name}}</td>
			<td>
				<img src="{{asset($element->image)}}" alt="">
			</td>
			<td>{{$element->email}}</td>
			<td>{{$element->phone}}</td>
			<td>{{$element->address}}</td>
			<td>
				@php
					$role = \App\Models\UserRole::where('user_id',$element->id)->first();
					if(!$role){
						return false;
					}
					$role_name = \App\Models\Role::find($role->role_id);
				@endphp
				{{$role_name->role_name}}
			</td>
			<td>
				<a href="{{route('user.remove',['id' => $element->id])}}" class="btn btn-xs btn-info" title="">Remove</a>
			</td>
		</tr>
	@endforeach
		<tr>
			<td colspan="7" class="text-center">{{$users->links()}}</td>
		</tr>
	</tbody>
	
</table>
@endsection