@extends("Template.layoutMonitoreo")

@section('titulo')
Dahsboard
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
        <div class="box box-danger">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-3">
                            <div class="box-body">
                                <div class="callout callout-danger" style="background-color: #dd4b3978 !important;">
                                    <img src="{{asset("assets/Solicitud/support.png")}}" alt="image" style="width: 50%;margin: 10px 55px 10px 55px;"/>
                                    <h3 style="color:black;">Tenga en cuenta:</h3>

                                    <p style="color:black;font-size:2.2vh;text-align:justify;">
                                        <b>Incidente: </b>Es cualquier evento que interrumpa el funcionamiento normal de un servicio afectando ya sea a uno, a un grupo o a todos los usuarios de un servicio, un incidente se puede tomar como la reducción en la calidad de un servicio IT.<br>
                                    </p>
                                    <p style="color:black;font-size:2.2vh;text-align:justify;">
                                        <b>Requerimiento: </b>Se define como una solicitud formal por parte de un usuario para que algo sea provisto, como por ejemplo Instalaciones, movimientos, adiciones o cambios en los elementos o servicios provistos por la Dirección de TIC.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modal-solicitud"><i class="fa fa-plus-circle"></i>&nbsp;Crear Ticket</button>
                            <br>
                            <br>
                            <table id="solicitudes" class="display responsive hover" style="width: 100%;">
                                <thead style="background: linear-gradient(60deg,rgba(51,101,155,1),rgba(66,132,206,1));color: #ECF0F1;">
                                    <tr>
                                        <th style="text-align: center;font-size:2vh;">Nro</th>
                                        <th style="text-align: center;font-size:2vh;">Tipo</th>
                                        <th style="text-align: center;font-size:2vh;">Asunto</th>
                                        <th style="text-align: center;font-size:2vh;">Sede</th>
                                        <th style="text-align: center;font-size:2vh;">Area</th>
                                        <th style="text-align: center;font-size:2vh;">Estado</th>
                                        <th style="text-align: center;font-size:2vh;">Fecha Creación</th>
                                        <th style="text-align: center;font-size:2vh;">Fecha Actualización</th>
                                        <th style="text-align: center;font-size:2vh;">Revisar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{--  @foreach($Tickets as $value)
                                    <tr>
                                        <td>{{$value['id']}}</td>
                                        <td style="text-align:center;">{{$value['tipo_ticket']}}</td>
                                        <td>{{$value['title']}}</td>
                                        <td>{{$value['sede']}}</td>
                                        <td>{{$value['area']}}</td>
                                        <td style="text-align:center;"><span class="{{$value['label']}}" style="font-size:13px;"><b>{{$value['prioridad']}}</b></span></td>
                                        <td>{{$value['estado']}}</td>
                                        <td>{{$value['created_at']}}</td>
                                        <td>{{$value['asignado_por']}}</td>
                                        <td>{{$value['asignado_a']}}</td>
                                        <td>{{$value['updated_at']}}</td>
                                        <td><a href="#" class="btn btn-warning" title="Editar" data-toggle="modal" data-target="#modal-tickets-upd" onclick="obtener_datos_ticket('{{$value['id']}}');"><i class="glyphicon glyphicon-edit"></i></a></td>
                                        <input type="hidden" value="{{$value['id']}}" id="id{{$value['id']}}">
                                        <input type="hidden" value="{{$value['kind_id']}}" id="kind_id{{$value['id']}}">
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
                                        <input type="hidden" value="{{$value['tel_user']}}" id="tel_user{{$value['id']}}">
                                     </tr>
                                    @endforeach  --}}
                                </tbody>
                            </table>
                        </div>
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

