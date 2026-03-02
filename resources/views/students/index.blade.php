@extends('main_layout')

@section('title')
 الطلاب  
@endsection

@section('breadcrumb')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">الطلاب</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
            <li class="breadcrumb-item active">الطلاب</li>
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
          <h3 class="card-title" style="text-align: center; float:none;">بيانات الطلاب</h3>
          <a class="btn btn-sm btn-info" href="{{ route('student.create') }}">إضافة طالب</a>
          <div class="col-md-3">
            <input type="text" name="searchbyname" id="searchbyname" placeholder="ابحث باسم الطالب" class="form-control">
          </div>
        </div>
       

        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" id="ajax_response_div">
         
          <table id="example2" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>اسم الطالب</th>
                <th>الدولة</th>
                <th>العنوان </th>
                <th> التليفون </th>
                <th> الصورة </th>
                <th>التفعيل</th>
                <th>تاريخ الاضافة</th>
                <th>تاريخ التحديث</th>
                <th>التحكم</th>
              </tr>
            </thead>
            <tbody>
                @if(@isset($data) and !@empty($data) and count($data)>0)
                @foreach ($data as $info )
              <tr>
                <td>{{ $info->name }}</td>
                <td>{{ $info->country_name }}</td>
                <td>{{ $info->address }}</td>
                <td>{{ $info->phone }}</td>
                <td><img style="width: 70px; height: 70px;" src="{{ asset('uploads/'.$info->image) }}" alt=""></td>
                <td> @if($info->active==1) مفعل @else معطل @endif </td>
                <td>{{ $info->created_at }}</td>
                <td>{{ $info->updated_at }}</td>
                <td>
                  <div class="btn-group btn-group-sm" role="group" aria-label="Student actions">
                    <a href="{{ route('student.edit',$info->id) }}" class="btn btn-success" style="margin-left: 4px;">تعديل</a>
                    <a href="{{ route('student.destroy',$info->id) }}" class="btn btn-danger" style="margin-left: 4px;" onclick="return confirm('هل أنت متأكد من حذف هذا الطالب؟');">حذف</a>
                  </div>
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

@section('scripts')
<script>
  $(document).ready(function(){
    $(document).on('input','#searchbyname',function(e){
      var name=$(this).val();
      jQuery.ajax({
      url:"{{ route('student.ajax_search_student') }}",
      type:'POST',
      dataType:'html',
      cache:false,
      data:{_token:"{{ csrf_token() }}",
      name:name},
      success: function(data){
       $("#ajax_response_div").html(data);
      },
      error: function(xhr){
        console.log(xhr.responseText);
      }
    });
  
    });
  });
</script>


@endsection