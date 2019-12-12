<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>HelpDesk QCL | @yield('titulo','Dashboard')</title>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta http-equiv="cache-control" content="max-age=0" />
        <meta http-equiv="cache-control" content="no-cache" />
        <meta http-equiv="cache-control" content="no-store" />
        <meta http-equiv="cache-control" content="must-revalidate" />
        <meta http-equiv="expires" content="0" />
        <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
        <meta http-equiv="pragma" content="no-cache" />
        <link type="image/x-icon" rel="icon" href="{{asset("assets/dist/img/servisalud.png")}}">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="{{asset("assets/bower_components/bootstrap/dist/css/bootstrap.min.css")}}">
        <link rel="stylesheet" href="{{asset("assets/bower_components/font-awesome/css/font-awesome.min.css")}}">
        <link rel="stylesheet" href="{{asset("assets/bower_components/Ionicons/css/ionicons.min.css")}}">
        <link rel="stylesheet" href="{{asset("assets/bower_components/bootstrap-daterangepicker/daterangepicker.css")}}">
        <link rel="stylesheet" href="{{asset("assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css")}}">
        <link rel="stylesheet" href="{{asset("assets/bower_components/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css")}}">
        <link rel="stylesheet" href="{{asset("assets/dist/css/AdminLTE.min.css")}}">
        <link rel="stylesheet" href="{{asset("assets/dist/css/skins/_all-skins.min.css")}}">
        <link rel="stylesheet" href="{{asset("assets/dist/css/awesomplete.css")}}">
        <link rel="stylesheet" href="{{asset("assets/CodeSeven/build/toastr.min.css")}}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <link rel="stylesheet" href="{{asset("assets/DataTable/dist/css/jquery.dataTables.min.css")}}">
        <link rel="stylesheet" href="{{asset("assets/DataTable/dist/css/dataTables.bootstrap.min.css")}}">
        <link rel="stylesheet" href="{{asset("assets/DataTable/Responsive/css/responsive.dataTables.min.css")}}">
        <link rel="stylesheet" href="{{asset("assets/DataTable/Buttons/css/buttons.dataTables.min.css")}}">
        <link rel="stylesheet" href="{{asset("assets/DataTable/AutoFill/css/autofill.dataTables.min.css")}}">
        <link rel="stylesheet" href="{{asset("assets/DataTable/RowReorder/css/rowReorder.dataTables.min.css")}}">
        <link rel="stylesheet" href="{{asset("assets/DataTable/RowReorder/css/rowReorder.bootstrap.min.css")}}">
        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400&display=swap" rel="stylesheet">
        @yield("styles")

    </head>

    <body class="skin-blue fixed sidebar-mini sidebar-mini-expand-feature sidebar-collapse skin-blue-light layout-footer-fixed">
        <!-- Site wrapper -->
        <div class="wrapper">
            <!--Inicio Header-->
            @include("Template/header")
            <!--Fin Header-->
            <!--Inicio Aside-->
            @include("Template/aside")
            <!--Fin Aside-->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content">
                    @yield('contenido')
                </section>
            </div>
            <!--Inicio Footer-->
            @include("Template/footer")
            <!--Fin Footer-->
        </div>
        <!-- jQuery-->
        <script src="{{asset("assets/bower_components/jquery/dist/jquery.min.js")}}"></script>
        <script src="{{asset("assets/dist/js/jquery-3.3.1.js")}}"></script>
        <script src="{{asset("assets/bower_components/bootstrap/dist/js/bootstrap.min.js")}}"></script>
        <script src="{{asset("assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js")}}"></script>
        <script src="{{asset("assets/bower_components/fastclick/lib/fastclick.js")}}"></script>
        <script src="{{asset("assets/dist/js/adminlte.min.js")}}"></script>
        <script src="{{asset("assets/dist/js/demo.js")}}"></script>
        <script src="{{asset("assets/dist/js/awesomplete.js")}}"></script>
        <script src="{{asset("assets/CodeSeven/build/toastr.min.js")}}"></script>
        <script src="{{asset("assets/DataTable/dist/js/jquery.dataTables.min.js")}}"></script>
        <script src="{{asset("assets/DataTable/dist/js/dataTables.bootstrap4.min.js")}}"></script>
        <script src="{{asset("assets/DataTable/Responsive/js/dataTables.responsive.min.js")}}"></script>
        <script src="{{asset("assets/DataTable/Buttons/js/dataTables.buttons.min.js")}}"></script>
        <script src="{{asset("assets/DataTable/Buttons/js/buttons.flash.min.js")}}"></script>
        <script src="{{asset("assets/DataTable/Buttons/js/buttons.html5.min.js")}}"></script>
        <script src="{{asset("assets/DataTable/Buttons/js/buttons.print.min.js")}}"></script>
        <script src="{{asset("assets/DataTable/JsZip/js/jszip.min.js")}}"></script>
        <script src="{{asset("assets/DataTable/PdfMake/js/pdfmake.min.js")}}"></script>
        <script src="{{asset("assets/DataTable/PdfMake/js/vfs_fonts.js")}}"></script>
        <script src="{{asset("assets/DataTable/AutoFill/js/dataTables.autoFill.min.js")}}"></script>
        <script src="{{asset("assets/DataTable/RowReorder/js/dataTables.rowReorder.min.js")}}"></script>
        <script src="{{asset("assets/bower_components/bootstrap-daterangepicker/daterangepicker.js")}}"></script>
        <script src="{{asset("assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js")}}"></script>
        <script src="{{asset("assets/bower_components/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js")}}"></script>
        <script src="{{asset("assets/bower_components/bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js")}}"></script>
        <script src="{{asset("assets/bower_components/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.es.js")}}"></script>
        @yield("scripts")

    </body>
</html>
