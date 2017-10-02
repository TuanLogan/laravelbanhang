<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Log;
use DB;
use App\Repository\ContactRepository;
use App\Models\Contact;
class ContactController extends Controller
{
    public function index(Request $rq){
    	Log::info("BEGIN " . get_class() . " => " . __FUNCTION__ ."()");
    	$contacts = ContactRepository::GetAll($rq);
    	$keyword = $rq->input('keyword');
    	$ctlPageSize = $rq->input('pageSize');
    	Log::info("END " . get_class() . " => " . __FUNCTION__ ."()");
    	return view('admin.contact.list', compact('contacts', 'keyword','ctlPageSize'));
    }
    public function remove($id){
        Log::info("BEGIN " . get_class() . " => " . __FUNCTION__ ."()");
        $result = ContactRepository::Destroy($id);
        Log::info("END " . get_class() . " => " . __FUNCTION__ ."()");
        if($result){
            return redirect(route('contact.list'));
        }else{
            return 'Error';
        }
    }
}
