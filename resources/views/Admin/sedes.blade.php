@extends("theme.$theme.layout")

@section('titulo')
Sedes
@endsection

@section('contenido')
<section class="content-header">
        <h1>Ubicación</h1>
        <ol class="breadcrumb">
          <li><a href="dashboard"><i class="fa fa-dashboard"></i> Inicio</a></li>
          <li>Admin</a></li>
          <li class="active">Ubicación</li>
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
                                <h3 class="box-title"><strong>Ubicacón</strong></h3>
                            </div>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d26750.941130324853!2d-74.12991636678325!3d4.673798400092502!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3f9b94535a070d%3A0xd6d5b588f7d5b0e!2sUT+SERVISALUD+SAN+JOS%C3%89!5e0!3m2!1ses-419!2sco!4v1564175811000!5m2!1ses-419!2sco" style="border:0;width: -webkit-fill-available;height: -webkit-fill-available;" allowfullscreen></iframe>
                        </div>
                        <div class="col-md-7">
                            <div class="box-header">
                                <h3 class="box-title"><strong>Areas</strong></h3>
                            </div>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modal-areas">Crear Area</button>
                            <br>
                            <br>
                            <table id="areas" class="display responsive hover" style="width: 100%;">
                                <thead style="background: linear-gradient(60deg,rgba(51,101,155,1),rgba(66,132,206,1));color: #ECF0F1;">
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombre</th>
                                            <th>Activa</th>
                                            <th>Editar</th>
                                        </tr>
                                </thead>
                                <tbody>
                                    @foreach($Areas as $area)
                                        <tr>
                                            <td>{{$area['id']}}</td>
                                            <td>{{$area['nombre']}}</td>
                                            <td>{{$area['activa']}}</td>
                                            <td><a href="#" class="btn btn-warning" title="Editar" onclick="obtener_datos_area('{{$area['id']}}');" data-toggle="modal" data-target=".bs-example-modal-lg-udpA"><i class="glyphicon glyphicon-edit"></i></a></td>
                                            <input type="hidden" value="{{$area['id']}}" id="id{{$area['id']}}">
                                            <input type="hidden" value="{{$area['nombre']}}" id="area{{$area['id']}}">
                                            <input type="hidden" value="{{$area['id_activa']}}" id="id_activa{{$area['id']}}">
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
                                <h3 class="box-title"><strong>Zonas</strong></h3>
                            </div>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modal-zonas">Crear Zona</button>
                            <br>
                            <br>
                            <table id="zonas" class="display responsive hover" style="width: 100%;">
                                    <thead style="background: linear-gradient(60deg,rgba(51,101,155,1),rgba(66,132,206,1));color: #ECF0F1;">
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombre</th>
                                            <th>Activa</th>
                                            <th>Editar</th>
                                        </tr>
                                </thead>
                                <tbody>
                                    @foreach($Zonas as $zona)
                                        <tr>
                                            <td>{{$zona['id']}}</td>
                                            <td>{{$zona['nombre']}}</td>
                                            <td>{{$zona['activa']}}</td>
                                            <td><a href="#" class="btn btn-warning" title="Editar" onclick="obtener_datos_zona('{{$zona['editar']}}');" data-toggle="modal" data-target=".bs-example-modal-lg-udpZ"><i class="glyphicon glyphicon-edit"></i></a></td>
                                            <input type="hidden" value="{{$zona['id']}}" id="id{{$zona['id']}}">
                                            <input type="hidden" value="{{$zona['nombre']}}" id="nombre{{$zona['id']}}">
                                            <input type="hidden" value="{{$zona['id_activa']}}" id="id_activa{{$zona['id']}}">
                                        </tr>

                                    @endforeach
                                </tbody>
                            </table>
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
                                            <th>Id</th>
                                            <th>Nombre</th>
                                            <th>Dirección</th>
                                            <th>Zona</th>
                                            <th>Activa</th>
                                            <th>Editar</th>
                                        </tr>
                                </thead>
                                <tbody>
                                    @foreach($Sedes as $sede)
                                        <tr>
                                            <td>{{$sede['id']}}</td>
                                            <td>{{$sede['nombre']}}</td>
                                            <td>{{$sede['direccion']}}</td>
                                            <td>{{$sede['zona']}}</td>
                                            <td>{{$sede['activa']}}</td>
                                            <td><a href="#" class="btn btn-warning" title="Editar" onclick="obtener_datos_sede('{{$sede['id']}}');" data-toggle="modal" data-target=".bs-example-modal-lg-udpS"><i class="glyphicon glyphicon-edit"></i></a></td>
                                            <input type="hidden" value="{{$sede['id']}}" id="id{{$sede['id']}}">
                                            <input type="hidden" value="{{$sede['nombre']}}" id="sede{{$sede['id']}}">
                                            <input type="hidden" value="{{$sede['direccion']}}" id="direccionSede{{$sede['id']}}">
                                            <input type="hidden" value="{{$sede['id_zona']}}" id="id_zona{{$sede['id']}}">
                                            <input type="hidden" value="{{$sede['id_activa']}}" id="id_activa{{$sede['id']}}">
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

    <script src="{{asset("assets/$theme/dist/js/sedes.js")}}"></script>
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
