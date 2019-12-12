<div class="modal fade" id="modal-tickets">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Crear Ticket</h4>
            </div>

            {!! Form::open(['url' => 'crearTicket', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
            <div class="modal-body">
                    <input type="hidden" name="IdUsuario" id="IdUsuario" value="{!! Session::get('IdUsuario') !!}">
                <div class="box-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="exampleInputEmail1" class="col-sm-5 control-label">Tipo</label>
                                {!! Form::select('id_tipo',$NombreTipo,null,['class'=>'form-control','id'=>'id_tipo']) !!}
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputEmail1" class="col-sm-5 control-label">Asunto</label>
                                {!! Form::text('asunto',$Asunto,['class'=>'form-control','id'=>'asunto','placeholder'=>'Asunto del Ticket']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="col-sm-5 control-label">Descripcion Solicitud</label>
                        {!! Form::textarea('descripcion',$Descripcion,['class'=>'form-control','id'=>'descripcion','placeholder'=>'Ingrese la descripción de la solicitud','rows'=>'3']) !!}
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="exampleInputEmail1" class="col-sm-12 control-label">Nombre Usuario</label>
                                {!! Form::text('nombre_usuario',$Usuario,['class'=>'form-control','id'=>'nombre_usuario','placeholder'=>'Nombre de quien reporta']) !!}
                            </div>
                            <div class="col-md-3">
                                <label for="exampleInputEmail1" class="col-sm-5 control-label">Cargo</label>
                                {!! Form::text('cargo_usuario',$NombreCargo,['class'=>'form-control','id'=>'cargo_usuario','placeholder'=>'Cargo Usuario']) !!}
                            </div>
                            <div class="col-md-3">
                                <label for="exampleInputEmail1" class="col-md-5 control-label">Telefóno</label>
                                {!! Form::text('telefono_usuario',$TelefonoUsuario,['class'=>'form-control','id'=>'telefono_usuario','placeholder'=>'No. de telefóno del reportante']) !!}
                            </div>
                            <div class="col-md-3">
                                <label for="exampleInputEmail1" class="col-sm-5 control-label">Correo</label>
                                {!! Form::text('correo_usuario',$CorreoUsuario,['class'=>'form-control','id'=>'correo_usuario','placeholder'=>'Correo(s) del reportante']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="exampleInputEmail1" class="col-sm-12 control-label">Nombre Jefe Directo</label>
                                {!! Form::text('nombre_jefe',$NombreJefe,['class'=>'form-control','id'=>'nombre_jefe','placeholder'=>'Nombre Jefe Directo']) !!}
                            </div>
                            <div class="col-md-4">
                                <label for="exampleInputEmail1" class="col-md-12 control-label">Telefono Jefe</label>
                                {!! Form::text('telefono_jefe',$TelefonoJefe,['class'=>'form-control','id'=>'telefono_jefe','placeholder'=>'No. telefónico jefe']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="exampleInputEmail1" class="col-sm-5 control-label">Zona</label>
                                {!! Form::select('id_zona',$NombreZona,null,['class'=>'form-control','id'=>'id_zona','onchange'=>'zonaFunc();']) !!}
                            </div>
                            <div class="col-md-3">
                                <label for="exampleInputEmail1" class="col-sm-5 control-label">Sede</label>
                                {!! Form::select('id_sede',$NombreSede,null,['class'=>'form-control','id'=>'id_sede','onchange'=>'sedeFunc();']) !!}
                            </div>
                            <div class="col-md-3">
                                <label for="exampleInputEmail1" class="col-sm-5 control-label">Área</label>
                                {!! Form::select('id_area',$NombreArea,null,['class'=>'form-control','id'=>'id_area']) !!}
                            </div>
                            <div class="col-md-3">
                                <label for="exampleInputEmail1" class="col-sm-5 control-label">Prioridad</label>
                                {!! Form::select('id_prioridad',$NombrePrioridad,null,['class'=>'form-control','id'=>'id_prioridad']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="exampleInputEmail1" class="col-sm-5 control-label">Categoria</label>
                                {!! Form::select('id_categoria',$NombreCategoria,null,['class'=>'form-control','id'=>'id_categoria','onchange'=>'categoriaFunc();']) !!}
                            </div>
                            <div class="col-md-3">
                                <label for="exampleInputEmail1" class="col-sm-5 control-label">Asignado</label>
                                {!! Form::select('id_usuario',$NombreUsuario,null,['class'=>'form-control','id'=>'id_usuario']) !!}
                            </div>
                            <div class="col-md-3">
                                <label for="exampleInputEmail1" class="col-sm-5 control-label">Estado</label>
                                {!! Form::select('id_estado',$NombreEstado,null,['class'=>'form-control','id'=>'id_estado']) !!}
                            </div>
                            <div class="col-md-3">
                                <label for="exampleInputEmail1" class="col-sm-5 control-label">Evidencia</label>
                                <input type="file" id="evidencia[]" name="evidencia[]" class="form-control" multiple>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Crear Ticket</button>
            </div>
            {!!  Form::close() !!}

        </div>
    </div>
</div>
<div class="modal fade" id="modal-reabrir-tickets">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Reabrir Ticket</h4>
                </div>

                {!! Form::open(['action' => 'Admin\TicketsController@reabrirTicket', 'method' => 'post', 'enctype' => 'multipart/form-data','class' => 'form-horizontal']) !!}
                <div class="modal-body">

                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">No. de Ticket</label>
                            <div class="col-sm-3">
                                {!! Form::number('id_ticket',$Asunto,['class'=>'form-control','id'=>'id_ticket','placeholder'=>'Nro. del Ticket']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Descripcion Apertura</label>
                            <div class="col-sm-8">
                                    {!! Form::textarea('descripcion_ticket',$Descripcion,['class'=>'form-control','id'=>'descripcion_ticket','placeholder'=>'Ingrese la descripción de la apertura','rows'=>'3']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Categoria</label>
                            <div class="col-sm-4">
                                {!! Form::select('id_categoriaT',$NombreCategoria,null,['class'=>'form-control','id'=>'id_categoriaT','onchange'=>'categoriaTFunc();']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Asignado</label>
                            <div class="col-sm-4">
                                    {!! Form::select('id_usuarioT',$NombreUsuario,null,['class'=>'form-control','id'=>'id_usuarioT']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Estado</label>
                            <div class="col-sm-4">
                                {!! Form::select('id_estadoT',$NombreEstadoA,null,['class'=>'form-control','id'=>'id_estadoT']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Prioridad</label>
                            <div class="col-sm-4">
                                {!! Form::select('id_prioridadT',$NombrePrioridad,null,['class'=>'form-control','id'=>'id_prioridadT']) !!}
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Abrir Ticket</button>
                </div>
                {!!  Form::close() !!}

            </div>
        </div>
    </div>
    <script type="text/javascript">

        function categoriaFunc() {
            var selectBox = document.getElementById("id_categoria");
            var selectedValue = selectBox.options[selectBox.selectedIndex].value;
            var tipo = 'post';
            var select = document.getElementById("id_usuario");

            $.ajax({
                url: "{{route('buscarCategoria')}}",
                type: "get",
                data: {_method: tipo, id_categoria: selectedValue},
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

        function categoriaTFunc() {
            var selectBox = document.getElementById("id_categoriaT");
            var selectedValue = selectBox.options[selectBox.selectedIndex].value;
            var tipo = 'post';
            var select = document.getElementById("id_usuarioT");

            $.ajax({
                url: "{{route('buscarCategoria')}}",
                type: "get",
                data: {_method: tipo, id_categoria: selectedValue},
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

        function zonaFunc() {
            var selectBox = document.getElementById("id_zona");
            var selectedValue = selectBox.options[selectBox.selectedIndex].value;
            var tipo = 'post';
            var select = document.getElementById("id_sede");

            $.ajax({
                url: "{{route('buscarZona')}}",
                type: "get",
                data: {_method: tipo, id_zona: selectedValue},
                success: function (data) {
                    var vValido = data['valido'];

                    if (vValido === 'true') {
                        var ListSedes = data['Sedes'];
                        select.options.length = 0;
                        for (index in ListSedes) {
                            select.options[select.options.length] = new Option(ListSedes[index], index);
                        }

                    }

                }
            });
        }



    </script>
