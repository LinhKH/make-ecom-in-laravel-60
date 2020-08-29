<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index() {
        $page_name = "index";

        $featuredItems = Product::where('is_featured','Yes')->get()->toArray();
        $featuredItemsChunk = array_chunk($featuredItems,4);

        return view('front.index')->with(compact('page_name','featuredItemsChunk'));
    }
}
