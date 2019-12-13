@extends("Template.layout")

@section('titulo')
Tickets
@endsection

@section('contenido')

<section class="content-header">
    <h1>Tickets</h1>
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
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modal-tickets">Crear Ticket</button>
                        @if(Session::get('Administracion') === 1)
                            <button class="btn btn-success" data-toggle="modal" data-target="#modal-reabrir-tickets">Reabrir Ticket</button>
                        @endif
                        <br>
                        <br>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table id="tickets" class="display responsive hover" style="width: 100%;">
                            <thead style="background: linear-gradient(60deg,rgba(51,101,155,1),rgba(66,132,206,1));color: #ECF0F1;">
                                <tr>
                                    <th>Ticket</th>
                                    <th>Tipo</th>
                                    <th>Asunto</th>
                                    <th>Sede</th>
                                    <th>Area</th>
                                    <th>Prioridad</th>
                                    <th>Estado</th>
                                    <th>Creación</th>
                                    <th>Actualización</th>
                                    <th>Creador</th>
                                    <th>Asignado A</th>
                                    <th>Editar</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{--  @foreach($Tickets as $value)
                                <tr>
                                    <td>{{$value['id']}}</td>
                                    <td>{{$value['tipo']}}</td>
                                    <td>{{$value['titulo']}}</td>
                                    <td>{{$value['sede']}}</td>
                                    <td>{{$value['area']}}</td>
                                    <td><span class="{{$value['label']}}" style="font-size:13px;"><b>{{$value['prioridad']}}</b></span></td>
                                    <td>{{$value['estado']}}</td>
                                    <td>{{$value['fecha_creacion']}}</td>
                                    <td>{{$value['fecha_actualizacion']}}</td>
                                    <td>{{$value['creado_por']}}</td>
                                    <td>{{$value['asignado_a']}}</td>
                                    <td><a href="#" class="btn btn-warning" title="Editar" data-toggle="modal" data-target="#modal-tickets-upd" onclick="obtener_datos_ticket('{{$value['id']}}');"><i class="glyphicon glyphicon-edit"></i></a></td>
                                    <input type="hidden" value="{{$value['id']}}" id="id{{$value['id']}}">
                                    <input type="hidden" value="{{$value['id_tipo']}}" id="id_tipo{{$value['id']}}">
                                    <input type="hidden" value="{{$value['id_categoria']}}" id="id_categoria{{$value['id']}}">
                                    <input type="hidden" value="{{$value['id_zona']}}" id="id_zona{{$value['id']}}">
                                    <input type="hidden" value="{{$value['id_sede']}}" id="id_sede{{$value['id']}}">
                                    <input type="hidden" value="{{$value['id_area']}}" id="id_area{{$value['id']}}">
                                    <input type="hidden" value="{{$value['id_prioridad']}}" id="id_prioridad{{$value['id']}}">
                                    <input type="hidden" value="{{$value['id_estado']}}" id="id_estado{{$value['id']}}">
                                    <input type="hidden" value="{{$value['id_usuario']}}" id="id_usuario{{$value['id']}}">
                                    <input type="hidden" value="{{$value['titulo']}}" id="titulo{{$value['id']}}">
                                    <input type="hidden" value="{{$value['descripcion']}}" id="descripcion{{$value['id']}}">
                                    <input type="hidden" value="{{$value['evidencias']}}" id="evidencias{{$value['id']}}">
                                    <input type="hidden" value="{{$value['historial']}}" id="historial{{$value['id']}}">
                                    <input type="hidden" value="{{$value['nombre_usuario']}}" id="nombre_usuario{{$value['id']}}">
                                    <input type="hidden" value="{{$value['correo_usuario']}}" id="correo_usuario{{$value['id']}}">
                                    <input type="hidden" value="{{$value['telefono_usuario']}}" id="telefono_usuario{{$value['id']}}">
                                    <input type="hidden" value="{{$value['cargo_usuario']}}" id="cargo_usuario{{$value['id']}}">
                                    <input type="hidden" value="{{$value['nombre_jefe']}}" id="nombre_jefe{{$value['id']}}">
                                    <input type="hidden" value="{{$value['telefono_jefe']}}" id="telefono_jefe{{$value['id']}}">
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
{{--  @include('Modals.ModalTickets')
@include('Modals.ModalUpdTicket')  --}}
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
