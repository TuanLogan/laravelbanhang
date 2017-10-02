<?php 
namespace App\Repository;
use Log;
use App\Models\Slide;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
class SlideRepository{
	public static function GetAll(Request $rq){
		Log::info('BEGIN ' 
			. get_class() . ' => ' . __FUNCTION__ . '()');
		if($rq->input('keyword') != "" || $rq->input('pageSize') != "")
		{
			$keyword = $rq->input('keyword');
			$pageSize = $rq->input('pageSize');
			$slideList = Slide::where('alt','like',"%$keyword%")->paginate($pageSize)->withPath("?keyword=$keyword&pageSize=$pageSize");
			Log::info('END ' 
			. get_class() . ' => ' . __FUNCTION__ . '()');
			return $slideList;
		}
		else
		{
			Log::info('END ' 
			. get_class() . ' => ' . __FUNCTION__ . '()');
			$slideList = Slide::paginate(20);
			return $slideList;
		}
	}
	public static function save(Request $rq){
		Log::info('BEGIN ' 
			. get_class() . ' => ' . __FUNCTION__ . '()');
		DB::beginTransaction();
		try{
			if($rq->id == null){
				$model = new Slide();
			}
			else{
				$model = Slide::find($rq->id);

			}
			$model->fill($rq->all());
			if($rq->hasFile('image')){
				$fileName = uniqid() . "." . $rq->image->extension();
				$rq->image->storeAs('uploads', $fileName);
				$model->image = 'uploads/'.$fileName;
			}
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
	public static function Destroy($id){
		Log::info('BEGIN ' 
			. get_class() . ' => ' . __FUNCTION__ . '()');
		$model = Slide::find($id);
		if(!$model)
		{
			Log::info('END ' 
			. get_class() . ' => ' . __FUNCTION__ . '()');
			return false;
		}
		DB::beginTransaction();
		try{
			$model->delete();
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