@extends('layouts.admin')
@section('title', 'Product Type management')
@section('content')
	<div class="col-sm-12">
		<form action="{{route('type.save')}}" method="post" novalidate enctype="multipart/form-data">
			{{csrf_field()}}
			<input type="hidden" name="id" value="{{$model->id}}">
			<input type="hidden" name="entity_type" value="{{$modelSlug->entity_type}}">
			<div class="form-group">
				<label for="name">Type name</label>
				<input id="name" type="text" 
					value="{{old('name', $model->name)}}" name="name" class="form-control" placeholder="Type name">
				@if (count($errors) > 0)
					<span class="text-danger">{{$errors->first('name')}}</span>
				@endif
			</div>
			<div class="form-group">
				<label for="type_url">Slug Url</label>
				<input id="type_url" type="text" 
					value="{{old('slug', $modelSlug->slug)}}" name="slug" class="form-control" placeholder="Slug url">
				@if (count($errors) > 0)
					<span class="text-danger">{{$errors->first('slug')}}</span>
				@endif
			</div>
			<div class="form-group">
				<label for="description">Description</label>
				<textarea name="description" class="form-control" id="description" >
					{{old('description', $model->description)}}
				</textarea>
				@if (count($errors) > 0)
					<span class="text-danger">{{$errors->first('description')}}</span>
				@endif
			</div>
			<div class="form-group">
				<label for="image">Image</label>
				<input type="file" name="image" class="form-control">
			</div>
			<div class="text-center">
				<button type="submit" class="btn btn-success">Submit</button>
				<a href="{{route('type.list')}}" class="btn btn-warning">Cancel</a>
			</div>
		</form>

	</div>

@endsection
@section('js')
<script type="text/javascript">
	ckeditor('description');
	$(document).ready(function(){
		$('#name').on('keyup change', function(){
			title = $(this).val();
			if(title == ""){
				$('#name').val('');
				return false;
			}
			$.ajax({
				url:"{{route('slug.generate')}}",
				type: 'GET',
				data: {title: title},
				dataType: 'JSON',
				success: function(rp){
					$('#type_url').val(rp.data);
				}
			});
		})
	});
</script>
	

@endsection