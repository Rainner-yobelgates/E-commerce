<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  <link rel="shortcut icon" href="/image/admin/dashboard/r.png">

  <!-- summer note -->
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/admin/dist/css/adminlte.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- IziToast -->
  <link rel="stylesheet" href="/plugins/izitoast/dist/css/iziToast.min.css">
  <script src="/plugins/izitoast/dist/js/iziToast.min.js" type="text/javascript"></script>
  <!-- CSS -->
  <link rel="stylesheet" href="/css/admin.css">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link text-center">
        <span class="brand-text font-weight-bold">Revarvealt</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="/admin/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="https://rainner-yobelgates.github.io/" class="d-block">Rainnner Yobelgates F</a>
          </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="{{ route('dashboard') }}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('product') }}" class="nav-link">
                <i class="nav-icon fas fa-box-open"></i>
                <p>
                  Product
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('category') }}" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Category
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('order') }}" class="nav-link">
                <i class="nav-icon fas fa-shopping-cart"></i>
                <p>
                  Order
                </p>
                <span class="badge bg-info text-dark">{{invoice()}}</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.proof') }}" class="nav-link">
                <i class="nav-icon fas fa-file-invoice"></i>
                <p>
                  Payment Proof
                </p>
                <span class="badge bg-info text-dark">{{proof()}}</span>
              </a>
            </li>
            <br>
            <li class="nav-item">
              <a href="{{ route('logout') }}" class="nav-link text-danger">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                  Log Out
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              
            </div><!-- /.col -->
            <div class="col-sm-6">
              @yield('route')
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      @yield('content')
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
      <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
      </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- Default to the left -->
      Copyright &copy; {{ date('Y') }} Revarvealt &middot; All Right Reserved
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <!-- Bootstrap 4 -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="/admin/dist/js/adminlte.min.js"></script>
  <!-- Summernote -->
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
  <!-- Datatables -->
  <script src="/admin/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="/admin/plugins/jszip/jszip.min.js"></script>
  <script src="/admin/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="/admin/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="/admin/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="/admin/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="/admin/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <script>
    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
  <!-- Summernote -->
  <script>
    $('#summernote').summernote({
      placeholder: 'Describe Your Product Here',
      tabsize: 2,
      height: 160,
      toolbar: [
        ['font', ['bold', 'underline', 'clear']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['view', ['codeview', 'help']]
      ]
    });
  </script>
</body>

</html>