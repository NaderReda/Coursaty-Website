<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStudentRequest;
use App\Models\Students;
use App\Models\Countries;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(){
        $data=Students::all();
        if(!empty($data)){
            foreach($data as $info){
            $info->country_name=Countries::where('id',$info->country_id)->value('name');
            }
        }
        return view('students.index',compact('data'));
    }

    public function create(){
        $countries=Countries::select('id','name')->where('active',1)->get();
        return view('students.create',compact('countries'));
    }

    public function store(CreateStudentRequest $request){
        $counter=Students::where('name',$request->name)->count();
        if($counter>0){
            return redirect()->back()->with('error','اسم الطالب مسجل من قبل')->withInput();
        }
        $student=new Students();
        $student->name=$request->name;
        $student->country_id=$request->country_id;
        $student->phone=$request->phone;
        $student->nationalID=$request->nationalID;
        $student->address=$request->address;
        $student->active=$request->active;
        //upload photo
        if($request->has('photo')){
            $image=$request->photo;
            $extension=strtolower($image->extension());
            $filename=time().rand(1,1000).".".$extension;
            $image->getClientOriginalName=$filename;
            $image->move("uploads",$filename);
            $student->image=$filename;
        }
        $student->save();
        return redirect()->route('student.index')->with('success','تم اضافة الطالب بنجاح');
    }

    public function edit($id){
        $data=Students::find($id);
        if(empty($data)){
            return redirect()->route('student.index')->with('error','غير قادر للوصول للبيانات المطلوبة');
        }
        $countries=Countries::select('id','name')->where('active',1)->get();
        return view('students.edit',compact('data','countries'));
    }

    public function update($id,CreateStudentRequest $request){
        $datastudent=Students::find($id);
        if(empty($datastudent)){
            return redirect()->route('student.index')->with('error','غير قادر للوصول للبيانات المطلوبة');
        }
        $datastudent->name=$request->name;
        $datastudent->country_id=$request->country_id;
        $datastudent->phone=$request->phone;
        $datastudent->nationalID=$request->nationalID;
        $datastudent->address=$request->address;
        $datastudent['active']=$request->active;
        // رفع الصورة فقط إذا وُجدت صورة جديدة
        if($request->hasFile('photo')){
            $image=$request->photo;
            $extension=strtolower($image->extension());
            $filename=time().rand(1,1000).".".$extension;
            $image->move("uploads",$filename);
            $datastudent->image=$filename;
        }
        $datastudent->save();
        return redirect()->route('student.index')->with('success','تم التحديث بنجاح');
    }

    public function destroy($id){
        $datastudent=Students::find($id);
        if(empty($datastudent)){
            return redirect()->route('student.index')->with(['success','غير قادر علي الوصول للبيانات']);
        }
        $datastudent->delete();
        return redirect()->route('student.index')->with('success','تم الحذف بنجاح');
    }

    public function ajax_search_student(Request $request){
        if($request->ajax()){
            $name=$request->name;
            $data=Students::with('country')->where('name','like',"%{$name}%")->get();
            if(!empty($data)){
                foreach($data as $info){
                    $info->country_name=Countries::where('id',$info->country_id)->value('name');
                }
            }
            return view('students.ajax_search_student',compact('data'));
        }
    }
}
