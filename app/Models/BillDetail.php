<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    protected $table = "bill_detail";

    public function Product(){
    	return $this->belongTo('App\Models\Product','id_product','id');
    }

    public function Bill(){
    	return $this->belongTo('App\Models\Bill','id_bill','id');
    }
}
