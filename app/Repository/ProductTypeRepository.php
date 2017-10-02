<?php 
namespace App\Repository;
use Log;
use App\Models\ProductType;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class ProductTypeRepository
{
	public static function GetAll(Request $rq){
		Log::info('BEGIN ' 
			. get_class() . ' => ' . __FUNCTION__ . '()');
		if($rq->input('keyword') != "" || $rq->input('pageSize') != "")
		{
			$keyword = $rq->input('keyword');
			$pageSize = $rq->input('pageSize');
			$typeList = ProductType::where('name','like',"%$keyword%")->paginate($pageSize)->withPath("?keyword=$keyword&pageSize=$pageSize");
			Log::info('END ' 
			. get_class() . ' => ' . __FUNCTION__ . '()');
			return $typeList;
		}
		else
		{
			Log::info('END ' 
			. get_class() . ' => ' . __FUNCTION__ . '()');
			$typeList = ProductType::paginate(20);
			return $typeList;
		}
	}
	public static function Destroy($id){
		Log::info('BEGIN ' 
			. get_class() . ' => ' . __FUNCTION__ . '()');
		$model = ProductType::find($id);
		if(!$model){
			Log::info('END ' 
			. get_class() . ' => ' . __FUNCTION__ . '()');
			return false;
		}
		$product = Product::where('id_type',$model->id);
		DB::beginTransaction();
		try{
			$model->delete();
			$product->delete();
			DB::commit();
			Log::info('END ' 
			. get_class() . ' => ' . __FUNCTION__ . '()');
			return true;
		}catch(\Exception $ex)
		{
			Log::error('END ' 
			. get_class() . ' => ' . __FUNCTION__ . '() - ' . $ex->getMessage());
			DB::rollback();
			return false;
		}
	}
	public static function Save(Request $rq){
		Log::info('BEGIN ' 
			. get_class() . ' => ' . __FUNCTION__ . '()');
		DB::beginTransaction();
		try
		{
			if($rq->id == null)
			{
				$model = new ProductType();
			}
			else
			{
				$model = ProductType::find($rq->id);
			}
			$model->fill($rq->all());
			if($rq->hasFile('image')){
				$fileName = uniqid() . "." . $rq->image->extension();
				$rq->image->storeAs('uploads', $fileName);
				$model->image = 'uploads/'.$fileName;
			}
			$model->save();
			DB::table('slugs')->where([
                    ['entity_id', '=', $model->id],
                    ['entity_type', '=', $model->entityType]
                ])->delete();

	        DB::table('slugs')->insert(
	        	[
	        		'entity_type' => $model->entityType,
	        		'entity_id' => $model->id,
	        		'slug' => $rq->slug
	        	]
        	);
			DB::commit();
			Log::info('END ' 
			. get_class() . ' => ' . __FUNCTION__ . '()');
			return true;
		}catch(\Exception $ex){
			Log::error('END ' 
			. get_class() . ' => ' . __FUNCTION__ . '() - ' . $ex->getMessage());
			dd($ex->getMessage());
			return false;
		}
	}

} 

 ?>