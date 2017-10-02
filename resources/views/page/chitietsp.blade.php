@extends('master')
@section('title', $product->name)
@section('content')
<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Sản phẩm {{$product->name}}</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="{{route('trang-chu')}}">Home</a> / <span>Product Information</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>

	<div class="container">
		<div id="content">
			<div class="row">
				<div class="col-sm-9">

					<div class="row">
						<div class="col-sm-4">
							<img src="{{asset($product->image)}}" alt="">
						</div>
						<div class="col-sm-8">
							<div class="single-item-body">
								<p class="single-item-title"><h2>{{$product->name}}</h2></p>
								<p class="single-item-price">
									@if ($product->promotion_price != 0)
										<span class="flash-del">{{$product->unit_price}}</span>
										<span class="flash-sale">{{$product->promotion_price}}</span>
									@else
										<span class="flash-sale">{{$product->unit_price}}</span>
									@endif
								</p>
							</div>

							<div class="clearfix"></div>
							<div class="space20">&nbsp;</div>

							<div class="single-item-desc">
								<p>{!!$product->description!!}</p>
							</div>
							<div class="space20">&nbsp;</div>

							<p>Thêm vào giỏ hàng:</p>
							<div class="single-item-options">
								<a class="add-to-cart" href="{{route('themgiohang',$product->id)}}"><i class="fa fa-shopping-cart"></i></a>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>

					<div class="space40">&nbsp;</div>
					<div class="woocommerce-tabs">
						<ul class="tabs">
							<li><a href="#tab-description">Description</a></li>
							{{-- <li><a href="#tab-reviews">Reviews (0)</a></li> --}}
						</ul>

						<div class="panel" id="tab-description">
							<p>{!!$product->description!!}</p>
						</div>
						{{-- <div class="panel" id="tab-reviews">
							<p>No Reviews</p>
						</div> --}}
					</div>
					<div class="space50">&nbsp;</div>
					<div class="beta-products-list">
						<h4>Sản phẩm cùng loại</h4>

						<div class="row">
						@foreach ($same as $element)
							<div class="col-sm-4">
								<div class="single-item">
								@if ($element->promotion_price != 0)
									<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
								@endif
									<div class="single-item-header">
										<a href="{{$element->getSlug()}}"><img src="{{asset($element->image)}}" alt="" height="150px"></a>
									</div>
									<div class="single-item-body">
										<p class="single-item-title">{{$element->name}}p</p>
										<p class="single-item-price">
											@if ($element->promotion_price != 0)
												<span class="flash-del">{{$element->unit_price}}</span>
												<span class="flash-sale">{{$element->promotion_price}}</span>
											@else
												<span class="flash-sale">{{$element->unit_price}}</span>
											@endif
										</p>
									</div>
									<div class="single-item-caption">
										<a class="add-to-cart pull-left" href="{{route('themgiohang',$element->id)}}"><i class="fa fa-shopping-cart"></i></a>
										<a class="beta-btn primary" href="{{$element->getSlug()}}">Details <i class="fa fa-chevron-right"></i></a>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						@endforeach
							
							
						</div>
						<div class="row">
							{{$same->links()}}
						</div>
					</div> <!-- .beta-products-list -->
				</div>
			</div>
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection