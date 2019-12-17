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
        <div class="box box-success">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modal-ticket-usuario"><i class="fa fa-plus-circle"></i>&nbsp;Crear Ticket de Creación de Usuario</button>
                        @if(Session::get('Rol') === 1)
                            <button class="btn btn-success" data-toggle="modal" data-target="#modal-reabrir-ticket-usuario">Reabrir Ticket</button>
                        @endif
                        <br>
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table id="ticketsUsuario" class="display responsive hover" style="width: 100%;">
                            <thead style="background: linear-gradient(60deg,rgba(51,101,155,1),rgba(66,132,206,1));color: #ECF0F1;">
                                <tr>
                                    <th style="text-align: center;">Nro</th>
                                    <th style="text-align: center;">Nombre Usuario</th>
                                    <th style="text-align: center;">Nro. Identificación</th>
                                    <th style="text-align: center;">Cargo</th>
                                    <th style="text-align: center;">Sede</th>
                                    <th style="text-align: center;">Área</th>
                                    <th style="text-align: center;">Jefe Inmediato</th>
                                    <th style="text-align: center;">Fecha Ingreso</th>
                                    <th style="text-align: center;">Prioridad</th>
                                    <th style="text-align: center;">Estado</th>
                                    <th style="text-align: center;">RC</th>
                                    <th style="text-align: center;">IT</th>
                                    <th style="text-align: center;">Editar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($TicketUsuario as $value)
                                <tr style="font-size: 13px;">
                                    <td>{{$value['id']}}</td>
                                    <td>{{$value['nombres']}}</td>
                                    <td>{{$value['identificacion']}}</td>
                                    <td>{{$value['cargo']}}</td>
                                    <td>{{$value['nombre_sede']}}</td>
                                    <td>{{$value['area']}}</td>
                                    <td>{{$value['jefe']}}</td>
                                    <td>{{$value['fecha_ingreso']}}</td>
                                    <td><span class="{{$value['label']}}" style="font-size:13px;"><b>{{$value['prioridad']}}</b></span></td>
                                    <td>{{$value['nombre_estado']}}</td>
                                    <td>{{$value['estadorc']}}</td>
                                    <td>{{$value['estadoit']}}</td>
                                    <td><a href="#" class="btn btn-warning" title="Editar" data-toggle="modal" data-target="#modal-ticket-usuario-upd" onclick="obtener_datos_ticket_usuario('{{$value['id']}}');"><i class="glyphicon glyphicon-edit"></i></a></td>
                                    <input type="hidden" value="{{$value['id']}}" id="id{{$value['id']}}">
                                    {{--  <input type="hidden" value="{{$value['kind_id']}}" id="kind_id{{$value['id']}}">
                                    <input type="hidden" value="{{$value['category_id']}}" id="category_id{{$value['id']}}">
                                    <input type="hidden" value="{{$value['project_id']}}" id="project_id{{$value['id']}}">
                                    <input type="hidden" value="{{$value['priority_id']}}" id="priority_id{{$value['id']}}">
                                    <input type="hidden" value="{{$value['status_id']}}" id="status_id{{$value['id']}}">
                                    <input type="hidden" value="{{$value['user_id']}}" id="user_id{{$value['id']}}">
                                    <input type="hidden" value="{{$value['asigned_id']}}" id="asigned_id{{$value['id']}}">
                                    <input type="hidden" value="{{$value['title']}}" id="title{{$value['id']}}">
                                    <input type="hidden" value="{{$value['description']}}" id="description{{$value['id']}}">
                                    <input type="hidden" value="{{$value['area']}}" id="area{{$value['id']}}">
                                    <input type="hidden" value="{{$value['evidencia']}}" id="evidencia{{$value['id']}}">
                                    <input type="hidden" value="{{$value['historial']}}" id="historial{{$value['id']}}">
                                    <input type="hidden" value="{{$value['name_user']}}" id="name_user{{$value['id']}}">
                                    <input type="hidden" value="{{$value['user_email']}}" id="user_email{{$value['id']}}">
                                    <input type="hidden" value="{{$value['tel_user']}}" id="tel_user{{$value['id']}}">  --}}
                                 </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('Modals.ModalTicketUsuario')
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
    <script>
        $(function () {
            var today = new Date();
            var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
            var time = today.getHours() + ":" + today.getMinutes();
            var dateTime = date+' '+time;
            $('#fechaIngreso').datepicker({
                autoclose: true,
                language: 'es',
                todayBtn: true,
                format: 'dd/mm/yyyy'
            });
            $('#fechaIngreso').datepicker({
                autoclose: true,
                language: 'es',
                todayBtn: true,
                format: 'dd/mm/yyyy'
            });
        });
</script>


@endsection
