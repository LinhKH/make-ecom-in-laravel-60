<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Image;

class BannerController extends Controller
{
    public function banners() {

        Session::put('page','banners');
        $banners = Banner::get();

        return view('admin.banners.banners')->with(compact('banners'));
    }

    public function addEditBanner(Request $request, $id = null) {
        if(!$id) {
            $title = "Add Banner";
            $banner = new Banner;
            $bannerDetail = [];
            $flash_message = "Banner added successfully";
        } else {
            $title = "Edit Banner";

            $bannerDetail = Banner::where('id',$id)->first();

            $bannerDetail = json_decode(json_encode($bannerDetail),1);
            // echo "<pre>"; print_r($bannerDetail);die;
            $banner = Banner::find($id);
            $flash_message = "Banner updated successfully";
        }
        if ($request->isMethod('post')) {
            $data = $request->all();
            // Banner Validations
            $rules = [
                'title' => 'required',
            ];
            $customMessages = [
                'title.required' => 'Name is required',
            ];
            $this->validate($request,$rules,$customMessages);

            // Upload Banner Image
            if ($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {
                    if (!empty($bannerDetail)) {
                        $this->deleteBannerImage($bannerDetail['id']);
                    }

                    $image_name = $image_tmp->getClientOriginalName();
                    $extension = $image_tmp->getClientOriginalExtension();

                    $imageName = $image_name.'-'.rand(111,99999).'.'.$extension;

                    $image_path = 'images/banner_images/'.$imageName;

                    Image::make($image_tmp)->resize(1170,480)->save($image_path);

                    $banner->image = $imageName;
                }
            } else {
                $banner->image = (isset($bannerDetail['image'])) ? $bannerDetail['image'] : null;
            }

            $banner->title = $data['title'];
            $banner->link = $data['link'];
            $banner->alt = $data['alt'];
            $banner->save();

            Session::flash('success_message', $flash_message);
            return redirect('admin/banners');
        }

        return view('admin.banners.add_edit_banner')->with(compact('title','bannerDetail'));
    }

    public function deleteBannerImage($id) {
        $bannerImage = Banner::select('image')->where('id',$id)->first();
        // echo "<pre>";print_r(json_decode(json_encode($bannerImage),1));die;
        $image_path = 'images/banner_images/';

        if (file_exists($image_path.$bannerImage['image']) && !empty($bannerImage['image'])) {
            unlink($image_path.$bannerImage['image']);
        }

        Banner::where('id',$id)->update(['image'=> '']);
        $flash_message = "Banner image has been deleted successfully";
        Session::flash('success_message', $flash_message);
        return redirect()->back();
    }

    public function updateBannerStatus(Request $request) {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Banner::where('id',$data['banner_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'banner_id'=>$data['banner_id']]);
        }
    }

    public function deleteBanner($id) {
        $this->deleteBannerImage($id);
        Banner::where('id',$id)->delete();
        $flash_message = "Banner has been deleted successfully!";
        Session::flash('success_message', $flash_message);
        return redirect()->back();
    }
}
