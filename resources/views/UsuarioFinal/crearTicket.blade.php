@extends("Template.layoutMonitoreo")

@section('titulo')
Dahsboard
@endsection
@section('styles')
    <link rel="stylesheet" href="{{asset("assets/Solicitud/solicitud.css")}}">
@endsection
@section('contenido')

<section class="content-header">
    <h1><i class="fa fa-ticket"></i>&nbsp;Creación Ticket</h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Creación Ticket</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modal-solicitud"><i class="fa fa-plus-circle"></i>&nbsp;Crear Ticket</button>
                        <br>
                        <br>
                    </div>

                </div>
                <div class="row">
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@include('Modals.ModalSolicitud')
@section('scripts')
    <script src="{{asset("assets/dist/js/dashboard.js")}}"></script>
    <script>
        @if (session("mensaje"))
            toastr.success("{{ session("mensaje") }}");
        @endif

        @if (session("precaucion"))
            toastr.warning("{{ session("precaucion") }}");
        @endif

        @if (count($errors) > 0)
            @foreach($errors -> all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
    </script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    </script>
    <script>
        function mostrar(id) {
            if (id === '1') {
                $("#titulo").show();
            }else{
                $("#titulo").hide();
            }
        }
    </script>
    <script>
        function Area() {
            var selectBox = document.getElementById("project_id");
            var selectedValue = selectBox.options[selectBox.selectedIndex].value;
            var tipo = 'post';
            var select = document.getElementById("area");

            $.ajax({
                url: "{{route('buscarArea')}}",
                type: "get",
                data: {_method: tipo, id_sede: selectedValue},
                success: function (data) {
                    var vValido = data['valido'];

                    if (vValido === 'true') {
                        var ListUsuario = data['Usuario'];
                        select.options.length = 0;
                        for (index in ListUsuario) {
                            select.options[select.options.length] = new Option(ListUsuario[index], index);
                        }

                    }

                }
            });
        }
    </script>

    @endsection

