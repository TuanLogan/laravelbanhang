@extends('layouts.admin')
@section('title', 'User Create')
@section('content')
	<div class="col-sm-12">
		<form action="{{route('user.save')}}" method="post" accept-charset="utf-8" novalidate enctype="multipart/form-data">
			{{csrf_field()}}
			<input type="hidden" name="id" value="{{old('id', $model->id)}}">
			<div class="form-group">
				<label for="full_name">Name</label>
				<input value="{{old('full_name', $model->full_name)}}" type="text" id="full_name" name="full_name" class="form-control" placeholder="full name">
			</div>
			<div class="form-group">
				<label for="role_name">Role</label>
				<select name="role_name" class="form-control">
					<option value="0">--------------</option>
					@foreach ($listRole as $value)
						<option value="{{$value->id}}">{{$value->role_name}}</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
						<label for="password">Password*</label>
						<input type="password" name="password" class="form-control"> required>
					</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input id="email" type="text" 
					value="{{old('email', $model->email)}}" name="email" class="form-control" placeholder="email">
				@if (count($errors) > 0)
					<span class="text-danger">{{$errors->first('email')}}</span>
				@endif
			</div>
			<div class="form-group">
				<label for="phone">Phone Number</label>
				<input id="phone" type="text" 
					value="{{old('phone', $model->phone)}}" name="phone" class="form-control" placeholder="phone number">
				@if (count($errors) > 0)
					<span class="text-danger">{{$errors->first('phone')}}</span>
				@endif
			</div>
			<div class="form-group">
				<label for="address">Address</label>
				<input id="address" type="text" 
					value="{{old('address', $model->address)}}" name="address" class="form-control" placeholder="address">
				@if (count($errors) > 0)
					<span class="text-danger">{{$errors->first('address')}}</span>
				@endif
			</div>
			<div class="form-group">
				<label for="image">Image</label>
				<input type="file" name="image" class="form-control">
			</div>
			<div class="text-center">
				<button type="submit" class="btn btn-success">Submit</button>
				<a href="{{route('user.list')}}" class="btn btn-warning">Cancel</a>
			</div>
		</form>
	</div>
@endsection