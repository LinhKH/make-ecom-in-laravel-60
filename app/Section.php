<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public static function sections() {
        $getSections = Section::with('categories')->where('status',1)->get();
        $getSections = json_decode(json_encode($getSections),1);
        // echo "<pre>"; print_r($getSections);die;
        return $getSections;
    }

    public function categories() {
        return $this->hasMany('App\Category','section_id')->where(['parent_id' => 0, 'status' => 1])->with('subcategories');
    }
}
