<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Section;
use Illuminate\Http\Request;
use Session;

class SectionController extends Controller
{
    public function sections() {
        Session::put('page','sections');
        $sections = Section::get();
        // $sections = json_decode(json_encode($sections),1);
        // echo "<pre>"; print_r($sections);die;
        return view('admin.sections.sections')->with(compact('sections'));
    }

    public function updateSectionStatus(Request $request) {
        if($request->ajax()) {
            $data = $request->all();
            if($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Section::where('id',$data['section_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'section_id'=>$data['section_id']]);
        }
    }

    public function deleteSection($id) {
        Section::where('id',$id)->delete();
        $flash_message = "Section has been deleted successfully!";
        Session::flash('success_message', $flash_message);
        return redirect()->back();
    }
}
