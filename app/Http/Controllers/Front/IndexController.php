<?php

namespace App\Http\Controllers\Front;

use App\Banner;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index() {
        $page_name = "index";

        $featuredItemsCount = Product::where('is_featured','Yes')->count();
        $featuredItems = Product::where('is_featured','Yes')->get()->toArray();
        $featuredItemsChunk = array_chunk($featuredItems,4);
        // dd($featuredItemsChunk);

        // Get Lastest Products
        $lastestProducts = Product::orderBy('id','desc')->limit(6)->get()->toArray();

        return view('front.index')->with(compact('page_name','featuredItemsChunk','lastestProducts','featuredItemsCount'));
    }
}
