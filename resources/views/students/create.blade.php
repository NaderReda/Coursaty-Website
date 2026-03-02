@extends('main_layout')

@section('title')
إضافة طالب جديد
@endsection

@section('content')
@if(Session::has('error'))
<div class="alert alert-danger" role="alert">
 {{ Session::get('error') }}
</div>
@endif
<div class="col-md-12">
<form action="{{ route('student.store') }}" method="POST" enctype="multipart/form-data" role="form" style="width: 60%; margin: 0 auto; background-color: white;">
    @csrf
    <div class="card-body">
      <div class="form-group">
        <label for="name">اسم الطالب</label>
        <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}">
        @error('name')
            <span style="color: red;">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-group">
        <label> الدولة التابع لها الطالب</label>
        <select name="country_id" id="country_id" class="form-control">
            <option value="">اختر الدولة</option>
            @if(!empty($countries))
            @foreach ($countries as $info )
            <option value="{{ $info->id }}">{{ $info->name }}</option>
            @endforeach
            @endif
        </select>
        @error('country_id')
            <span style="color:red;">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="address">العنوان</label>
        <input type="text" name="address" class="form-control" id="address" value="{{ old('address') }}">
      </div>

      <div class="form-group">
        <label for="nationalID"> الرقم القومي </label>
        <input type="text" name="nationalID" class="form-control" id="nationalID" value="{{ old('nationalID') }}">
        @error('nationalID')
        <span style="color:red;">{{ $message }}</span>
       @enderror
      </div>

      <div class="form-group">
        <label for="phone"> الهاتف </label>
        <input type="text" name="phone" class="form-control" id="phone" value="{{ old('phone') }}">
        @error('phone')
        <span style="color:red;">{{ $message }}</span>
       @enderror
      </div>

      <div class="form-group">
        <label>حالة التفعيل</label>
        <select name="active" id="active" class="form-control">
            <option value="">اختر الحالة</option>
            <option value="1" @if(old('active')==1) selected @endif>مفعل</option>
            <option value="0" @if(old('active')==0 and old('active')!='') selected @endif>معطل</option>
        </select>
        @error('active')
            <span style="color:red;">{{ $message }}</span>
        @enderror
      </div>

      <div class="form-group">
        <label for="photo">الصورة ان وجدت</label>
        <input type="file" name="photo" class="form-control" id="photo">
      </div>
    
      <div class="form-group" style="text-align: center;">
      <button type="submit" class="btn btn-primary">أضف الطالب</button>
      </div>
 
    </div>
    <!-- /.card-body -->

    
  </form>
</div>
  @endsection