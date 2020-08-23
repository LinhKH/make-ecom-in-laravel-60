<?php

namespace App\Http\Controllers\Admin;

use App\Category;
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

        // Sections with Categories and Sub Categories
        $categories = Section::with('categories')->get();
        $categories = json_decode(json_encode($categories),1);

        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>";print_r($data);die;
            // Product Validations
            $rules = [
                'category_id' => 'required',
                'product_name' => 'required',
                'product_code' => 'required',
                'product_price' => 'required|numeric',
                'product_color' => 'required',
            ];
            $customMessages = [
                'category_id.required' => 'Category is required',
                'product_name.required' => 'Product Name is required',
                'product_code.required' => 'Product Code is required',
                'product_price.required' => 'Product Price is required',
                'product_price.numeric' => 'Valid Product Price is required',
                'product_color.required' => 'Product Color is required',
                
            ];
            $this->validate($request,$rules,$customMessages);

            // Upload Product Image
            if ($request->hasFile('main_image')) {
                $image_tmp = $request->file('main_image');
                if ($image_tmp->isValid()) {
                    $image_name = $image_tmp->getClientOriginalName();
                    $extension = $image_tmp->getClientOriginalExtension();

                    $imageName = $image_name.'-'.rand(111,99999).'.'.$extension;

                    $large_image_path = 'images/product_images/large/'.$imageName;
                    $medium_image_path = 'images/product_images/medium/'.$imageName;
                    $small_image_path = 'images/product_images/small/'.$imageName;

                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(520,600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(260,300)->save($small_image_path);

                    $product->main_image = $imageName;
                }
            } else {
                $product->main_image = null;
            }
            // Upload Product Video
            if ($request->hasFile('product_video')) {
                $video_tmp = $request->file('product_video');
                if ($video_tmp->isValid()) {
                    $video_name = $video_tmp->getClientOriginalName();
                    $extension = $video_tmp->getClientOriginalExtension();

                    $videoName = $video_name.'-'.rand(111,99999).'.'.$extension;
                    $videoPath = 'videos/product_videos/'.$videoName;

                    $video_tmp->move($videoPath.$videoName);
                    $product->product_video = $videoName;
                }
            } else {
                $product->product_video = null;
            }

            if (empty($data['is_featured'])) {
                $is_featured = "No";
            } else {
                $is_featured = "Yes";
            }
            $categoryDetail = Category::find($data['category_id']);

            $product->category_id = $data['category_id'];
            $product->section_id = $categoryDetail['section_id'];
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            $product->product_discount = $data['product_discount'];
            $product->product_price = $data['product_price'];
            $product->product_weight = $data['product_weight'];
            $product->description = $data['description'];
            $product->wash_care = $data['wash_care'];
            $product->fabric = $data['fabric'];
            $product->pattern = $data['pattern'];
            $product->sleeve = $data['sleeve'];
            $product->fit = $data['fit'];
            $product->occasion = $data['occasion'];
            $product->meta_title = $data['meta_title'];
            $product->meta_description = $data['meta_description'];
            $product->meta_keywords = $data['meta_keywords'];
            $product->is_featured = $is_featured;
            $product->status = 1;

            $product->save();

            Session::flash('success_message', $flash_message);
            return redirect('admin/products');
        }

        return view('admin.products.add_edit_product')->with(compact('title','productDetail','getProducts','arrFabric','arrSleeve','arrPattern','arrFit','arrOccasion','categories'));
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
