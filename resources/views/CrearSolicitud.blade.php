<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>HelpDesk | Crear Solicitud</title>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta http-equiv="cache-control" content="max-age=0" />
        <meta http-equiv="cache-control" content="no-cache" />
        <meta http-equiv="cache-control" content="no-store" />
        <meta http-equiv="cache-control" content="must-revalidate" />
        <meta http-equiv="expires" content="0" />
        <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
        <meta http-equiv="pragma" content="no-cache" />
        <link type="image/x-icon" rel="icon" href="{{asset("assets/dist/img/helpdesk.png")}}">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="{{asset("assets/Solicitud/bootstrap.min.css")}}" id="bootstrap-css">
        <link rel="stylesheet" href="{{asset("assets/Solicitud/solicitud.css")}}">
        <link rel="stylesheet" href="{{asset("assets/CodeSeven/build/toastr.min.css")}}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400&display=swap" rel="stylesheet">
    </head>

<div class="container contact">
	<div class="row">
		<div class="col-md-4">
			<div class="contact-info">
                {{--  <img src="{{asset("assets/Solicitud/support.png")}}" alt="image"/>  --}}
                <h2 style="color:white;">Crear Ticket</h2>
                <h4 style="color:white;">Tenga en cuenta:</h4>
                <br>

                <p style="color:white;font-size:2.2vh;text-align:justify;">
                    <b>Incidente: </b>Es cualquier evento que interrumpa el funcionamiento normal de un servicio afectando ya sea a uno, a un grupo o a todos los usuarios de un servicio, un incidente se puede tomar como la reducción en la calidad de un servicio IT.<br>
                </p>
                <p style="color:white;font-size:2.2vh;text-align:justify;">
                    <b>Requerimiento: </b>Se define como una solicitud formal por parte de un usuario para que algo sea provisto, como por ejemplo Instalaciones, movimientos, adiciones o cambios en los elementos o servicios provistos por la Dirección de TIC.
                </p>
			</div>
		</div>
		<div class="col-md-8">
			<div class="contact-form">
                {!! Form::open(['url' => 'nuevaSolicitud', 'method' => 'post', 'enctype' => 'multipart/form-data','autocomplete'=>'off']) !!}
                <fieldset>
				<div class="form-group">
                    <div class="row">
                        <div class="col-sm-4">
                            <label class="control-label col-sm-12" for="fname">Nombre Completo:</label>
                            {!! Form::text('nombre_usuario',null,['class'=>'form-control','id'=>'nombre_usuario','placeholder'=>'Nombres y Apellidos','required']) !!}
                        </div>
                        <div class="col-sm-3">
                            <label class="control-label col-sm-12" for="fname">Telefóno:</label>
                            {!! Form::text('telefono_usuario',null,['class'=>'form-control','id'=>'telefono_usuario','placeholder'=>'No. de telefóno del reportante','required']) !!}
                        </div>
                        <div class="col-sm-5">
                            <label class="control-label col-sm-12" for="fname">Correo Electrónico:</label>
                            {!! Form::email('correo_usuario',null,['class'=>'form-control','id'=>'correo_usuario','placeholder'=>'Correo electrónico corporativo','required']) !!}
                        </div>
                    </div>
				</div>
				<div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <label class="control-label col-sm-12" for="fname">Sede:</label>
                            {!! Form::select('project_id',$Sedes,null,['class'=>'form-control','id'=>'project_id','onchange'=>'Area();','required']) !!}
                        </div>
                        <div class="col-sm-6">
                            <label class="control-label col-sm-12" for="fname">Área / Dependencia:</label>
                            {{--  {!! Form::text('dependencia',null,['class'=>'form-control','id'=>'dependencia','required','placeholder'=>'Área u oficina del usuario']) !!}  --}}
                            {!! Form::select('area_id',$Areas,null,['class'=>'form-control','id'=>'area_id','required']) !!}
                        </div>
                    </div>
                </div>
				<div class="form-group">
                    <div class="row">
                        <div class="col-sm-3">
                            <label class="control-label col-sm-12" for="email">Tipo Ticket:</label>
                            {!! Form::select('kind_id',$Tipo,null,['class'=>'form-control','id'=>'kind_id','required']) !!}
                        </div>
                        <div class="col-sm-9">
                            <label class="control-label col-sm-12" for="email">Asunto</label>
                            {!! Form::select('asunto',$TicketRecurrente,null,['class'=>'form-control','id'=>'asunto','required','onChange'=>'mostrar(this.value);']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12" id="titulo" style="display: none;">
                            <label class="control-label col-sm-12" for="email">Cuál?</label>
                            {!! Form::text('title',null,['class'=>'form-control','id'=>'title','placeholder'=>'Asunto del Ticket']) !!}
                        </div>
                    </div>
                </div>
				<div class="form-group">
                    <div class="row">
                        <div class="col-sm-12">
                            <label class="control-label col-sm-12" for="comment">Descripción de la Solicitud:</label>
                            {!! Form::textarea('description',null,['class'=>'form-control','id'=>'description','placeholder'=>'Ingrese la descripción de la solicitud','rows'=>'3','required']) !!}
                        </div>
                    </div>
                </div>
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
				<div class="form-group">
                    <div class="row">
                        <div class="col-sm-9">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Anexar Evidencia al Ticket</label>
                            <input type="file" id="evidencia[]" name="evidencia[]" class="form-control" multiple="multiple" size="5120">
                            <div align="right"><small class="text-muted" style="font-size: 73%;">Tamaño maximo permitido (5MB), si se supera este tamaño, su archivo no será cargado.</small> <span id="cntDescripHechos" align="right"> </span></div>
                        </div>
                        <div class="col-sm-3" style="align-self: center;">
                            <button type="submit" class="btn btn-success">Crear Ticket</button>
                        </div>
                    </div>
                </div>
            </fieldset>
                {!!  Form::close() !!}
            </div>
		</div>
	</div>
</div>
    <script src="{{asset("assets/Solicitud/bootstrap.min.js")}}"></script>
    <script src="{{asset("assets/Solicitud/jquery.min.js")}}"></script>
    <script src="{{asset("assets/CodeSeven/build/toastr.min.js")}}"></script>
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
            var select = document.getElementById("area_id");

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
</html>
