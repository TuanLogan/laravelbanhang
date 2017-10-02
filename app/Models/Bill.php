<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = "bills";

    public function BillDetail(){
    	return $this->belongTo('App\Models\BillDetail','id_bill','id');
    }

    public function Customer(){
    	return $this->belongTo('App\Models\Customer','id_customer','id');
    }
}
