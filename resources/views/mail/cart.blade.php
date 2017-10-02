<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Thông tin đơn hàng</title>
	<link rel="stylesheet" href="">
</head>
<body>
	<div>
		<h4>Chào {{$customer->name}}, cám ơn đã đặt hàng, đây là thông tin của bạn, chúng tôi sẽ liên hệ trước khi giao hàng</h4>
	</div>
	<table>
		<thead>
			<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Address</th>
			</tr>
		</thead>
		<tbody>
				<tr>
					<td>{{$customer->name}}</td>
					<td>{{$customer->email}}</td>
					<td>{{$customer->phone_number}}</td>
					<td>{{$customer->address}}</td>
				</tr>
		</tbody>
	</table>
	<table>
		<thead>
			<tr>
				<th>Total</th>
				<th>Payment</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>{{$bill->total}}</td>
				<td>{{$bill->payment}}</td>
			</tr>
		</tbody>
	</table>
</body>
</html>