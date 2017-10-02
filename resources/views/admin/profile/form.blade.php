@extends('layouts.admin')
@section('title', 'User Proflie')
@section('content')
	<div class="col-sm-12">
		<form method="post" accept-charset="utf-8" novalidate enctype="multipart/form-data">
			{{csrf_field()}}
			<div class="form-group">
				<label for="full_name">Full name</label>
				<input value="{{old('full_name', $user->full_name)}}" type="text" id="full_name" name="full_name" class="form-control" placeholder="Ex: Nguyen Van A">
				@if (count($errors) > 0)
					<span class="text-danger">{{$errors->first('full_name')}}</span>
				@endif
			</div>
			<div class="form-group">
				<label for="image">Image</label>
				<input type="file" name="image" id="image" class="form-control">
				@if (count($errors) > 0)
					<span class="text-danger">{{$errors->first('image')}}</span>
				@endif
			</div>
			<div class="form-group">
				<label for="phone">Phone Number</label>
				<input id="phone" type="text" 
					value="{{old('phone', $user->phone)}}" name="phone" class="form-control" placeholder="Your Phone">
				@if (count($errors) > 0)
					<span class="text-danger">{{$errors->first('phone')}}</span>
				@endif
			</div>
			<div class="form-group">
				<label for="address">Address</label>
				<input id="address" type="text" 
					value="{{old('address', $user->address)}}" name="address" class="form-control" placeholder="Your Address">
				@if (count($errors) > 0)
					<span class="text-danger">{{$errors->first('address')}}</span>
				@endif
			</div>
			<div class="text-center">
				<button type="submit" class="btn btn-success">Submit</button>
				<a href="{{route('product.list')}}" class="btn btn-warning">Cancel</a>
			</div>
		</form>
	</div>
@endsection