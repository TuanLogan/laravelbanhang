<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\SaveCustomerRequest;
use App\Http\Controllers\Controller;
use Log;
use App\Models\Customer;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Product;
use App\Repository\CustomerRepository;
class CustomerController extends Controller
{
    public function index(Request $rq){
    	Log::info("BEGIN " . get_class() . " => " . __FUNCTION__ ."()");
    	$customers = CustomerRepository::GetAll($rq);
    	$keyword = $rq->input('keyword');
    	$ctlPageSize = $rq->input('pageSize');
    	Log::info("END " . get_class() . " => " . __FUNCTION__ ."()");
    	return view('admin.customer.list', compact('customers', 'keyword','ctlPageSize'));
    }
    public function remove($id){
    	Log::info("BEGIN " . get_class() . " => " . __FUNCTION__ ."()");
    	$result = CustomerRepository::Destroy($id);
    	Log::info("END " . get_class() . " => " . __FUNCTION__ ."()");
    	if($result){
            return redirect(route('customer.list'));
        }else{
            return 'Error';
        }
    }
    public function update($id){
    	Log::info("BEGIN " . get_class() . " => " . __FUNCTION__ ."()");
    	$model = Customer::find($id);
    	Log::info("END " . get_class() . " => " . __FUNCTION__ ."()");
    	return view('admin.customer.form', compact('model'));
    }
    public function save(SaveCustomerRequest $rq){
    	Log::info("BEGIN " . get_class() . " => " . __FUNCTION__ ."()");
        $result = CustomerRepository::save($rq);
        Log::info("END " . get_class() . " => " . __FUNCTION__ ."()");
        if($result){
            return redirect(route('customer.list'));
        }else{
            return 'Error';
        }
    }
    public function detail($id){
    	Log::info('BEGIN ' 
			. get_class() . ' => ' . __FUNCTION__ . '()');
		$bills = Bill::where('id_customer', $id)->get();
		$bill = $bills['0'];
		if(!$bills){
			return 'Error';
		}
		$info = BillDetail::where('id_bill', $bill->id)->get();
		foreach ($info as $value) {
			$id_product[] = $value->id_product;
		}
		foreach ($id_product as $value) {
			$product[] = Product::where('id', $id_product)->first();
		}
		Log::info('END ' 
			. get_class() . ' => ' . __FUNCTION__ . '()');
		return view('admin.bill.list', compact('bills', 'info','product'));
    }
}
