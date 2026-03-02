<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTraningCourse;
use App\Http\Requests\DoAddStudenttoCourse;
use App\Models\Courses;
use App\Models\Students;
use App\Models\Traning_courses_enrolments;
use App\Models\Traning_Courses;
use Illuminate\Http\Request;

class Traning_CoursesController extends Controller
{
    public function index(){
        $data=Traning_Courses::all();
        if(!empty($data)){
            foreach($data as $info){
            $info->course_name=Courses::where('id',$info->courseID)->value('name');
            }
        }
        return view('traning_courses.index',compact('data'));
    }

    public function create(){
        $courses=Courses::select('id','name')->where('active',1)->get();
        return view('traning_courses.create',compact('courses'));
    }

    public function store(CreateTraningCourse $request){
     
        $student=new Traning_Courses();
        $student->courseID=$request->courseID;
        $student->start_date=$request->start_date;
        $student->end_date=$request->end_date;
        $student->price=$request->price;
        $student->save();
        return redirect()->route('traning_course.index')->with('success','تم اضافة الدورة بنجاح');
    }

    public function edit($id){
        $data=Traning_Courses::find($id);
        if(empty($data)){
            return redirect()->route('traning_course.index')->with('error','غير قادر للوصول للبيانات المطلوبة');
        }
        $courses=Courses::select('id','name')->where('active',1)->get();
        return view('traning_courses.edit',compact('data','courses'));
    }

    public function update($id,CreateTraningCourse $request){
        $datacourse=Traning_Courses::find($id);
        if(empty($datacourse)){
            return redirect()->route('traning_course.index')->with('error','غير قادر للوصول للبيانات المطلوبة');
        }
        $datacourse->courseID=$request->courseID;
        $datacourse->start_date=$request->start_date;
        $datacourse->end_date=$request->end_date;
        $datacourse->price=$request->price;
        $datacourse->save();
        return redirect()->route('traning_course.index')->with('success','تم التحديث بنجاح');
    }

    public function destroy($id){
        $datacourse=Traning_Courses::find($id);
        if(empty($datacourse)){
            return redirect()->route('traning_course.index')->with(['success','غير قادر علي الوصول للبيانات']);
        }
        $datacourse->delete();
        return redirect()->route('traning_course.index')->with('success','تم الحذف بنجاح');
    }

    public function details($id){
        $datatraning=Traning_Courses::find($id);
        if(empty($datatraning)){
            return redirect()->route('traning_course.index')->with('error','غير قادر علي جلب البيانات'); 
        }
        $datatraning->course_name=Courses::where('id',$datatraning->courseID)->value('name');
        $datatraning->studentcounter=Traning_courses_enrolments::where('traning_courses_id',$id)->count();
        $traning_course_enrolments=Traning_courses_enrolments::where('traning_courses_id',$id)->get();
        if(!empty($traning_course_enrolments)){
            foreach($traning_course_enrolments as $info){
                $info->course_name=$datatraning->course_name;
                $info->student_name=Students::where('id',$info->studentID)->value('name');
            }
        }
        return view('traning_courses.details',compact('datatraning','traning_course_enrolments'));
    }

    public function AddStudent($id){
        $data=Traning_Courses::find($id);;
        if(empty($data)){
            return redirect()->route('traning_course.index')->with('error','غير قادر علي جلب البيانات');
        }
        $students=Students::select('id','name')->where('active',1)->get();
        return view('traning_courses.addstudent',compact('data','students'));
    }

    public function DoAddStudent($id,DoAddStudenttoCourse $request){
        $data=Traning_Courses::find($id);;
        if(empty($data)){
            return redirect()->route('traning_course.index')->with('error','غير قادر علي جلب البيانات');
        }
        $counter=Traning_courses_enrolments::where('studentID',$request->studentID)->where('traning_courses_id',$id)->count();
        if($counter>0){
            return redirect()->back()->with('error','الطالب مسجل من قبل في الدورة')->withInput();
        }
        $enrolment=new Traning_courses_enrolments();
        $enrolment->studentID=$request->studentID;
        $enrolment->traning_courses_id=$id;
        $enrolment->enrolments_date=$request->enrolments_date;
        $enrolment->save();
        return redirect()->route('traning_course.details',$id)->with('success','تم اضافة الطالب بنجاح');
    }

    public function Deletestudent($id){
        $data=Traning_courses_enrolments::find($id);
        if(empty($data)){
            return redirect()->route('traning_course.index')->with('error','not found Data');
        }
        $data->delete();
        return redirect()->route('traning_course.details',$data->traning_courses_id)->with('success','تم الحذف بنجاح');
    }


}
