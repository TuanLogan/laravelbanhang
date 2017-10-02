@extends('master')
@section('title', 'Đặt hàng')
@section('content')	
<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Đặt hàng</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb">
					<a href="{{route('trang-chu')}}">Trang chủ</a> / <span>Đặt hàng</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
</div>
	
<div class="container">
		<div id="content">
			@if (Session::has('cart'))
				<form action="{{route('xulidathang')}}" method="post" class="beta-form-checkout">
				{{csrf_field()}}
					<div class="row">
						<div class="col-sm-6">
							<h4>Đặt hàng</h4>
							<div class="space20">&nbsp;</div>

							<div class="form-block">
								<label for="name">Họ tên*</label>
								<input type="text" id="name" name="name" placeholder="Họ tên" required>
							</div>
							<div class="form-block">
								<label>Giới tính </label>
								<input id="gender" type="radio" class="input-radio" name="gender" value="nam" checked="checked" style="width: 10%"><span style="margin-right: 10%">Nam</span>
								<input id="gender" type="radio" class="input-radio" name="gender" value="nữ" style="width: 10%"><span>Nữ</span>
											
							</div>

							<div class="form-block">
								<label for="email">Email*</label>
								<input type="email" id="email" name="email" required placeholder="expample@gmail.com">
							</div>

							<div class="form-block">
								<label for="adress">Địa chỉ*</label>
								<input type="text" id="adress" name="address" placeholder="Street Address" required>
							</div>
							

							<div class="form-block">
								<label for="phone">Điện thoại*</label>
								<input type="text" id="phone" name="phone" required>
							</div>
							
							<div class="form-block">
								<label for="notes">Ghi chú</label>
								<textarea id="notes" name="notes"></textarea>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="your-order">
								<div class="your-order-head"><h5>Đơn hàng của bạn</h5></div>
								<div class="your-order-body" style="padding: 0px 10px">
									<div class="your-order-item">
										<div>
										@foreach ($product_cart as $p)
											<!--  one item	 -->
											<div class="media">
												<img width="25%" src="{{asset($p['item']['image'])}}" alt="" class="pull-left">
												<div class="media-body">
													<p class="font-large">{{$p['item']['name']}}</p>
													{{-- <span class="color-gray your-order-info">Color: Red</span> --}}
													<span class="color-gray your-order-info">Giá: 
													@if ($p['item']['promotion_price'] == 0)
													{{$p['item']['unit_price']}}
													@else
													{{$p['item']['promotion_price']}}
													@endif
													</span>
													<span class="color-gray your-order-info">Qty: {{$p['qty']}}</span>
												</div>
											</div>
										<!-- end one item -->
										@endforeach
										
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="your-order-item">
										<div class="pull-left"><p class="your-order-f18">Tổng tiền:</p></div>
										<div class="pull-right"><h5 class="color-black">{{Session('cart')->totalPrice}}  đồng</h5></div>
										<div class="clearfix"></div>
									</div>
								</div>
								<div class="your-order-head"><h5>Hình thức thanh toán</h5></div>
								
								<div class="your-order-body">
									<ul class="payment_methods methods">
										<li class="payment_method_bacs">
											<input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="COD" checked="checked" data-order_button_text="">
											<label for="payment_method_bacs">Thanh toán khi nhận hàng </label>
											<div class="payment_box payment_method_bacs" style="display: block;">
												Cửa hàng sẽ gửi hàng đến địa chỉ của bạn, bạn xem hàng rồi thanh toán tiền cho nhân viên giao hàng.
											</div>						
										</li>

										<li class="payment_method_cheque">
											<input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="ATM" data-order_button_text="">
											<label for="payment_method_cheque">Chuyển khoản </label>
											<div class="payment_box payment_method_cheque" style="display: none;">
												Chuyển tiền đến tài khoản sau:
												<br>- Số tài khoản: 123 456 789
												<br>- Chủ TK: Nguyễn Anh Tuấn
												<br>- Ngân hàng Vietcombank, chi nhánh Hà Nội
											</div>						
										</li>
										
									</ul>
								</div>

								<div class="text-center">
									<button type="submit" class="btn btn-success">Đặt hàng</button>
									
								</div>
							</div> <!-- .your-order -->
						</div>
					</div>
				</form>
			@else
			<h1>404 forbidden</h1>
			 <a href="{{route('trang-chu')}}" title="">Trở lại</a>
			@endif
			
		</div> <!-- #content -->
</div> <!-- .container -->
@endsection