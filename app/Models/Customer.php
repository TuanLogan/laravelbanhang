<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "customer";
    public $fillable = ['name','gender', 'email','address','phone_number','note'];


    public function Bill(){
    	return $this->hasMany('App\Models\Bill','id_customer','id');
    }
}
