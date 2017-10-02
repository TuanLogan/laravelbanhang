@extends('master')
@section('content')
<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="beta-products-list">
							<h4>Kết quả cho {{$keyword}}</h4>
							<div class="beta-products-details">
								<p class="pull-left">Có {{count($product)}} sản phẩm</p>
								<div class="clearfix"></div>
							</div>

							<div class="row">
								@foreach ($product as $element)
									<div class="col-sm-3">
									<div class="single-item">
									@if ($element->promotion_price != 0)
									<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
									@endif
										

										<div class="single-item-header">
											<a href="{{$element->getSlug()}}"><img class="thumbnail" src="{{asset($element->image)}}" alt="" height="250px"></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{$element->name}}</p>
											<p class="single-item-price">
											@if ($element->promotion_price == 0)
												<span class="flash-sale">{{$element->unit_price}}</span>
											@else											
												<span class="flash-del">{{$element->unit_price}}</span>
												<span class="flash-sale">{{$element->promotion_price}}</span>
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
						</div> 
					</div>
				</div> <!-- end section with sidebar and main content -->


			</div> <!-- .main-content -->
		</div> <!-- #content -->
@endsection