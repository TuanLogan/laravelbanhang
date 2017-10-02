@extends('master')
@section('content')
<div class="inner-header">
	<div class="container">
		<div class="pull-left">
			<h6 class="inner-title">Đăng kí</h6>
		</div>
		<div class="pull-right">
			<div class="beta-breadcrumb">
				<a href="index.html">Home</a> / <span>Đăng kí</span>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<div class="container">
	<div id="content">
		
		<form  method="post" class="beta-form-checkout">
			{{csrf_field()}}
			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-6">
					<h4>Đăng kí</h4>
					<div class="space20">&nbsp;</div>

					
					<div class="form-block">
						<label for="email">Email address*</label>
						<input type="email" id="email" name="email" required>
					</div>

					<div class="form-block">
						<label for="name">Fullname*</label>
						<input type="text" id="name" name="name" required>
					</div>

					<div class="form-block">
						<label for="adress">Address*</label>
						<input type="text" name="address" id="address" required>
					</div>
					
					<div class="form-block">
						<label for="gender">Gender</label>
						<select name="gender">
							<option value="male">Male</option>
							<option value="female">Female</option>
						</select>
					</div>

					<div class="form-block">
						<label for="phone">Phone*</label>
						<input type="text" name="phone" required>
					</div>
					<div class="form-block">
						<label for="password">Password*</label>
						<input type="password" name="password" required>
					</div>
					<div class="form-block">
						<label for="rePassword">Re password*</label>
						<input type="password" name="rePassword" required>
					</div>
					<div class="form-block">
						<button type="submit" class="btn btn-primary">Register</button>
					</div>
				</div>
				<div class="col-sm-3"></div>
			</div>
		</form>
	</div> <!-- #content -->
</div> <!-- .container -->
@endsection