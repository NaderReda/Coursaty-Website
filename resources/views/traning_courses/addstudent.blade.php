@extends('main_layout')

@section('title')
إضافة طالب للدورة
@endsection

@section('content')
@if(Session::has('error'))
<div class="alert alert-danger" role="alert">
 {{ Session::get('error') }}
</div>
@endif
<div class="col-md-12">
<form action="{{ route('traning_course.doaddstudent',$data->id) }}" method="POST" role="form" style="width: 60%; margin: 0 auto; background-color: white;">
    @csrf
    <div class="card-body">
     

      <div class="form-group">
        <label>  بيانات الطلاب</label>
        <select name="studentID" id="studentID" class="form-control">
            <option value="">اختر الطالب</option>
            @if(!empty($students))
            @foreach ($students as $info )
            <option value="{{ $info->id }}" @if(old('studentID')==$info->id) selected @endif>{{ $info->name }}</option>
            @endforeach
            @endif
        </select>
        @error('studentID')
            <span style="color:red;">{{ $message }}</span>
        @enderror
      </div>


      <div class="form-group">
        <label for="enrolments_date">  تاريخ تسجيله في الدورة </label>
        <input type="date" name="enrolments_date" class="form-control" id="enrolments_date" value="{{ date('Y-m-d') }}">
        @error('enrolments_date')
        <span style="color:red;">{{ $message }}</span>
       @enderror
      </div>

     

      
    
      <div class="form-group" style="text-align: center;">
      <button type="submit" class="btn btn-primary">أضف الطالب</button>
      <a href="{{ route('traning_course.details',$data->id) }}" class="btn btn-secondary" style="margin-right: 10px; display: inline-block;">الغاء</a>
      </div>
 
    </div>
    <!-- /.card-body -->

    
  </form>
</div>
  @endsection