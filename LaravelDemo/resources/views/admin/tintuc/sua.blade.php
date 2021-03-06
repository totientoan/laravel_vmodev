@extends('admin.layout.index')

@section('content')
    
 <!-- Page Content -->
 <div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tin Tức
                    <small>Sửa</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            @if(session()->get('xoacomment'))
                <div class="alert alert-success">
                    {{session()->get('xoacomment')}}
                </div>   
             @endif
            <div class="col-lg-7" style="padding-bottom:120px">

                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $err)
                        {{$err}}<br>
                    @endforeach
                </div>
            @endif
            
            @if (session('thongbao'))
                <div class="alert alert-success">
                    {{session('thongbao')}}
                </div>
            @endif

                <form action="admin/tintuc/sua/{{$tintuc->id}}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}" />
                    <div class="form-group">
                        <label>Thể Loại</label>
                        <select class="form-control" name="theloai" id = "theloai">
                            @foreach ($theloai as $item)
                                <option
                                    @if ($item->id == $tintuc->loaitin->idTheLoai)
                                        {{"selected"}}
                                    @endif
                                    value="{{$item->id}}">{{$item->Ten}}</option>
                            @endforeach
                    
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Loại Tin</label>
                        <select class="form-control" name="loaitin" id = "loaitin">
                            @foreach ($loaitin as $item)
                                <option
                                    @if ($item->id == $tintuc->idLoaiTin)
                                        {{"selected"}}
                                    @endif
                                    value="{{$item->id}}">{{$item->Ten}}</option>
                            @endforeach
                    
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Tiêu đề</label>
                        <input class="form-control" name="TieuDe" value="{{$tintuc->TieuDe}}" placeholder="Please Enter Category Name" />
                    </div>
                    <div class="form-group">
                        <label>Tóm tắt </label>
                        <textarea id="demo" class="form-control ckeditor" name="TomTat"  rows = "3">{{$tintuc->TomTat}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Nội dung</label>
                        <textarea id="demo" class="form-control ckeditor" name="NoiDung" rows = "5">{{$tintuc->NoiDung}}</textarea>                    </div>
                    <div class="form-group">
                        <label>Hình ảnh</label>
                        <input type="file" class="form-control" name="Hinh" />
                    </div>
                    <div class="form-group">
                        <label>Nổi bật</label>
                        <label class="radio-inline">
                            <input name="NoiBat" value="0"  type="radio"
                                @if ($tintuc->NoiBat == 0)
                                    {{"checked"}}
                                @endif>
                                Không
                        </label>
                        <label class="radio-inline">
                            <input name="NoiBat" value="1"  type="radio"
                            @if ($tintuc->NoiBat == 1)
                                    {{"checked"}}
                                @endif>
                                Có
                        </label>
                    </div>
    
                    <button type="submit" class="btn btn-default">Sửa</button>
                    <button type="reset" class="btn btn-default">Làm mới</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
        {{-- start row --}}
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Comment
                    <small></small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr text-align:center>
                        <th>ID</th>
                        <th>User</th>
                        <th>Ngày đăng</th>
                        <th>Nội Dung</th>
                        <th>Delete</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tintuc->comment as $cm)
                         <tr class="even gradeC" align="center">
                             
                            <td>{{$cm->id}}</td>
                             <td>{{$cm->user->name}}</td>
                             <td>{{$cm->created_at}}</td>
                             <td>{{$cm->NoiDung}}</td>

                         <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/comment/xoa/{{$cm->id}}/{{$tintuc->id}}"> Delete</a></td>  
                         </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- end row --}}
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

@endsection

@section('script')
<script>
    $(document).ready(function(){
        $("#theloai").change(function(){
            var idTheLoai = $(this).val();
            $.get('admin/ajax/loaitin/'+idTheLoai,function(data){
                //alert(data);
                $("#loaitin").html(data);
            });
        });
    });
</script>
@endsection