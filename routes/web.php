<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Mail;
use App\Models\Customer;
use App\Models\Bill;
Route::get('/index', 'PageController@getIndex' )->name('trang-chu');

// Route::get('loai-san-pham/{type}','PageController@getLoaiSp')->name('loaisanpham');

Route::get('/{slug}','PageController@getContent')->name('getContent');

// Route::get('chi-tiet-san-pham/{id}','PageController@getChitiet')->name('chitietsanpham');

Route::get('/lienhe/tous','PageController@getLienhe')->name('lienhe');

Route::get('about/us','PageController@getGioithieu')->name('gioithieu');

Route::get('add-to-cart/{id}','PageController@getAddtoCart')->name('themgiohang');

Route::get('del-cart/{id}', 'PageController@getDelItemCart')->name('xoagiohang');

Route::get('confirm/product', 'PageController@getCheckout')->name('dathang');

Route::post('dat-hang', 'PageController@postCheckout')->name('xulidathang');

Route::post('contact', 'PageController@Contact')->name('contact');
Route::get('/430-forbidden', function(){
	return view('forbidden');
})->name('403.error');
// Route::get('/dang_nhap', function(){
// 	return view('page.login');
// })->name('page.login');
Route::get('/signup/add', function(){
	return view('page.signup');
})->name('page.signup');
Route::post('signup', 'PageController@Signup');
Route::get('/search/key','PageController@Search')->name('search');

Route::get('send/{customer}/{bill}', function($customer, $bill){
	$cus = Customer::find($customer);
	$bi = Customer::find($bill);
	Mail::send('mail.cart', ['customer' => $cus, 'bill' => $bi], function ($message) use ($cus){
		$message->to($cus->email,$cus->name);
	});
	return view('page.trangchu');
})->name('send.mail');