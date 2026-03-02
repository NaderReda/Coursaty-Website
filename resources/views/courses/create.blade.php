@extends('main_layout')

@section('title')
إضافة كورس جديد
@endsection

@section('breadcrumb')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">إضافة كورس جديد</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
            <li class="breadcrumb-item"><a href="{{ route('courses.index') }}">الكورسات</a></li>
            <li class="breadcrumb-item active">إضافة كورس</li>
          </ol>
        </div>
      </div>
    </div>
</div>
@endsection

@section('content')
@if(Session::has('error'))
<div class="alert alert-danger" role="alert">
 {{ Session::get('error') }}
</div>
@endif
<div class="col-md-12">
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">بيانات الكورس</h3>
    </div>
    <form action="{{ route('courses.store') }}" method="POST" role="form">
    @csrf
    <div class="card-body">
      <div class="form-group">
        <label for="name">اسم الكورس</label>
        <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" placeholder="أدخل اسم الكورس">
        @error('name')
            <span style="color: red;">{{ $message }}</span>
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
    
     
        
      <div class="form-group" style="text-align: center;">
      <button type="submit" class="btn btn-primary">أضف الكورس</button>
      </div>
 
    </div>
    <!-- /.card-body -->
  </form>
  </div>
  <!-- /.card -->
</div>
@endsection