<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\SaveProductRequest;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Slug;
use Log;
use App\Repository\ProductRepository;

class ProductController extends Controller
{
    public function index(Request $rq){
    	Log::info("BEGIN " . get_class() . " => " . __FUNCTION__ ."()");
    	$products = ProductRepository::GetAll($rq);
    	$keyword = $rq->input('keyword');
    	$ctlPageSize = $rq->input('pageSize');
    	Log::info("END " . get_class() . " => " . __FUNCTION__ ."()");
    	return view('admin.product.list', compact('products', 'keyword','ctlPageSize'));
    }
    public function create(){
    	Log::info("BEGIN " . get_class() . " => " . __FUNCTION__ ."()");
    	$model = new Product();
        $modelSlug = new Slug();
        $modelSlug->entity_type = $model->entityType;
        $modelSlug->entity_id = $model->id;
    	$listType = ProductType::all();
        Log::info("END " . get_class() . " => " . __FUNCTION__ ."()");
        return view('admin.product.form', compact('model', 'listType','modelSlug'));
    }
    public function save(SaveProductRequest $rq){
        Log::info("BEGIN " . get_class() . " => " . __FUNCTION__ ."()");
        $result = ProductRepository::save($rq);
        Log::info("END " . get_class() . " => " . __FUNCTION__ ."()");
        if($result){
            return redirect(route('product.list'));
        }else{
            return 'Error';
        }
    }
    public function update($id){
        Log::info("BEGIN " . get_class() . " => " . __FUNCTION__ ."()");
        $model = Product::find($id);
        $modelSlug = Slug::where([
                        'entity_type' => $model->entityType,
                        'entity_id' => $model->id
                    ])->first();
        if(!$modelSlug){
            $modelSlug = new Slug();
            $modelSlug->entity_type = $model->entityType;
            $modelSlug->entity_id = $model->id;
        }
        $listType = ProductType::all();
        Log::info("END " . get_class() . " => " . __FUNCTION__ ."()");
        return view('admin.product.form', compact('model','listType','modelSlug'));
    }
    public function remove($id){
        Log::info("BEGIN " . get_class() . " => " . __FUNCTION__ ."()");
        $result = ProductRepository::Destroy($id);
        Log::info("END " . get_class() . " => " . __FUNCTION__ ."()");
        if($result){
            return redirect(route('product.list'));
        }else{
            return 'Error';
        }
    }
}
