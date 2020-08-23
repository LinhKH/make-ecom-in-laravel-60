<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;

use Session;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function products() {
        Session::put('page','products');
        // if Category Model has ->select(['id','name']) then bellow
        $products = Product::with(['category','section'])->get();

        // $products = json_decode(json_encode($products),1);
        // echo "<pre>"; print_r($products);die;

        // if Category Model has not ->select(['id','name']) then bellow
        // $products = Category::with(['section' => function($query) {
        //     $query->select(['id','name']);
        // }])->get();
        // end

        return view('admin.products.products')->with(compact('products'));
    }

    public function updateProductStatus(Request $request) {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Product::where('id',$data['product_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'product_id'=>$data['product_id']]);
        }
    }

    public function deleteProduct($id) {
        Product::where('id',$id)->delete();
        $flash_message = "Product has been deleted successfully!";
        Session::flash('success_message', $flash_message);
        return redirect()->back();
    }
}
