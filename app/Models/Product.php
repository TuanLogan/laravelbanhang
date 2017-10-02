<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Slug;
class Product extends Model
{
    protected $table = "products";
    public $entityType = ENTITY_TYPE_PRODUCT;
    public $fillable = ['name','id_type', 'description','unit_price','promotion_price','unit'];

    public function ProductType(){
    	return $this->belongsTo('App\Models\ProductType', 'id_type');
    }
    public function BillDetail(){
    	return $this->hasMany('App\Models\BillDetail', 'id_product', 'id');
    }
    public function getSlug(){
    	$slug = Slug::where([
    		'entity_type' => $this->entityType,
    		"entity_id" => $this->id
    	])->first();
    	if($slug){
    		return $slug->slug;
    	}else{
    		return null;
    	}
    }

}
