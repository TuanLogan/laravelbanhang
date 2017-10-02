@extends('master')
@section('title', "Barker's Allay Cake" )
@section('content')
<div class="fullwidthbanner-container">
					<div class="fullwidthbanner">
						<div class="bannercontainer" >
					    <div class="banner" >
								<ul>
								@foreach ($slide as $element)
									<li data-transition="boxfade" data-slotamount="20" class="active-revslide" style="width: 100%; height: 100%; overflow: hidden; z-index: 18; visibility: hidden; opacity: 0;">
							            <div class="slotholder" style="width:100%;height:100%;" data-duration="undefined" data-zoomstart="undefined" data-zoomend="undefined" data-rotationstart="undefined" data-rotationend="undefined" data-ease="undefined" data-bgpositionend="undefined" data-bgposition="undefined" data-kenburns="undefined" data-easeme="undefined" data-bgfit="undefined" data-bgfitend="undefined" data-owidth="undefined" data-oheight="undefined">
											<div class="tp-bgimg defaultimg" data-lazyload="undefined" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat" data-lazydone="undefined" src="{{asset($element->image)}}" data-src="{{asset($element->image)}}" style="background-color: rgba(0, 0, 0, 0); background-repeat: no-repeat; background-image: url('{{asset($element->image)}}'); background-size: cover; background-position: center center; width: 100%; height: 100%; opacity: 1; visibility: inherit;">
											</div>
										</div>
						        	</li>
								@endforeach
										
								</ul>
							</div>
						</div>

						<div class="tp-bannertimer"></div>
					</div>
				</div>
				<!--slider-->
	</div>
	<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-12">
						@foreach ($types as $t)
						<div class="beta-products-list">
							<h4><a href="{{$t->getSlug()}}" title="">{{$t->name}}</a></h4>
							<div class="beta-products-details">
								<p class="pull-left">{!!$t->description!!}</p>
								<div class="clearfix"></div>
							</div>

							<div class="row">
								@foreach ($t->getProduct(4) as $element)
									<div class="col-sm-3">
									<div class="single-item">
									@if ($element->promotion_price != 0)
									<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
									@endif
										

										<div class="single-item-header">
											<a href="{{$element->getSlug()}}"><img class="thumbnail" src="{{asset($element->image)}}" alt="" height="250px"></a>
										</div>
										<div class="single-item-body">
											<h4 class="single-item-title">{{$element->name}}</h4>
											<p class="single-item-price">
											@if ($element->promotion_price == 0)
												<span class="flash-sale">{{$element->unit_price}} $</span>
											@else											
												<span class="flash-del">{{$element->unit_price}} $</span>
												<span class="flash-sale">{{$element->promotion_price}} $</span>
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
								<div class="space50">&nbsp;</div>
								{{-- <div class="row">
									{{$new_product->links()}}
								</div> --}}
								
							</div>
						</div> <!-- .beta-products-list -->
							{{-- expr --}}
						@endforeach

						<div class="space50">&nbsp;</div>

						<div class="beta-products-list">
							<h4>Sẩn phẩm khuyến mãi</h4>
							<div class="beta-products-details">
								<p class="pull-left">Có {{count($khuyenmai_total)}} sản phẩm</p>
								<div class="clearfix"></div>
							</div>
							<div class="row">
							@foreach ($khuyenmai as $element)
								<div class="col-sm-3">
									<div class="single-item">
										<div class="single-item-header">
											<a href="{{$element->getSlug()}}"><img src="{{asset($element->image)}}" alt="" height="250px></a>
										</div>
										<div class="single-item-body">
											<h4 class="single-item-title">{{$element->name}}</h4>
											<p class="single-item-price">
												<span class="flash-del">{{$element->unit_price}} $</span>
												<span class="flash-sale">{{$element->promotion_price}} $</span>
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
							<div class="row">
							{{$khuyenmai->links()}}
								
							</div>
							</div>
							<div class="space40">&nbsp;</div>
						</div> <!-- .beta-products-list -->
					</div>
				</div> <!-- end section with sidebar and main content -->


			</div> <!-- .main-content -->
		</div> <!-- #content -->
@endsection