<?php

namespace App\Http\Controllers\Admin;
use Log;
use Illuminate\Http\Request;
use App\Http\Requests\SaveTypeRequest;
use App\Http\Controllers\Controller;
use App\Models\ProductType;
use App\Repository\ProductTypeRepository;
use DB;
use App\Models\Slug;
class ProductTypeController extends Controller
{
    public function index(Request $rq){
    	Log::info("BEGIN " . get_class() . " => " . __FUNCTION__ ."()");
    	$types = ProductTypeRepository::GetAll($rq);
    	$keyword = $rq->input('keyword');
        $ctlPageSize = $rq->input('pageSize');
        Log::info("END " . get_class() . " => " . __FUNCTION__ ."()");
        return view('admin.type.list', compact('types','keyword','ctlPageSize'));
    }
    public function remove($id){
    	Log::info("BEGIN " . get_class() . " => " . __FUNCTION__ ."()");
    	$result = ProductTypeRepository::Destroy($id);
    	Log::info("END " . get_class() . " => " . __FUNCTION__ ."()");
    	if($result){
    		return redirect(route('type.list'));
    	}else{
    		return 'not-found';
    	}
    }
    public function create(){
    	Log::info("BEGIN " . get_class() . " => " . __FUNCTION__ ."()");
    	$model = new ProductType();
        $modelSlug = new Slug();
        $modelSlug->entity_type = $model->entityType;
        $modelSlug->entity_id = $model->id;
    	Log::info("END " . get_class() . " => " . __FUNCTION__ ."()");
    	return view('admin.type.form', compact('model','modelSlug'));
    }
    public function save(SaveTypeRequest $rq){
    	Log::info("BEGIN " . get_class() . " => " . __FUNCTION__ ."()");
    	$result = ProductTypeRepository::Save($rq);
    	Log::info("END " . get_class() . " => " . __FUNCTION__ ."()");
    	if($result){
    		return redirect(route('type.list'));
    	}else
    	{
    		return 'not-found';
    	}
    }
    public function update($id){
    	Log::info("BEGIN " . get_class() . " => " . __FUNCTION__ ."()");
    	$model = ProductType::find($id);
        $modelSlug = Slug::where([
                        'entity_type' => $model->entityType,
                        'entity_id' => $model->id
                    ])->first();
        if(!$modelSlug){
            $modelSlug = new Slug();
            $modelSlug->entity_type = $model->entityType;
            $modelSlug->entity_id = $model->id;
        }
    	Log::info("END " . get_class() . " => " . __FUNCTION__ ."()");
    	return view('admin.type.form', compact('model','modelSlug'));
    }
}
