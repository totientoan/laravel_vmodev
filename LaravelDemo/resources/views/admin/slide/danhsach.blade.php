@extends('admin.layout.index')

@section('content')
  <!-- Page Content -->
<div id="page-wrapper">
   <div class="container-fluid">
       <div class="row">
           <div class="col-lg-12">
               <h1 class="page-header">Slide
                   <small></small>
               </h1>
           </div>
           <!-- /.col-lg-12 -->
           @if(session()->get('xoaslide'))
               <div class="alert alert-success">
                   {{ session()->get('xoaslide') }}
               </div>
           @endif
           <table class="table table-striped table-bordered table-hover" id="dataTables-example">
               <thead>
                   <tr align="center">
                       <th>ID</th>
                       <th>Tên</th>
                       <th>Hình</th>
                       <th>Nội Dung</th>
                       <th>link</th>
                       <th>Delete</th>
                       <th>Edit</th>
                   </tr>
               </thead>
               <tbody>
                   @foreach ($slide as $sd)
                        <tr class="even gradeC" align="center">
                            <td>{{$sd->id}}</td>
                            <td>{{$sd->Ten}}</td>
                            <td>
                                <img src="upload/slide/{{$sd->Hinh}}" width="500px" height="170px">
                            </td>
                            <td>{{$sd->NoiDung}}</td>
                            <td>{{$sd->link}}</td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/slide/xoa/{{$sd->id}}"> Delete</a></td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/slide/sua/{{$sd->id}}">Edit</a></td>
                        </tr>
                   @endforeach
               </tbody>
           </table>
       </div>
       <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->  
@endsection

