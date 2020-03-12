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
                  <th>Logo</th>
                  <th>Metatitle</th>
                  <th>Address</th>
                  <th>Contact</th>
                  <th>Email</th>
                  <th>Social</th>
                  <th>Created at</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                     @foreach($data as $key=>$dt)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $dt->logo }}</td>
                            <td>{{ $dt->meta_title }}</td>
                            <td>{{ $dt->address }}</td>
                            <td>{{ $dt->contact }}</td>
                            <td>{{ $dt->email }}</td>
                            <td>{{ $dt->social }}</td>
                            <td>{{ $dt->updated_at }}</td>
                            <td>
                                            <a onclick="event.preventDefault();editSetupForm(idedit='{{$dt->id}}');" href="#" class="btn btn-danger btn-xs" data-toggle="modal"><i class="fa fa-edit"></i></a></th>                                            
                                
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
    @include('admin.setup.edit')
    <script type="text/javascript" src="{{asset('be/js/setup.js')}}"></script>
@stop