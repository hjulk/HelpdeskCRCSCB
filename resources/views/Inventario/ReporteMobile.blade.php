@extends("theme.$theme.layout")

@section('titulo')
Reporte Equipos Móviles
@endsection

@section('contenido')

<section class="content-header">
    <h1><i class="fa fa-list"></i>&nbsp;Reporte Equipos Móviles</h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li>Reporte Equipos Móviles</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="box box-success">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modal-mobile">Ingresar Novedad a Equipo Móvil</button>
                        <br>
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table id="mobile" class="display responsive hover" style="width: 100%;">
                            <thead style="background: linear-gradient(60deg,rgba(51,101,155,1),rgba(66,132,206,1));color: #ECF0F1;font-size:12px;text-align: center;">
                                <tr>
                                    <th style="text-align: center;">LINEA</th>
                                    <th style="text-align: center;">SERVICIO</th>
                                    <th style="text-align: center;">NOMBRE USUARIO</th>
                                    <th style="text-align: center;">CÉDULA</th>
                                    <th style="text-align: center;">CARGO</th>
                                    <th style="text-align: center;">AREA</th>
                                    <th style="text-align: center;">SEDE</th>
                                    <th style="text-align: center;">CENTRO COSTOS</th>
                                    <th style="text-align: center;">ESTADO</th>
                                    <th style="text-align: center;">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{--  @foreach($EquiposMoviles as $value)
                                    <tr>
                                        <td>{{$value['linea']}}</td>
                                        <td>{{$value['servicio']}}</td>
                                        <td>{{$value['nombre_usuario']}}</td>
                                        <td>{{$value['cedula']}}</td>
                                        <td>{{$value['cargo']}}</td>
                                        <td>{{$value['nombre_area']}}</td>
                                        <td>{{$value['nombre_sede']}}</td>
                                        <td>{{$value['centro_costos']}}</td>
                                        <td>{{$value['nombre_estado']}}</td>
                                        <td><a href="#" class="btn btn-warning" title="Editar" data-toggle="modal" data-target="#modal-cambios-mobile" onclick="obtener_datos_mobile('{{$value['id']}}');"><i class="fa fa-edit"></i></a>
                                        <a href="#" class="btn btn-primary" title="Agregar Responsable" data-toggle="modal" data-target="#modal-agregar-userInv" onclick="obtener_datos_usuarioInv('{{$value['id']}}');"><i class="fa fa-user-plus"></i></a></td>
                                        <input type="hidden" value="{{$value['id']}}" id="id{{$value['id']}}">
                                        <input type="hidden" value="{{$value['linea']}}" id="linea{{$value['id']}}">
                                        <input type="hidden" value="{{$value['operador']}}" id="operador{{$value['id']}}">
                                        <input type="hidden" value="{{$value['empresa']}}" id="empresa{{$value['id']}}">
                                        <input type="hidden" value="{{$value['plan']}}" id="plan{{$value['id']}}">
                                        <input type="hidden" value="{{$value['datos']}}" id="datos{{$value['id']}}">
                                        <input type="hidden" value="{{$value['minutos_claro']}}" id="minutos_claro{{$value['id']}}">
                                        <input type="hidden" value="{{$value['minutos_otro']}}" id="minutos_otro{{$value['id']}}">
                                        <input type="hidden" value="{{$value['sms_claro']}}" id="sms_claro{{$value['id']}}">
                                        <input type="hidden" value="{{$value['sms_otro']}}" id="sms_otro{{$value['id']}}">
                                        <input type="hidden" value="{{$value['equipo1']}}" id="equipo1{{$value['id']}}">
                                        <input type="hidden" value="{{$value['imei1']}}" id="imei1{{$value['id']}}">
                                        <input type="hidden" value="{{$value['equipo2']}}" id="equipo2{{$value['id']}}">
                                        <input type="hidden" value="{{$value['imei2']}}" id="imei2{{$value['id']}}">
                                        <input type="hidden" value="{{$value['equipo3']}}" id="equipo3{{$value['id']}}">
                                        <input type="hidden" value="{{$value['imei3']}}" id="imei3{{$value['id']}}">
                                        <input type="hidden" value="{{$value['fecha_corte']}}" id="fecha_corte{{$value['id']}}">
                                        <input type="hidden" value="{{$value['cargo_fijo']}}" id="cargo_fijo{{$value['id']}}">
                                        <input type="hidden" value="{{$value['servicio']}}" id="servicio{{$value['id']}}">
                                        <input type="hidden" value="{{$value['cuenta']}}" id="cuenta{{$value['id']}}">
                                        <input type="hidden" value="{{$value['nombre_usuario']}}" id="nombre_usuario{{$value['id']}}">
                                        <input type="hidden" value="{{$value['cedula']}}" id="cedula{{$value['id']}}">
                                        <input type="hidden" value="{{$value['cargo']}}" id="cargo{{$value['id']}}">
                                        <input type="hidden" value="{{$value['area']}}" id="area{{$value['id']}}">
                                        <input type="hidden" value="{{$value['sede']}}" id="sede{{$value['id']}}">
                                        <input type="hidden" value="{{$value['centro_costos']}}" id="centro_costos{{$value['id']}}">
                                        <input type="hidden" value="{{$value['estado']}}" id="estado{{$value['id']}}">
                                        <input type="hidden" value="{{$value['idUsuarioInv']}}" id="idUsuarioInv{{$value['id']}}">
                                        <input type="hidden" value="{{$value['responsables']}}" id="responsables{{$value['id']}}">
                                    </tr>
                                @endforeach  --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
    <script src="{{asset("assets/$theme/dist/js/inventario.js")}}"></script>
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
