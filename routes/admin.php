<?php 
use App\Models\Product;
use App\Models\Slide;
use App\Models\Customer;
use App\Models\Bill;
use App\User;
use App\Models\Contact;
use App\Models\BillDetail;
use Illuminate\Http\Request;
Route::get('/check-url/{entityType}/{entityId}/{slug}', function($entityType, $entityId, $slug){
	$result = App\Models\Slug::checkSlugExisted($entityType,$entityId, $slug);
	return response()->json($result);
});
Route::get('/generate-slug/', function(Request $request){
	$slug = str_slug(trim($request->title), '-');
	$slug .= "-" . date('YmdHis', time());
	return response()->json(['data' => $slug]);
})->name('slug.generate');
Route::group(['middleware' => ['auth']], function(){
	Route::get('/dashboard', function(){
		$countProduct = Product::count();
		$countSlide = Slide::count();
		$countCustomer = Customer::count();
		$countRevenue = Bill::sum('total');
		$countProductSel = BillDetail::sum('quantity');
		$countContact = Contact::count();
		$countUser = User::count();
		return view('admin.dashboard',compact('countProduct','countSlide','countCustomer','countProductSel','countContact','countRevenue','countUser'));
	})->name('admin');
	Route::get('product', 'Admin\ProductController@index')->name('product.list');
	
	Route::get('type','Admin\ProductTypeController@index')->name('type.list');

	Route::get('slide','Admin\SlideController@index')->name('slide.list');

	Route::get('customers','Admin\CustomerController@index')->name('customer.list');

	Route::get('bill','Admin\BillController@index')->name('bill.list');

	Route::get('contact','Admin\ContactController@index')->name('contact.list');

	Route::get('user','Admin\UserController@index')->name('user.list');

	Route::group(['middleware' => 'check-mod'], function(){

		Route::get('product/create','Admin\ProductController@create')->name('product.create');

		Route::post('product/save','Admin\ProductController@save')->name('product.save');

		Route::get('product/update/{id}','Admin\ProductController@update')->name('product.update');

		Route::get('product/remove/{id}','Admin\ProductController@remove')->name('product.remove');


		Route::get('type/remove/{id}','Admin\ProductTypeController@remove')->name('type.remove');

		Route::get('type/create','Admin\ProductTypeController@create')->name('type.create');

		Route::post('type/save','Admin\ProductTypeController@save')->name('type.save');

		Route::get('type/update/{id}','Admin\ProductTypeController@update')->name('type.update');

		Route::get('slide/create','Admin\SlideController@create')->name('slide.create');

		Route::post('slide/save','Admin\SlideController@save')->name('slide.save');

		Route::get('slide/update/{id}','Admin\SlideController@update')->name('slide.update');

		Route::get('slide/remove/{id}','Admin\SlideController@remove')->name('slide.remove');

		Route::get('profile','Admin\ProfileController@update')->name('profile.form');

		Route::post('profile','Admin\ProfileController@save');

		Route::get('change-pass','Admin\ProfileController@changePwdForm')->name('password.change');

		Route::post('change-pass','Admin\ProfileController@saveChangePwd');

		Route::get('customer/remove/{id}','Admin\CustomerController@remove')->name('customer.remove');

		Route::get('customer/update/{id}','Admin\CustomerController@update')->name('customer.update');

		Route::post('customer/save','Admin\CustomerController@save')->name('customer.save');

		Route::get('customer/detail/{id}','Admin\CustomerController@detail')->name('customer.detail');

		Route::get('contact/remove/{id}','Admin\ContactController@remove')->name('contact.remove');

		Route::get('user/create','Admin\UserController@create')->name('user.create');

		Route::post('user/save','Admin\UserController@save')->name('user.save');

		Route::get('user/remove/{id}','Admin\UserController@remove')->name('user.remove');
	});

});
Route::get('/login', function(){
	return view('admin.auth.login');
})->name('login');

Route::post('/login','Auth\LoginController@login');

Route::get('/logout',function(){
	Auth::logout();
	return redirect(route('login'));
})->name('logout');
 ?>