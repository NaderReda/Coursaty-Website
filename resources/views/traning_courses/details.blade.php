@extends('main_layout')

@section('title')
تفاصيل الدورة التدريبية
@endsection

@section('content')
<div class="col-12">
  @if(Session::has('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ Session::get('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  </div>
  @endif
  @if(Session::has('error'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ Session::get('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  </div>
  @endif
  <div class="card">
    <div class="card-body">
    <table id="example2" class="table table-bordered table-hover">
        <tr>
            <td>اسم الكورس</td>
            <td>{{ $datatraning->course_name }}</td>
        </tr>
        <tr>
            <td> السعر</td>
            <td>{{ $datatraning->price }}</td>
        </tr>
        <tr>
            <td> تاريخ البداية</td>
            <td>{{ $datatraning->start_date }}</td>
        </tr>
        <tr>
            <td> تاريخ النهاية</td>
            <td>{{ $datatraning->end_date }}</td>
        </tr>
        <tr>
            <td>  عدد الطلاب المسجلين للدورة</td>
            <td>{{ $datatraning->studentcounter }}</td>
        </tr>
        <tr>
            <td colspan="2">
                <a href="{{ route('traning_course.addstudent',$datatraning->id) }}" class="btn btn-primary">اضافة طالب</a>
            </td>
        </tr>
    </table>
    @if(@isset($traning_course_enrolments) and !@empty($traning_course_enrolments) and count($traning_course_enrolments)>0)
    <table id="example2" class="table table-bordered table-hover">
      <thead>
        <tr>
          
          <th>اسم الطالب</th>
          <th>تاريخ التسجيل</th>
          <th>تاريخ الاضافة</th>
          <th>التحكم</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($traning_course_enrolments as $info )
        <tr>
          <td>{{ $info->student_name}}</td>
          <td>{{ $info->enrolments_date }}</td>
          <td>{{ $info->created_at }}</td>
          <td style="white-space: nowrap;">
            <a href="{{ route('traning_course.deletestudent',$info->id) }}" class="btn btn-sm btn-danger" style="margin-left: 4px;" onclick="return confirm('هل أنت متأكد من حذف هذا الطالب  الدورة؟');">حذف</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    @else
    <p style="text-align: center; color:red; padding: 15px;">لا يوجد طلاب مسجلين في هذه الدورة.</p>
    @endif
    </div>
  </div>
</div>
@endsection