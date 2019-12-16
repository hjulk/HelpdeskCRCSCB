@extends("Template.layout")

@section('titulo')
Tickets
@endsection

@section('contenido')

<section class="content-header">
    <h1>Tickets Creación de Usuario</h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li>Tickets</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modal-tickets">Crear Ticket de Creación de Usuario</button>
                        @if(Session::get('Rol') === 1)
                            <button class="btn btn-success" data-toggle="modal" data-target="#modal-reabrir-tickets">Reabrir Ticket</button>
                        @endif
                        <br>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')

    <script src="{{asset("assets/dist/js/tickets.js")}}"></script>
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



@endsection
