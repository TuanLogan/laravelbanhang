@extends('layouts.admin')
@section('title', 'Customer management')
@section('content')
	<div class="col-sm-12">
		<form action="{{route('customer.save')}}" method="post" novalidate enctype="multipart/form-data">
			{{csrf_field()}}
			<input type="hidden" name="id" value="{{$model->id}}">
			<div class="form-group">
				<label for="name">Name</label>
				<input id="name" type="text" 
					value="{{old('name', $model->name)}}" name="name" class="form-control" placeholder=" name">
				@if (count($errors) > 0)
					<span class="text-danger">{{$errors->first('name')}}</span>
				@endif
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input id="email" type="text" 
					value="{{old('email', $model->email)}}" name="email" class="form-control" placeholder="Email">
				@if (count($errors) > 0)
					<span class="text-danger">{{$errors->first('email')}}</span>
				@endif
			</div>
			<div class="form-group">
				<label for="address">Address</label>
				<input id="address" type="text" 
					value="{{old('address', $model->address)}}" name="address" class="form-control" placeholder="Address">
				@if (count($errors) > 0)
					<span class="text-danger">{{$errors->first('address')}}</span>
				@endif
			</div>
			<div class="form-group">
				<label for="phone_number">Phone Number</label>
				<input id="phone_number" type="text" 
					value="{{old('phone_number', $model->phone_number)}}" name="phone_number" class="form-control" placeholder="Phone Number">
				@if (count($errors) > 0)
					<span class="text-danger">{{$errors->first('phone_number')}}</span>
				@endif
			</div>
			<div class="form-group">
				<label for="gender">Gender</label>
				<select name="gender">
					@if ($model->gender == "Nam")
					<option selected value="Nam">Nam</option>
					<option value="Nữ">Nữ</option>
					@else
					<option  value="Nam">Nam</option>
					<option selected value="Nữ">Nữ</option>
					@endif
				</select>
			</div>
			
			<div class="text-center">
				<button type="submit" class="btn btn-success">Submit</button>
				<a href="{{route('customer.list')}}" class="btn btn-warning">Cancel</a>
			</div>
		</form>

	</div>

@endsection
