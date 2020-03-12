<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('be/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('be/ionic/ionicons.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('be/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('be/dist/css/adminlte.min.css')}}">
    <!-- jQuery -->
<script src="{{ asset('be/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('be/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('be/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- DataTables -->
<script src="{{ asset('be/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{ asset('be/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('be/dist/js/adminlte.min.js')}}"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <!-- Navbar -->
  @include('admin/header');
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('admin/sidebar');

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">   

    <!-- Main content -->
    @yield('content');
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @include('admin/footer');

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->  
<style>
  table.dataTable tbody td {
    font-size: 13px;
  }
  table.dataTable tbody th {
    font-size: 13px;
  }
  tr.dataTable { height: 10px; } 
</style>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>

</body>
</html>
