@extends('admin.layout.index')

@section('content')
    
 <!-- Page Content -->
 <div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tin Tức
                    <small>thêm</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
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

                <form action="admin/tintuc/them" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}" />
                    <div class="form-group">
                        <label>Thể Loại</label>
                        <select class="form-control" name="theloai" id = "theloai">
                            @foreach ($theloai as $item)
                                <option value="{{$item->id}}">{{$item->Ten}}</option>
                            @endforeach
                    
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Loại Tin</label>
                        <select class="form-control" name="loaitin" id = "loaitin">
                            @foreach ($loaitin as $item)
                                <option value="{{$item->id}}">{{$item->Ten}}</option>
                            @endforeach
                    
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Tiêu đề</label>
                        <input class="form-control" name="TieuDe" placeholder="Please Enter Category Name" />
                    </div>
                    <div class="form-group">
                        <label>Tóm tắt </label>
                        <textarea id="demo" class="form-control ckeditor" name="TomTat" rows = "3"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Nội dung</label>
                        <textarea id="demo" class="form-control ckeditor" name="NoiDung" rows = "5"></textarea>                    </div>
                    <div class="form-group">
                        <label>Hình ảnh</label>
                        <input type="file" class="form-control" name="Hinh" />
                    </div>
                    <div class="form-group">
                        <label>Nổi bật</label>
                        <label class="radio-inline">
                            <input name="NoiBat" value="0" checked="" type="radio">Không
                        </label>
                        <label class="radio-inline">
                            <input name="NoiBat" value="1" checked="" type="radio">Có
                        </label>
                    </div>
    
                    <button type="submit" class="btn btn-default">Thêm</button>
                    <button type="reset" class="btn btn-default">Làm mới</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
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