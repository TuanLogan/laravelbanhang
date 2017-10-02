<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Slug;
class ProductType extends Model
{
    protected $table = "type_products";
    public $entityType = ENTITY_TYPE_TYPE;
    public $fillable = ['name', 'description'];

    public function Product(){
    	return $this->hasMany('App\Models\Product','id_type', 'id');
    }
    public function getProduct($limit){
    	$products = Product::where('id_type',$this->id)->limit($limit)->get();
    	return $products;
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
