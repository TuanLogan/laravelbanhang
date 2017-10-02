<?php

namespace App\Http\Controllers\Admin;
use Log;
use Hash;
use App\User;
use App\Http\Requests\SaveProfileRequest;
use App\Http\Requests\SaveChangePasswordRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class ProfileController extends Controller
{
    public function update(){
    	Log::info("BEGIN " . get_class() . " => " . __FUNCTION__ ."()");
    	$user = Auth::user();
    	Log::info("END " . get_class() . " => " . __FUNCTION__ ."()");
    	return view('admin.profile.form', compact('user'));
    }
    public function save(SaveProfileRequest $rq){
    	Log::info("BEGIN " . get_class() . " => " . __FUNCTION__ ."()");
    	$model = User::find(Auth::user()->id);
    	$model->fill($rq->all());
    	if($rq->hasFile('image')){
			$fileName = uniqid() . "." . $rq->image->extension();
			$rq->image->storeAs('uploads', $fileName);
			$model->image = 'uploads/'.$fileName;
		}
		$model->save();
    	Log::info("END " . get_class() . " => " . __FUNCTION__ ."()");
    	return redirect(route('admin'));
    }
    public function changePwdForm(){
    	Log::info("BEGIN " . get_class() . " => " . __FUNCTION__ ."()");
    	Log::info("END " . get_class() . " => " . __FUNCTION__ ."()");
    	return view('admin.profile.change-pwd');
    }
    public function saveChangePwd(SaveChangePasswordRequest $rq){
    	Log::info("BEGIN " . get_class() . " => " . __FUNCTION__ ."()");
    	if(Hash::check($rq->oldPass, Auth::user()->password)){
    		$newPass = Hash::make($rq->newPass);
    		Auth::user()->password = $newPass;
    		Auth::logout();
    	Log::info("END " . get_class() . " => " . __FUNCTION__ ."()");
    		return redirect(route('login'));
    	}
    	Log::info("END " . get_class() . " => " . __FUNCTION__ ."()");
    	return redirect(route('password.change'))->with('errMsg', 'Invalid old password');
    }
}
