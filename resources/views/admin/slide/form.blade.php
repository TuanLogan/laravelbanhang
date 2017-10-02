@extends('layouts.admin')
@section('title', 'Create New Slide')
@section('content')
	<div class="col-sm-12">
		<form action="{{route('slide.save')}}" method="post" novalidate enctype="multipart/form-data">
			{{csrf_field()}}
			<input type="hidden" name="id" value="{{$model->id}}">
			<div class="form-group">
				<label for="alt">Alt</label>
				<input id="alt" type="text" 
					value="{{old('alt', $model->alt)}}" name="alt" class="form-control" placeholder="Alt">
				@if (count($errors) > 0)
					<span class="text-danger">{{$errors->first('alt')}}</span>
				@endif
			</div>
			<div class="form-group">
				<label for="image">Image</label>
				<input value="{{old('image', $model->image)}}" type="file" name="image" class="form-control">
			</div>
			<div class="text-center">
				<button type="submit" class="btn btn-success">Submit</button>
				<a href="{{route('slide.list')}}" class="btn btn-warning">Cancel</a>
			</div>
		</form>
	</div>

@endsection