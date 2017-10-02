<?php 
namespace App\Repository;
use Log;
use Illuminate\Http\Request;
use DB;
use Hash;
use App\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\Auth;
class UserRepository
{
	public static function GetAll(Request $rq){
		Log::info('BEGIN ' 
			. get_class() . ' => ' . __FUNCTION__ . '()');
		if($rq->input('keyword') != "" || $rq->input('pageSize') != ""){
			$keyword = $rq->input('keyword');
			$pageSize = $rq->input('pageSize');
			$userList = User::where('full_name','like', "%$keyword%")->where('id','<>',Auth::user()->id)->paginate($pageSize)->withPath("?keyword=$keyword&pageSize=$pageSize");
			Log::info('END ' 
			. get_class() . ' => ' . __FUNCTION__ . '()');
			return $userList;
		}else{
			Log::info('END ' 
			. get_class() . ' => ' . __FUNCTION__ . '()');
			$userList = User::where('id','<>',Auth::user()->id)->paginate(20);
			return $userList;
		}
	}
	public static function Save(Request $rq){
		Log::info('BEGIN ' 
			. get_class() . ' => ' . __FUNCTION__ . '()');
		DB::beginTransaction();
		try{
			if($rq->id == null){
				$model = new User();
			}
			else{
				$model = User::find($rq->id);

			}
			$model->fill($rq->all());
			$model->password = Hash::make($rq->password);
			if($rq->hasFile('image')){
				$fileName = uniqid() . "." . $rq->image->extension();
				$rq->image->storeAs('uploads', $fileName);
				$model->image = 'uploads/'.$fileName;
			}
			$model->save();
			DB::table('user_role_xref')->insert(
	        	[
	        		'user_id' => $model->id,
	        		'role_id' => $rq->role_name
	        	]
        	);
			
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
		$model = User::find($id);
		if(!$model)
		{
			Log::info('END ' 
			. get_class() . ' => ' . __FUNCTION__ . '()');
			return false;
		}
		DB::beginTransaction();
		try{
			$role = UserRole::where('user_id',$id);
			$role->delete();
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