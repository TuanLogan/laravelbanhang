<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\SaveSlideRequest;
use App\Http\Controllers\Controller;
use Log;
use App\Models\Slide;
use App\Repository\SlideRepository;
class SlideController extends Controller
{
    public function index(Request $rq){
    	Log::info("BEGIN " . get_class() . " => " . __FUNCTION__ ."()");
    	$slides = SlideRepository::GetAll($rq);
    	$keyword = $rq->input('keyword');
    	$ctlPageSize = $rq->input('pageSize');
    	Log::info("END " . get_class() . " => " . __FUNCTION__ ."()");
    	return view('admin.slide.list', compact('slides', 'keyword','ctlPageSize'));
    }
    public function create(){
    	Log::info("BEGIN " . get_class() . " => " . __FUNCTION__ ."()");
    	$model = new Slide();
        Log::info("END " . get_class() . " => " . __FUNCTION__ ."()");
        return view('admin.slide.form', compact('model'));
    }
    public function save(SaveSlideRequest $rq){
    	Log::info("BEGIN " . get_class() . " => " . __FUNCTION__ ."()");
        $result = SlideRepository::save($rq);
        Log::info("END " . get_class() . " => " . __FUNCTION__ ."()");
        if($result){
            return redirect(route('slide.list'));
        }else{
            return 'Error';
        }
    }
    public function update($id){
        Log::info("BEGIN " . get_class() . " => " . __FUNCTION__ ."()");
        $model = Slide::find($id);
        Log::info("END " . get_class() . " => " . __FUNCTION__ ."()");
        return view('admin.slide.form', compact('model'));
    }
    public function remove($id){
        Log::info("BEGIN " . get_class() . " => " . __FUNCTION__ ."()");
        $result = SlideRepository::Destroy($id);
        Log::info("END " . get_class() . " => " . __FUNCTION__ ."()");
        if($result){
            return redirect(route('slide.list'));
        }else{
            return 'Error';
        }
    }
}
