<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Proyecto Laravel | Carlos Ramos</title>

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">

  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.css') }}">

  <!--bootstrap icons-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('css/sweetalert2-theme-bootstrap-4/bootstrap-4.css')}}">

  <!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script language="JavaScript" src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<!-- Bootstrap -->
<script language="JavaScript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!--validate-->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.js') }}"></script>
<script src="{{ asset('plugins/jquery-validation/jquery.validate.js') }}"></script>
<!-- SweetAlert2 -->
<script src="{{ asset('plugins/sweetalert2/sweetalert2.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
<!-- AdminLTE App -->
<script language="JavaScript" src="{{ asset('js/adminlte.min.js') }}"></script>
<!-- DataTables  & Plugins -->
  <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.js') }}"></script>
  <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.js') }}"></script>
  <script src="{{ asset('plugins/jszip/jszip.js') }}"></script>
  <script src="{{ asset('plugins/pdfmake/pdfmake.js') }}"></script>
  <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.js') }}"></script>
  <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.js') }}"></script>
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  @include('template.encabezado')

  @include('template.cuerpo')

  @include('template.pie')
</div>
<!-- ./wrapper -->


</body>
</html>