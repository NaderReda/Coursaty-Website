@extends('main_layout')

@section('title')
 الكورسات 
@endsection

@section('breadcrumb')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">الكورسات</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
            <li class="breadcrumb-item active">الكورسات</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
@endsection

@section('content')
    <div class="col-12">
      <div class="card">
        @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
         {{ Session::get('success') }}
        </div>
        @endif
        @if(Session::has('error'))
        <div class="alert alert-danger" role="alert">
         {{ Session::get('error') }}
        </div>
        @endif
        <div class="card-header" style="text-align: center;">
          <h3 class="card-title" style="text-align: center; float:none;">بيانات الكورسات</h3>
          <a class="btn btn-sm btn-info" href="{{ route('courses.create') }}">إضافة كورس</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table id="example2" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>اسم الكورس</th>
                <th>حالة التفعيل</th>
                <th>تاريخ الاضافة</th>
                <th>تاريخ الحديث</th>
                <th>التحكم</th>
              </tr>
            </thead>
            <tbody>
                @if(@isset($data) and !@empty($data) and count($data)>0)
                @foreach ($data as $info )
              <tr>
                <td>{{ $info->name }}</td>
                <td> @if($info->active==1) مفعل @else معطل @endif </td>
                <td>{{ $info->created_at }}</td>
                <td>{{ $info->updated_at }}</td>
                <td>
                    <a href="{{ route('courses.edit',$info->id) }}" class="btn btn-sm btn-success" style="margin-left: 5px;">تعديل</a>
                    <a href="{{ route('courses.destroy',$info->id) }}" class="btn btn-sm btn-danger" style="margin-left: 5px;" onclick="return confirm('هل أنت متأكد من حذف هذا الكورس؟');">حذف</a>
                </td>
              </tr>
              @endforeach
              @else
              <tr>
                <td colspan="5" style="text-align: center; color:red; padding: 30px;">عفوا لا توجد بيانات لعرضها</td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
@endsection