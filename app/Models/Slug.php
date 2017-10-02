<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slug extends Model
{
    protected $table = 'slugs';

    public static function checkSlugExisted($entityType, $entityId, $slugUrl){
    	$model = Slug::where('slug', $slugUrl)->first();
    	if(!$model){
    		return false;
    	}
    	if($model->entity_type == $entityType && $model->entity_id ==$entityId){
    		return false;
    	}
    	return true;
    }
}
