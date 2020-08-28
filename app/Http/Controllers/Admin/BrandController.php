<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class BrandController extends Controller
{
    public function brands() {

        Session::put('page','brands');
        $brands = Brand::get();

        return view('admin.brands.brands')->with(compact('brands'));
    }

    public function addEditBrand(Request $request, $id = null) {
        if(!$id) {
            $title = "Add Brand";
            $brand = new Brand;
            $brandDetail = [];
            $flash_message = "Brand added successfully";
        } else {
            $title = "Edit Brand";

            $brandDetail = Brand::where('id',$id)->first();

            $brandDetail = json_decode(json_encode($brandDetail),1);
            // echo "<pre>"; print_r($brandDetail);die;
            $brand = Brand::find($id);
            $flash_message = "Brand updated successfully";
        }
        if ($request->isMethod('post')) {
            $data = $request->all();
            // Brand Validations
            $rules = [
                'name' => 'required',
            ];
            $customMessages = [
                'name.required' => 'Name is required',
            ];
            $this->validate($request,$rules,$customMessages);

            $brand->name = $data['name'];
            $brand->save();

            Session::flash('success_message', $flash_message);
            return redirect('admin/brands');
        }

        return view('admin.brands.add_edit_brand')->with(compact('title','brandDetail'));
    }

    public function updateBrandStatus(Request $request) {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Brand::where('id',$data['brand_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'brand_id'=>$data['brand_id']]);
        }
    }

    public function deleteSection($id) {
        Brand::where('id',$id)->delete();
        $flash_message = "Brand has been deleted successfully!";
        Session::flash('success_message', $flash_message);
        return redirect()->back();
    }
}
