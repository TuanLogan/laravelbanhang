<?php 
namespace App\Repository;
use Log;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Bill;
use App\Models\BillDetail;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
class CustomerRepository
{
	public static function GetAll(Request $rq){
		Log::info('BEGIN ' 
			. get_class() . ' => ' . __FUNCTION__ . '()');
		if($rq->input('keyword') != "" || $rq->input('pageSize') != ""){
			$keyword = $rq->input('keyword');
			$pageSize = $rq->input('pageSize');
			$customerList = Customer::where('name','like', "%$keyword%")->paginate($pageSize)->withPath("?keyword=$keyword&pageSize=$pageSize");
			Log::info('END ' 
			. get_class() . ' => ' . __FUNCTION__ . '()');
			return $customerList;
		}else{
			Log::info('END ' 
			. get_class() . ' => ' . __FUNCTION__ . '()');
			$customerList = Customer::paginate(20);
			return $customerList;
		}
	}
	public static function Destroy($id){
		Log::info('BEGIN ' 
			. get_class() . ' => ' . __FUNCTION__ . '()');
		$model = Customer::find($id);
		$bill = Bill::where('id_customer',"$model->id")->firstorFail();
		$detail = BillDetail::where('id_bill',"$bill->id");
		if(!$model)
		{
			Log::info('END ' 
			. get_class() . ' => ' . __FUNCTION__ . '()');
			return false;
		}
		DB::beginTransaction();
		try{
			$model->delete();
			$bill->delete();
			$detail->delete();
			DB::commit();
			Log::info('END ' 
				. get_class() . ' => ' . __FUNCTION__ . '()');
			return true;
		}catch(\Exception $ex){
			Log::error('END ' 
			. get_class() . ' => ' . __FUNCTION__ . '() - ' . $ex->getMessage());
			DB::rollback();
			return false;
		}

	}
	public static function save(Request $rq){
		Log::info('BEGIN ' 
			. get_class() . ' => ' . __FUNCTION__ . '()');
		DB::beginTransaction();
		try{
			if($rq->id == null){
				return false;
			}
			else{
				$model = Customer::find($rq->id);

			}
			$model->fill($rq->all());
			$model->save();
			DB::commit();
			Log::info('END ' 
			. get_class() . ' => ' . __FUNCTION__ . '()');
	        return true;
		}catch(\Exception $ex){
			Log::error('END ' 
			. get_class() . ' => ' . __FUNCTION__ . '() - ' . $ex->getMessage());
			DB::rollback();
			return false;
		}
	}
	
}
?>
