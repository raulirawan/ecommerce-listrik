<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>

@stack('up-style')
@include('includes.style')
@stack('down-style')


</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
    @include('includes.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
    @include('includes.sidebar')

  <!-- Content Wrapper. Contains page content -->
    @yield('content')
  <!-- /.content-wrapper -->
  
    @include('includes.footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@stack('up-script')
@include('includes.script')
@stack('down-script')
</body>
</html>
