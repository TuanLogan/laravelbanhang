<div id="header">
		<div class="header-top">
			<div class="container">
				<div class="pull-left auto-width-left">
					<ul class="top-menu menu-beta l-inline">
						<li><a href=""><i class="fa fa-home"></i> Quan Hoa - Cầu Giấy - Hà Nội</a></li>
						<li><a href=""><i class="fa fa-phone"></i> 0987562329</a></li>
					</ul>
				</div>
				<div class="pull-right auto-width-right">
					<ul class="top-details menu-beta l-inline">
						{{-- <li><a href="#"><i class="fa fa-user"></i>Tài khoản</a></li> --}}
						<li><a href="{{route('page.signup')}}">Đăng kí</a></li>
						{{-- <li><a href="{{route('page.login')}}">Đăng nhập</a></li> --}}
					</ul>
				</div>
				<div class="clearfix"></div>
			</div> <!-- .container -->
		</div> <!-- .header-top -->
		<div class="header-body">
			<div class="container beta-relative">
				<div class="pull-left">
					<a href="index.html" id="logo"><img src="{{asset('images/logo-cake.png')}}" width="200px" alt=""></a>
				</div>
				<div class="pull-right beta-components space-left ov">
					<div class="space10">&nbsp;</div>
					<div class="beta-comp">
						<form role="search" method="get" id="searchform" action="{{route('search')}}">
					        <input type="text" value="" name="key" id="key" placeholder="Nhập từ khóa..." />
					        <button class="fa fa-search" type="submit" id="searchsubmit"></button>
						</form>
					</div>

					<div class="beta-comp">
					@if (Session::has('cart'))
						<div class="cart">
							<div class="beta-select"><i class="fa fa-shopping-cart"></i> Giỏ hàng (
							@if (Session::has('cart'))
								{{Session('cart')->totalQty}}
							@else
								Trống
							@endif
							
							) <i class="fa fa-chevron-down"></i></div>
							<div class="beta-dropdown cart-body">
							
							@foreach ($product_cart as $p)
								<div class="cart-item">
									<a class="cart-item-delete" href="{{route('xoagiohang', $p['item']['id'])}}" title=""><i class="fa fa-times"></i></a>
									<div class="media">
										<a class="pull-left" href="#"><img src="{{asset('image/product/'.$p['item']['image'])}}" alt=""></a>
										<div class="media-body">
											<span class="cart-item-title">{{$p['item']['name']}}</span>
											<span class="cart-item-amount">{{$p['qty']}}*<span>
											@if ($p['item']['promotion_price'] == 0)
												{{$p['item']['unit_price']}}
											@else
												{{$p['item']['promotion_price']}}
											@endif</span></span>
										</div>
									</div>
								</div>
							@endforeach
								
							
								

								

								<div class="cart-caption">
									<div class="cart-total text-right">Tổng tiền: <span class="cart-total-value">{{Session('cart')->totalPrice}}</span></div>
									<div class="clearfix"></div>

									<div class="center">
										<div class="space10">&nbsp;</div>
										<a href="{{route('dathang')}}" class="beta-btn primary text-center">Đặt hàng <i class="fa fa-chevron-right"></i></a>
									</div>
								</div>
							</div>
						</div> <!-- .cart -->
					@endif
					</div>
				</div>
				<div class="clearfix"></div>
			</div> <!-- .container -->
		</div> <!-- .header-body -->
		<div class="header-bottom" style="background-color: #0277b8;">
			<div class="container">
				<a class="visible-xs beta-menu-toggle pull-right" href="#"><span class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i></a>
				<div class="visible-xs clearfix"></div>
				<nav class="main-menu">
					<ul class="l-inline ov">
						<li><a href="{{route('trang-chu')}}">Trang chủ</a></li>
						<li><a href="#">Danh Sách Sản phẩm</a>
							<ul class="sub-menu">
							@foreach ($loaisp as $element)
								<li><a href="{{$element->getSlug()}}">{{$element->name}}</a></li>
							@endforeach
								
								
							</ul>
						</li>
						<li><a href="{{route('gioithieu')}}">Giới thiệu</a></li>
						<li><a href="{{route('lienhe')}}">Liên hệ</a></li>
					</ul>
					<div class="clearfix"></div>
				</nav>
			</div> <!-- .container -->
		</div> <!-- .header-bottom -->
	</div>