@extends('master')
@section('title', $type->name)
@section('content')
<div class="inner-header">
	<div class="container">
		<div class="pull-left">
			<h6 class="inner-title">Sản phẩm</h6>
		</div>
		<div class="pull-right">
			<div class="beta-breadcrumb font-large">
				<a href="{{route('trang-chu')}}">Home</a> / <span>Sản phẩm</span>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<div class="container">
	<div id="content" class="space-top-none">
		<div class="main-content">
			<div class="space60">&nbsp;</div>
			<div class="row">
				<div class="col-sm-3">
					<ul class="aside-menu">
					@foreach ($loai as $element)
						<li><a href="{{$element->getSlug()}}">{{$element->name}}</a></li>
					@endforeach
						
						
					</ul>
				</div>
				<div class="col-sm-9">
					<div class="beta-products-list">
						<h4>{{$type->name}}</h4>
						<img src="{{asset($element->image)}}" alt="" class="thumbnail" style="width: 70px">
						<div class="beta-products-details">
							<p class="pull-left">{!!$type->description!!}</p>
							<div class="clearfix"></div>
						</div>

						<div class="row">
							@foreach ($product as $element)
							<div class="col-sm-4">
								<div class="single-item">
									@if ($element->promotion_price != 0)
									<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
									@endif
									<div class="single-item-header">
										<a href="{{$element->getSlug()}}"><img height="250px" src="{{asset($element->image)}}" alt=""></a>
									</div>
									<div class="single-item-body">
										<p class="single-item-title">{{$element->name}}</p>
										<p class="single-item-price" style="font-size: 18px">
											@if ($element->promotion_price != 0)
											<span class="flash-del">{{$element->unit_price}} đồng</span>
											<span class="flash-sale">{{$element->promotion_price}} đồng</span>
											@else
											<span class="flash-sale">{{$element->unit_price}} đồng</span>
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
						<div>
							{{$product->links()}}
						</div>
					</div> <!-- .beta-products-list -->

					<div class="space50">&nbsp;</div>

					<div class="beta-products-list">
						<h4>Sản phẩm khác</h4>
						<div class="beta-products-details">
							{{-- <p class="pull-left">Có {{count($sp_khac)}} sản phẩm</p> --}}
							<div class="clearfix"></div>
						</div>
						<div class="row">
						@foreach ($other as $element)
							<div class="col-sm-4">
								<div class="single-item">
									@if ($element->promotion_price != 0)
									<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
									@endif
									<div class="single-item-header">
										<a href="{{$element->getSlug()}}"><img height="250px" src="{{asset($element->image)}}" alt=""></a>
									</div>
									<div class="single-item-body">
										<p class="single-item-title">{{$element->name}}</p>
										<p class="single-item-price" style="font-size: 18px">
											@if ($element->promotion_price != 0)
											<span class="flash-del">{{$element->unit_price}} đồng</span>
											<span class="flash-sale">{{$element->promotion_price}} đồng</span>
											@else
											<span class="flash-sale">{{$element->unit_price}} đồng</span>
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
							{{$other->links()}}
						</div>
						<div class="space40">&nbsp;</div>

					</div> <!-- .beta-products-list -->
				</div>
			</div> <!-- end section with sidebar and main content -->


		</div> <!-- .main-content -->
	</div> <!-- #content -->
</div> <!-- .container -->
@endsection