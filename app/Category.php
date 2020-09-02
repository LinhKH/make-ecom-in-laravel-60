<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function subcategories() {
        return $this->hasMany('App\Category','parent_id')->where('status',1);
    }

    public function section() {
        return $this->belongsTo('App\Section','section_id')->select(['id','name']);
    }

    public function parentcategory() {
        return $this->belongsTo('App\Category','parent_id')->select('id','category_name');
    }

    public static function categorysDetail($url) {

        /** case 1 */
        // $categoryDetails = Category::with('subcategories.parentcategory')->select('id','category_name','url')->where('url',$url)->firstOrFail();

        /** case 2 */
        $categoryDetails = Category::select('id','category_name','url')->with(['subcategories' => function($query) {
            $query->select('id','parent_id')->where('status',1);
        }])->where('url',$url)->first()->toArray();

        $catIds = [];
        $catIds[] = $categoryDetails['id'];
        foreach ($categoryDetails['subcategories'] as $key => $subcat) {
            $catIds[] = $subcat['id'];
        }

        return ['catIds' => $catIds, 'cat_details' => $categoryDetails];
    }
}