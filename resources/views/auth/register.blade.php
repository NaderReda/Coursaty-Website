@extends('main_layout')

@section('title')
تسجيل حساب جديد
@endsection

@section('breadcrumb')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">تسجيل حساب جديد</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
            <li class="breadcrumb-item active">تسجيل</li>
          </ol>
        </div>
      </div>
    </div>
</div>
@endsection

@section('content')
<div class="col-md-12">
  <div class="card" style="width: 60%; margin: 0 auto;">
    <div class="card-header">
      <h3 class="card-title" style="float: none; text-align: center;">بيانات التسجيل</h3>
    </div>
    <form action="{{ route('register.perform') }}" method="POST" role="form">
      @csrf
      <div class="card-body">
        <div class="form-group">
          <label for="name">الاسم</label>
          <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}">
          @error('name')
            <span style="color:red;">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="email">البريد الإلكتروني</label>
          <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}">
          @error('email')
            <span style="color:red;">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="password">كلمة المرور</label>
          <input type="password" name="password" class="form-control" id="password">
          @error('password')
            <span style="color:red;">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="password_confirmation">تأكيد كلمة المرور</label>
          <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
        </div>

        <div class="form-group" style="text-align: center;">
          <button type="submit" class="btn btn-primary">تسجيل</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

