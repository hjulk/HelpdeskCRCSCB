@extends("template.layout")

@section('titulo')
Sedes
@endsection

@section('contenido')
<section class="content-header">
        <h1><i class="fa fa-map"></i> Sedes</h1>
        <ol class="breadcrumb">
          <li><a href="dashboard"><i class="fa fa-dashboard"></i> Inicio</a></li>
          <li>Admin</a></li>
          <li class="active">Sedes</li>
        </ol>
      </section>

<section class="content">

    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong></strong></h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="box-header">
                                <h3 class="box-title"><strong>Ubicación</strong></h3>
                            </div>
                            <iframe src="https://www.google.com/maps/d/embed?mid=1HMvwR7VKuf3WaAMajLb2UX1klC1X6hVt" style="border:0;width: -webkit-fill-available;height: -webkit-fill-available;" allowfullscreen=""></iframe>
                        </div>
                        <div class="col-md-7">
                            <div class="box-header">
                                <h3 class="box-title"><strong>Sedes</strong></h3>
                            </div>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modal-sedes">Crear Sede</button>
                            <br>
                            <br>
                            <table id="sedes" class="display responsive hover" style="width: 100%;">
                                    <thead style="background: linear-gradient(60deg,rgba(51,101,155,1),rgba(66,132,206,1));color: #ECF0F1;">
                                        <tr>
                                            <th style="text-align: center;">Id</th>
                                            <th style="text-align: center;">Nombre</th>
                                            <th style="text-align: center;">Descripción</th>
                                            <th style="text-align: center;">Activo</th>
                                            <th style="text-align: center;">Editar</th>
                                        </tr>
                                </thead>
                                <tbody>
                                    @foreach($Sedes as $sede)
                                        <tr>
                                            <td>{{$sede['id']}}</td>
                                            <td>{{$sede['name']}}</td>
                                            <td>{{$sede['description']}}</td>
                                            <td>{{$sede['name_activo']}}</td>
                                            <td style="text-align: center;"><a href="#" class="btn btn-warning" title="Editar" onclick="obtener_datos_sede('{{$sede['id']}}');" data-toggle="modal" data-target=".bs-example-modal-md-udpS"><i class="glyphicon glyphicon-edit"></i></a></td>
                                            <input type="hidden" value="{{$sede['id']}}" id="id{{$sede['id']}}">
                                            <input type="hidden" value="{{$sede['name']}}" id="name{{$sede['id']}}">
                                            <input type="hidden" value="{{$sede['description']}}" id="description{{$sede['id']}}">
                                            <input type="hidden" value="{{$sede['activo']}}" id="activo{{$sede['id']}}">
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</section>

@include('Modals.ModalSedes')

@endsection

@section('scripts')

    <script src="{{asset("assets/dist/js/sedes.js")}}"></script>
    <script>
        @if (session("mensaje"))
            toastr.success("{{ session("mensaje") }}");
        @endif

        @if(count($errors) > 0)
            @foreach($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
    </script>

@endsection
