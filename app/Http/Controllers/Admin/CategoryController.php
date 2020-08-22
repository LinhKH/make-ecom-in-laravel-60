<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Section;
use Session;
use Image;

class CategoryController extends Controller
{
    public function categories() {
        Session::put('page','categories');
        // if Category Model has ->select(['id','name']) then bellow
        $categories = Category::with(['section','parentcategory'])->get();

        // $categories = json_decode(json_encode($categories),1);
        // echo "<pre>"; print_r($categories);die;

        // if Category Model has not ->select(['id','name']) then bellow
        // $categories = Category::with(['section' => function($query) {
        //     $query->select(['id','name']);
        // }])->get();
        // end

        return view('admin.categories.categories')->with(compact('categories'));
    }

    public function updateCategoryStatus(Request $request) {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Category::where('id',$data['category_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'category_id'=>$data['category_id']]);
        }
    }

    public function addEditCategpry(Request $request, $id = null) {
        if(!$id) {
            $title = "Add Category";
            $category = new Category;
        } else {
            $title = "Edit Category";
        }
        if ($request->isMethod('post')) {
            $data = $request->all();
            // Category Validations
            $rules = [
                'category_name' => 'required|regex:/^[pL\s\-]+$/u',
                'section_id' => 'required',
                'url' => 'required',
                'category_image' => 'image',
            ];
            $customMessages = [
                'category_name.required' => 'Name is required',
                'category_name.regex' => 'Valid Name is required',
                'section_id.required' => 'Section is required',
                'url.required' => 'Category Url is required',
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
                    $category->category_image = $imageName;
                }
            }

            $category->parent_id = $data['parent_id'];
            $category->section_id = $data['section_id'];
            $category->category_name = $data['category_name'];
            $category->category_discount = $data['category_discount'];
            $category->description = $data['description'];
            $category->url = $data['url'];
            $category->meta_title = $data['meta_title'];
            $category->meta_description = $data['meta_description'];
            $category->meta_keywords = $data['meta_keywords'];
            $category->status = 1;
            $category->save();
            return redirect('admin/categories');
        }

        // get all sections
        $sections = Section::get();

        return view('admin.categories.add_edit_category')->with(compact('title','sections'));
    }

    public function appendCategoriesLevel(Request $request) {
        if ($request->ajax()) {
            $data = $request->all();
            $getCategories = Category::with('subcategories')->where(['section_id' => $data['section_id'],'parent_id' => 0,'status' => 1])->get();
            $getCategories = json_decode(json_encode($getCategories), 1);

            return view('admin.categories.append_categories_level')->with(compact('getCategories'));

        }
    }
}
