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
        $categoryCount = Category::where(['url' => $url,'status'=>1])->count();
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

             dd($categoryDetails);


        } else {
            abort(404);
        }
    }
}
