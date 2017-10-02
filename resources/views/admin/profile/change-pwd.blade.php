@extends('layouts.admin')
@section('title', 'User Change Password')
@section('content')
	<div class="col-xs-5 col-xs-offset-3">
		<form method="post" accept-charset="utf-8" novalidate >
			{{csrf_field()}}
			<div class="form-group">
				<label for="oldPass">Password</label>
				<input " type="password" id="oldPass" name="oldPass" class="form-control">
				@if (count($errors) > 0)
					<span class="text-danger">{{$errors->first('oldPass')}}</span>
				@endif
				@if (Session::has('errMsg'))
					<span class="text-danger">{{session('errMsg')}}</span>
				@endif
			</div>
			<div class="form-group">
				<label for="newPass">New Password</label>
				<input id="newPass" type="password" 
					 name="newPass" class="form-control">
				@if (count($errors) > 0)
					<span class="text-danger">{{$errors->first('newPass')}}</span>
				@endif
			</div>

			<div class="form-group">
				<label for="comfirmPass">Comfirm Password</label>
				<input id="comfirmPass" type="password" 
					 name="comfirmPass" class="form-control">
				@if (count($errors) > 0)
					<span class="text-danger">{{$errors->first('comfirmPass')}}</span>
				@endif
			</div>
			<div class="text-center">
				<button type="submit" class="btn btn-success">Submit</button>
				<a href="{{route('admin')}}" class="btn btn-warning">Cancel</a>
			</div>
		</form>
	</div>
@endsection