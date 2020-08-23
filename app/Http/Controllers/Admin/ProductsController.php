<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\Section;
use Image;
use Session;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function products() {
        Session::put('page','products');
        // if Product Model has ->select(['id','name']) then bellow
        $products = Product::with(['category','section'])->get();

        // $products = json_decode(json_encode($products),1);
        // echo "<pre>"; print_r($products);die;

        // if Product Model has not ->select(['id','name']) then bellow
        // $products = Product::with(['section' => function($query) {
        //     $query->select(['id','name']);
        // }])->get();
        // end

        return view('admin.products.products')->with(compact('products'));
    }

    public function addEditProduct(Request $request, $id = null) {
        if(!$id) {
            $title = "Add Product";
            $product = new Product;
            $productDetail = [];
            $getProducts = [];
            $flash_message = "Product added successfully";
        } else {
            $title = "Edit Product";

            $productDetail = Product::where('id',$id)->first();

            $getProducts = Product::with(['category','section'])->where(['section_id' => $productDetail['section_id'],'parent_id' => 0,'status' => 1])->get();
            $getProducts = json_decode(json_encode($getProducts), 1);

            // $productDetail = json_decode(json_encode($productDetail),1);
            // echo "<pre>"; print_r($productDetail);die;
            $product = Product::find($id);
            $flash_message = "Product updated successfully";


        }
        $arrFabric = ['Cotton','Polyester','Wool'];
        $arrSleeve = ['Full Sleeve','Half Sleeve','Short Sleeve','Sleeveless'];
        $arrPattern = ['Checked','Plain','Printed','Self','Solid'];
        $arrFit = ['Regular','Slim'];
        $arrOccasion = ['Casual','Formal'];

        if ($request->isMethod('post')) {
            $data = $request->all();
            // Product Validations
            $rules = [
                // 'category_name' => 'required|regex:/^[pL\s\-]+$/u',
                'category_name' => 'required',
                'section_id' => 'required',
                'url' => 'required',
                'category_image' => 'image',
            ];
            $customMessages = [
                'category_name.required' => 'Name is required',
                // 'category_name.regex' => 'Valid Name is required',
                'section_id.required' => 'Section is required',
                'url.required' => 'Product Url is required',
                'category_image.image' => 'Valid Image is required',
            ];
            $this->validate($request,$rules,$customMessages);

            if ($request->hasFile('category_image')) {
                $iamge_tmp = $request->file('category_image');
                if ($iamge_tmp->isValid()) {
                    $extension = $iamge_tmp->getClientOriginalExtension();

                    $imageName = rand(111,99999).'.'.$extension;
                    $iamgePath = 'images/category_images/'.$imageName;

                    Image::make($iamge_tmp)->save($iamgePath);
                    $product->category_image = $imageName;
                }
            }
            echo "<pre>"; print_r($product);die;
            $product->parent_id = $data['parent_id'];
            $product->section_id = $data['section_id'];
            $product->category_name = $data['category_name'];
            $product->category_discount = $data['category_discount'];
            $product->description = $data['description'];
            $product->url = $data['url'];
            $product->meta_title = $data['meta_title'];
            $product->meta_description = $data['meta_description'];
            $product->meta_keywords = $data['meta_keywords'];
            $product->status = 1;
            $product->save();

            Session::flash('success_message', $flash_message);
            return redirect('admin/products');
        }

        return view('admin.products.add_edit_product')->with(compact('title','productDetail','getProducts','arrFabric','arrSleeve','arrPattern','arrFit','arrOccasion'));
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
