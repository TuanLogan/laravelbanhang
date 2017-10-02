@extends('layouts.admin')
@section('title', 'Product Create')
@section('content')
	<div class="col-sm-12">
		<form action="{{route('product.save')}}" method="post" accept-charset="utf-8" novalidate enctype="multipart/form-data">
			{{csrf_field()}}
			<input type="hidden" name="id" value="{{old('id', $model->id)}}">
			<input type="hidden" name="entity_type" value="{{$modelSlug->entity_type}}">
			<div class="form-group">
				<label for="name">Name</label>
				<input value="{{old('name', $model->name)}}" type="text" id="name" name="name" class="form-control" placeholder="Product Name">
			</div>
			<div class="form-group">
				<label for="product_url">Slug Url</label>
				<input id="product_url" type="text" 
					value="{{old('slug', $modelSlug->slug)}}" name="slug" class="form-control" placeholder="Slug url">
				@if (count($errors) > 0)
					<span class="text-danger">{{$errors->first('slug')}}</span>
				@endif
			</div>
			<div class="form-group">
				<label for="type_product">type_product</label>
				<select name="id_type" class="form-control">
					<option value="0">--------------</option>
					@foreach ($listType as $key => $value)
						@php
							$selected = $model->id_type == $value->id ? "selected" : null;
						@endphp
						
						<option value="{{$value->id}}" {{$selected}}>{{$value->name}}</option>
					@endforeach
				</select>
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
				<label for="unit_price">Unit Price</label>
				<input id="unit_price" type="text" 
					value="{{old('unit_price', $model->unit_price)}}" name="unit_price" class="form-control" placeholder="Unit Price">
				@if (count($errors) > 0)
					<span class="text-danger">{{$errors->first('unit_price')}}</span>
				@endif
			</div>
			<div class="form-group">
				<label for="promotion_price">Promotion Price</label>
				<input id="promotion_price" type="text" 
					value="{{old('promotion_price', $model->promotion_price)}}" name="promotion_price" class="form-control" placeholder="Promotion Price">
				@if (count($errors) > 0)
					<span class="text-danger">{{$errors->first('promotion_price')}}</span>
				@endif
			</div>
			<div class="form-group">
				<label for="image">Image</label>
				<input type="file" name="image" class="form-control">
			</div>
			<div class="form-group">
				<label for="unit">Unit</label>
				<input id="unit" type="text" 
					value="{{old('unit', $model->unit)}}" name="unit" class="form-control" placeholder="Unit">
				@if (count($errors) > 0)
					<span class="text-danger">{{$errors->first('unit')}}</span>
				@endif
			</div>
			<div class="text-center">
				<button type="submit" class="btn btn-success">Submit</button>
				<a href="{{route('product.list')}}" class="btn btn-warning">Cancel</a>
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
					$('#product_url').val(rp.data);
				}
			});
		})
	});
</script>
@endsection