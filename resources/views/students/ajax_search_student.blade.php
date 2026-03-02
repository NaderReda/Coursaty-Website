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
        <td>{{ $info->country_name ?? '' }}</td>
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