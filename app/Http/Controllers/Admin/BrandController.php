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
