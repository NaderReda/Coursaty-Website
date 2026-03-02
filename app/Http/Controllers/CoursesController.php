<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCourseValidationRequest;
use App\Models\Courses;
use App\Models\Countries;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function index(){
        $data=Courses::all();
     
        return view('courses.index',compact('data'));
    }

    public function create(){
        return view('courses.create');
    }

    public function store(CreateCourseValidationRequest $request){
        $counter=Courses::where('name',$request->name)->count();
        if($counter>0){
            return redirect()->back()->with('error','اسم الكورس مسجل من قبل')->withInput();
        }
        $course=new Courses();
        $course->name=$request->name;
        $course->active=$request->active;
        $course->save();
        return redirect()->route('courses.index')->with('success','تم اضافة الكورس بنجاح');
    }

    public function edit($id){
        $data=Courses::find($id);
        if(empty($data)){
            return redirect()->route('courses.index')->with('error','غير قادر للوصول للبيانات المطلوبة');
        }
        return view('courses.edit',compact('data'));
    }

    public function update($id,CreateCourseValidationRequest $request){
        $datacourse=Courses::find($id);
        if(empty($datacourse)){
            return redirect()->route('courses.index')->with('error','غير قادر للوصول للبيانات المطلوبة');
        }
        $datacourse['name']=$request->name;
        $datacourse['active']=$request->active;
        $datacourse->save();
        return redirect()->route('courses.index')->with('success','تم التحديث بنجاح');

    }

    public function destroy($id){
        $datacourse=Courses::find($id);
        $datacourse->delete();
        return redirect()->route('courses.index')->with('success','تم الحذف بنجاح');
    }
}
