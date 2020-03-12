@extends('admin.master')

@section('content')
<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <strong>Data {{ $titles }}</strong>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{ $titles }}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

<section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <!-- <div class="card-header">
              <h3 class="card-title">Data {{$titles}}</h3>
            </div>
            /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Title</th>
                  <th>Order</th>
                  <th>Slug</th>
                  <th>Status</th>
                  <th>Created at</th>
                  <th>
                    <a  onclick="event.preventDefault();addCategoryForm();" href="#" class="btn btn-sm btn-flat btn-primary" data-toggle="modal"><i class="fa fa-plus"></i></a></th>                  
                </tr>
                </thead>
                <tbody>
                     @foreach($data as $key=>$dt)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $dt->title }}</td>
                            <td>{{ $dt->seq }}</td>
                            <td>{{ $dt->slug }}</td>
                            <td>{{ $dt->status }}</td>
                            <td>{{ $dt->created_at }}</td>
                            <td>
                                <div style="width:60px">
                                            <a onclick="event.preventDefault();editCategoryForm(idedit='{{$dt->id}}');" href="#" class="btn btn-danger btn-xs" data-toggle="modal"><i class="fa fa-edit"></i></a></th>
                                            <a onclick="event.preventDefault();deleteCategoryForm(iddel='{{$dt->id}}');" href="#" class="btn btn-danger btn-xs" data-toggle="modal"><i class="fa fa-trash"></i></a></th>                                </div>
                            </td>
                        </tr>                
                    @endforeach
                </tfoot>
              </table>
              
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    @include('admin.category.delete')
    @include('admin.category.add')
    @include('admin.category.edit')
    <script type="text/javascript" src="{{asset('be/js/category.js')}}"></script>
@stop