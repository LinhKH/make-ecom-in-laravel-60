<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductImage;
use App\ProductsAttributes;
use App\Section;
use App\Upload;
use Image;
use Session;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function products() {
        Session::put('page','products');
        // if Product Model has ->select(['id','name']) then below
        $products = Product::with(['category','section'])->get();

        // $products = json_decode(json_encode($products),1);
        // echo "<pre>"; print_r($products);die;

        // if Product Model has not ->select(['id','name']) then below
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
            $flash_message = "Product added successfully";
        } else {
            $title = "Edit Product";

            $productDetail = Product::where('id',$id)->first();

            $productDetail = json_decode(json_encode($productDetail),1);
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

        // Brands
        $brands = Brand::get();
        $brands = json_decode(json_encode($brands),1);

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
                // var_dump($image_tmp);die;
                if ($image_tmp->isValid()) {
                    if (!empty($productDetail)) {
                        $this->deleteProductImage($productDetail['id']);
                    }

                    $image_name = $image_tmp->getClientOriginalName();
                    $extension = $image_tmp->getClientOriginalExtension();

                    $imageName = $image_name.'-'.rand(111,99999).'.'.$extension;

                    $spath_large_image = public_path()."/images/product_images/large/";
                    $spath_medium_image = public_path()."/images/product_images/medium/";
                    $spath_small_image = public_path()."/images/product_images/small/";
                    Upload::create_folder($spath_large_image);
                    Upload::create_folder($spath_medium_image);
                    Upload::create_folder($spath_small_image);

                    $large_image_path = $spath_large_image.$imageName;
                    $medium_image_path = $spath_medium_image.$imageName;
                    $small_image_path = $spath_small_image.$imageName;

                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(520,600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(260,300)->save($small_image_path);

                    $product->main_image = $imageName;
                }
            } else {
                $product->main_image = (isset($productDetail['main_image'])) ? $productDetail['main_image'] : null;
            }
            // Upload Product Video
            if ($request->hasFile('product_video')) {
                $video_tmp = $request->file('product_video');
                if ($video_tmp->isValid()) {
                    if (!empty($productDetail)) {
                        $this->deleteProductVideo($productDetail['id']);
                    }
                    $video_name = $video_tmp->getClientOriginalName();
                    $extension = $video_tmp->getClientOriginalExtension();

                    $videoName = $video_name.'-'.rand(111,99999).'.'.$extension;
                    $videoPath = 'videos/product_videos/'.$videoName;

                    $video_tmp->move($videoPath.$videoName);
                    $product->product_video = $videoName;
                }
            } else {
                $product->product_video = (isset($productDetail['product_video'])) ? $productDetail['product_video'] : null;
            }

            if (empty($data['is_featured'])) {
                $is_featured = "No";
            } else {
                $is_featured = "Yes";
            }
            $categoryDetail = Category::find($data['category_id']);

            $product->category_id = $data['category_id'];
            $product->section_id = $categoryDetail['section_id'];
            $product->brand_id = $data['brand_id'];
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

            $product->save();

            Session::flash('success_message', $flash_message);
            return redirect('admin/products');
        }

        return view('admin.products.add_edit_product')->with(compact('title','productDetail','arrFabric','arrSleeve','arrPattern','arrFit','arrOccasion','categories','brands'));
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

    public function updateProductImageStatus(Request $request) {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            ProductImage::where('id',$data['product_image_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'product_image_id'=>$data['product_image_id']]);
        }
    }

    public function showProductAttributes(Request $request) {
        if($request->ajax()) {
            $data = $request->all();
            $results = ProductsAttributes::where(['status' => 1, 'id' => $data['attr_id']])->firstOrFail();

            return response()->json(['data'=>$results]);
        }
    }

    public function deleteProductImage($id) {
        $productImage = Product::select('main_image')->where('id',$id)->first();
        // echo "<pre>";print_r(json_decode(json_encode($productImage),1));die;
        $small_image_path = 'images/product_images/small/';
        $medium_image_path = 'images/product_images/medium/';
        $large_image_path = 'images/product_images/large/';

        if (file_exists($small_image_path.$productImage['main_image']) && !empty($productImage['main_image'])) {
            unlink($small_image_path.$productImage['main_image']);
        }
        if (file_exists($medium_image_path.$productImage['main_image']) && !empty($productImage['main_image'])) {
            unlink($medium_image_path.$productImage['main_image']);
        }
        if (file_exists($large_image_path.$productImage['main_image']) && !empty($productImage['main_image'])) {
            unlink($large_image_path.$productImage['main_image']);
        }

        Product::where('id',$id)->update(['main_image'=> '']);
        $flash_message = "Product image has been deleted successfully";
        Session::flash('success_message', $flash_message);
        return redirect()->back();
    }

    public function deleteProductImageTable($id) {
        $productImages = ProductImage::select('image')->where(['product_id' => $id, 'status' => 1])->get()->toArray();
        // echo "<pre>";print_r(json_decode(json_encode($productImage),1));die;
        $small_image_path = 'images/product_images/small/';
        $medium_image_path = 'images/product_images/medium/';
        $large_image_path = 'images/product_images/large/';

        foreach ($productImages as $key => $productImage) {
            if (file_exists($small_image_path.$productImage['image']) && !empty($productImage['image'])) {
                unlink($small_image_path.$productImage['image']);
            }
            if (file_exists($medium_image_path.$productImage['image']) && !empty($productImage['image'])) {
                unlink($medium_image_path.$productImage['image']);
            }
            if (file_exists($large_image_path.$productImage['image']) && !empty($productImage['image'])) {
                unlink($large_image_path.$productImage['image']);
            }
        }
        ProductImage::where(['product_id' => $id, 'status' => 1])->update(['image'=> '']);
        
    }

    public function deleteProductVideo($id) {
        $productVideo = Product::select('product_video')->where('id',$id)->first();
        $product_video_path = 'videos/product_videos/';
        if (file_exists($product_video_path.$productVideo['product_video']) && !empty($productVideo['product_video'])) {
            unlink($product_video_path.$productVideo['product_video']);
        }

        Product::where('id',$id)->update(['product_video'=> '']);
        $flash_message = "Product video has been deleted successfully";
        Session::flash('success_message', $flash_message);
        return redirect()->back();
    }

    public function deleteProduct($id) {
        $this->deleteProductImage($id);
        $this->deleteProductImageTable($id);
        Product::where('id',$id)->delete();
        Product::where('product_id',$id)->delete();
        $flash_message = "Product has been deleted successfully!";
        Session::flash('success_message', $flash_message);
        return redirect()->back();
    }

    public function addAttributes(Request $request,$id = null) {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>";print_r($data);die;
            if (!empty($data) && !empty($data['size']) && !empty($data['sku']) && !empty($data['price']) && !empty($data['stock'])) {
                foreach ($data['sku'] as $key => $value) {
                    if (!empty($value)) {

                        if (!empty($data['id'][$key])) {
                            $attribute = ProductsAttributes::find($data['id'][$key]);
                        } else {
                            // SKU already exists check
                            $attrCountSku = ProductsAttributes::where('sku',$value)->count();
                            if ($attrCountSku > 0) {
                                $flash_message = "Sku already exists. Please add another Sku!";
                                Session::flash('error_message', $flash_message);
                                return redirect()->back();
                            }
                            // Size already exists check
                            $attrCountSize = ProductsAttributes::where(['size' => $data['size'][$key], 'product_id' => $id])->count();
                            if ($attrCountSize > 0) {
                                $flash_message = "Size already exists. Please add another Size!";
                                Session::flash('error_message', $flash_message);
                                return redirect()->back();
                            }

                            $attribute = new ProductsAttributes();
                        }
                        
                        $attribute->product_id = $id;
                        $attribute->size = $data['size'][$key];
                        $attribute->sku = $data['sku'][$key];
                        $attribute->price = $data['price'][$key];
                        $attribute->stock = $data['stock'][$key];
                        $attribute->save();

                    } else {
                        $flash_message = "Sku is required!";
                        Session::flash('error_message', $flash_message);
                        return redirect()->back();
                    }
                }
                $flash_message = "Product Attributes has been added/updated successfully!";
                Session::flash('success_message', $flash_message);
                return redirect()->back();
            }
        }

        $productDetail = Product::with('attributes')->withCount('attributes')->find($id);
        $productDetail = json_decode(json_encode($productDetail),1);
        // echo "<pre>";print_r($productDetail);die;

        $title = "Product Attributes";
        return view('admin.products.add_product_attribute')->with(compact('title','productDetail'));
    }

    public function addImages(Request $request, $id = null) {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data);die;

            if ($request->hasFile('images')) {
                $images = $request->file('images');
                // echo "<pre>"; print_r($images);die;
                foreach ($images as $key => $image) {
                    $productImage = new ProductImage();
                    $image_tmp = Image::make($image);
                    $originalName = $image->getClientOriginalName();
                    $extension = $image->getClientOriginalExtension();
                    $imageName = rand(111,999999).time().".".$extension;

                    $spath_large_image = public_path()."/images/product_images/large/";
                    $spath_medium_image = public_path()."/images/product_images/medium/";
                    $spath_small_image = public_path()."/images/product_images/small/";
                    Upload::create_folder($spath_large_image);
                    Upload::create_folder($spath_medium_image);
                    Upload::create_folder($spath_small_image);

                    $large_image_path = $spath_large_image.$imageName;
                    $medium_image_path = $spath_medium_image.$imageName;
                    $small_image_path = $spath_small_image.$imageName;

                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(520,600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(260,300)->save($small_image_path);

                    $productImage->image = $imageName;
                    $productImage->product_id = $id;
                    $productImage->save();
                }
                $flash_message = "Products Images has been added successfully!";
                Session::flash('success_message', $flash_message);
                return redirect()->back();
            }
        }
        $productDetail = Product::with('images')->find($id);
        $productDetail = json_decode(json_encode($productDetail),1);
        // echo "<pre>";print_r($productDetail);die;
        $title = "Product Images";
        return view('admin.products.add_images')->with(compact('title','productDetail'));
    }

    public function deleteProductAttributes($id) {
        ProductsAttributes::where('id',$id)->delete();
        $flash_message = "ProductsAttributes has been deleted successfully!";
        Session::flash('success_message', $flash_message);
        return redirect()->back();
    }

    public function deleteProductImages($id) {
        ProductImage::where('id',$id)->delete();
        $flash_message = "Products Images has been deleted successfully!";
        Session::flash('success_message', $flash_message);
        return redirect()->back();
    }


}
