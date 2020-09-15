<?php

namespace App\Http\Controllers\Front;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function listing($url)
    {
        $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();
        if ($categoryCount > 0) {

            /** case 1 */
            // $ids = collect($categoryDetails['id']);

            // $ids = $ids->merge($categoryDetails['subcategories']->pluck('id'));

            // $products = Product::whereHas('category', function ($query) use ($ids) {
            //     $query->whereIn('id', $ids);
            // })
            // ->with(['category.parentcategory'])
            // ->paginate(9);
            // $products = json_decode(json_encode($products),1);
            // echo "<pre>"; print_r($products);die;

            /** case 2 */
            $categoryDetails = Category::categorysDetail($url);

            $productCount = Product::whereIn('category_id', $categoryDetails['catIds'])->where('status', 1)->count();
            $categoryProducts = Product::whereIn('category_id', $categoryDetails['catIds'])->where('status', 1)->paginate(3);

            $meta_title = $categoryProducts['meta_title'];
            $meta_description = $categoryProducts['meta_description'];
            $meta_keywords = $categoryProducts['meta_keywords'];
            return view('front.listing')->with(compact('categoryProducts', 'productCount', 'categoryDetails', 'meta_title', 'meta_description', 'meta_keywords'));
        } else {
            abort(404);
        }
    }

    function fetch_data(Request $request)
    {
        if ($request->ajax()) {
            $categoryDetails = Category::categorysDetail($request->slug);
            $categoryProducts = Product::whereIn('category_id', $categoryDetails['catIds'])->where('status', 1)->paginate(3);
            return view('front.pagination_data', compact('categoryProducts'))->render();
        }
    }
}
