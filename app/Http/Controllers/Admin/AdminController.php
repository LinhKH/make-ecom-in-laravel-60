<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Session;
use App\Admin;
use Hash;
use Image;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.admin_dashboard');
    }

    public function settings()
    {
        Session::put('page', 'settings');
        // $adminDetail = Auth::guard('admin')->user();
        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first();
        return view('admin.admin_settings')->with(compact('adminDetails'));
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required',
            ];

            $customMessages = [
                'email.required' => 'Email Address is required',
                'email.email' => 'Valid Email is required',
                'password.required' => 'Password is required'
            ];

            $this->validate($request, $rules, $customMessages);

            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                return redirect('admin/dashboard');
            } else {
                Session::flash('error_message', 'Invalid Email or Password');
                return redirect()->back();
            }
        }

        return view('admin.admin_login');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }

    public function checkCurrentPassword(Request $request)
    {
        $data = $request->all();

        if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
            echo "true";
        } else {
            echo "false";
        }
    }

    public function updateCurrentPassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
                if ($data['new_password'] == $data['confirm_password']) {
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password' => bcrypt($data['new_password'])]);

                    $flash_message = "Password has been updated successfully!";
                    Session::flash('success_message', $flash_message);
                } else {
                    $flash_message = "New password and Confirm password is not match!";
                    Session::flash('error_message', $flash_message);
                }
            } else {
                $flash_message = "Your current password is incorrect!";
                Session::flash('error_message', $flash_message);
            }
        }
        return redirect()->back();
    }

    public function updateAdminDetail(Request $request)
    {   
        Session::put('page', 'update-admin-detail');
        // $adminDetail = Auth::guard('admin')->user();
        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first();
        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'name' => 'required',
                'mobile' => 'required',
                // 'admin_image' => 'required',
            ];

            $customMessages = [
                'name.required' => 'Name is required',
                'mobile.required' => 'Mobile is required',
                // 'admin_image.required' => 'Image is required',
            ];
            $this->validate($request, $rules, $customMessages);

            // Upload Product Image
            if ($request->hasFile('admin_image')) {
                $image_tmp = $request->file('admin_image');
                // var_dump($image_tmp);die;
                if ($image_tmp->isValid()) {
                    if (!empty($adminDetails)) {
                        $this->deleteAdminDetailImage($adminDetails['id']);
                    }
                    
                    $image_name = $image_tmp->getClientOriginalName();
                    $extension = $image_tmp->getClientOriginalExtension();

                    $imageName = $image_name.'-'.rand(111,99999).'.'.$extension;

                    $image_path = 'images/admin_images/admin_photos/'.$imageName;

                    Image::make($image_tmp)->save($image_path);

                }
            } else {
                $imageName = (isset($adminDetails['image'])) ? $adminDetails['image'] : null;
            }
            // Update admin details
            Admin::where('email', Auth::guard('admin')->user()->email)->update([
                'name' => $data['name'],
                'mobile' => $data['mobile'],
                'image' => $imageName,
            ]);
            $flash_message = "Admin Details updated successfully!";
            Session::flash('success_message', $flash_message);
            return redirect()->back();
        }

        return view('admin.admin_detail')->with(compact('adminDetails'));
    }

    public function deleteAdminDetailImage($id) {
        $productImage = Admin::select('image')->where('id',$id)->first();
        // echo "<pre>";print_r(json_decode(json_encode($productImage),1));die;
        $image_path = 'images/admin_images/admin_photos/';
       
        if (file_exists($image_path.$productImage['image']) && !empty($productImage['image'])) {
            unlink($image_path.$productImage['image']);
        }

        Admin::where('id',$id)->update(['image'=> '']);
        $flash_message = "Admin image has been deleted successfully";
        Session::flash('success_message', $flash_message);
        return redirect()->back();
    }
}
