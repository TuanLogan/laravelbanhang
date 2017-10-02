<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repository\UserRepository;
use App\User;
use App\Http\Requests\SaveUserRequest;
use App\Models\Role;
use Log;
use DB;
use Auth;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(Request $rq){
    	Log::info("BEGIN " . get_class() . " => " . __FUNCTION__ ."()");
    	$users = UserRepository::GetAll($rq);
    	$keyword = $rq->input('keyword');
    	$ctlPageSize = $rq->input('pageSize');
    	Log::info("END " . get_class() . " => " . __FUNCTION__ ."()");
    	return view('admin.user.list', compact('users', 'keyword','ctlPageSize'));
    }
    public function create(){
    	Log::info("BEGIN " . get_class() . " => " . __FUNCTION__ ."()");
    	$model = new User();
    	$listRole = Role::all();
        Log::info("END " . get_class() . " => " . __FUNCTION__ ."()");
        return view('admin.user.form', compact('model', 'listRole'));
    }
    public function save(SaveUserRequest $rq){
        Log::info("BEGIN " . get_class() . " => " . __FUNCTION__ ."()");
        $result = UserRepository::save($rq);
        Log::info("END " . get_class() . " => " . __FUNCTION__ ."()");
        if($result){
            return redirect(route('user.list'));
        }else{
            return 'Error';
        }
    }
    public function remove($id){
        Log::info("BEGIN " . get_class() . " => " . __FUNCTION__ ."()");
        $result = UserRepository::Destroy($id);
        Log::info("END " . get_class() . " => " . __FUNCTION__ ."()");
        if($result){
            return redirect(route('user.list'));
        }else{
            return 'Error';
        }
    }
}
