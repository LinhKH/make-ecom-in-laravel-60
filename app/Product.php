<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category() {
        return $this->belongsTo('App\Category','category_id')->select('id','category_name','parent_id');
    }

    public function section() {
        return $this->belongsTo('App\Section','section_id')->select('id','name');
    }

    public function brand() {
        return $this->belongsTo('App\Brand','brand_id')->select('id','name');
    }

    public function attributes() {
        return $this->hasMany('App\ProductsAttributes','product_id');
    }

    public function images() {
        return $this->hasMany('App\ProductImage','product_id');
    }
}
