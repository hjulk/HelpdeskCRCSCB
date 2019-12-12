<div class="modal fade bs-example-modal-lg-udpZ" id="modal-tickets-upd">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Actualizar Ticket</h4>
                </div>

                {!! Form::open(['url' => 'actualizarTicket', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
                <div class="modal-body">
                        <input type="hidden" name="IdUsuario" id="IdUsuario" value="{!! Session::get('IdUsuario') !!}">
                        <input type="hidden" name="idT" id="mod_idT">
                    <div class="box-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="exampleInputEmail1" class="col-sm-5 control-label">Tipo</label>
                                    {!! Form::select('id_tipo_upd',$NombreTipo,null,['class'=>'form-control','id'=>'mod_id_tipo','readonly']) !!}
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1" class="col-sm-5 control-label">Asunto</label>
                                    {!! Form::text('asunto_upd',$Asunto,['class'=>'form-control','id'=>'mod_asunto','placeholder'=>'Asunto del Ticket','readonly']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1" class="col-sm-8 control-label">Descripcion Solicitud</label>
                                    {!! Form::textarea('descripcion_upd',$Descripcion,['class'=>'form-control','id'=>'mod_descripcion','placeholder'=>'Ingrese la descripción de la solicitud','rows'=>'3','readonly']) !!}
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1" class="col-sm-8 control-label">Agregar Comentario</label>
                                    {!! Form::textarea('comentario',$Comentario,['class'=>'form-control','id'=>'comentario','placeholder'=>'Ingrese el comentario sobre la gestión del ticket','rows'=>'3']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="col-sm-8 control-label">Historial del Ticket</label>
                            {!! Form::textarea('historial',$Descripcion,['class'=>'form-control','id'=>'mod_historial','placeholder'=>'Ingrese la descripción de la solicitud','rows'=>'3','readonly']) !!}
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="exampleInputEmail1" class="col-sm-12 control-label">Nombre Usuario</label>
                                    {!! Form::text('nombre_usuario_upd',$Usuario,['class'=>'form-control','id'=>'mod_nombre_usuario','placeholder'=>'Nombre de quien reporta']) !!}
                                </div>
                                <div class="col-md-3">
                                    <label for="exampleInputEmail1" class="col-sm-5 control-label">Cargo</label>
                                    {!! Form::text('cargo_usuario_upd',$NombreCargo,['class'=>'form-control','id'=>'mod_cargo_usuario','placeholder'=>'Cargo Usuario']) !!}
                                </div>
                                <div class="col-md-3">
                                    <label for="exampleInputEmail1" class="col-md-5 control-label">Telefóno</label>
                                    {!! Form::text('telefono_usuario_upd',$TelefonoUsuario,['class'=>'form-control','id'=>'mod_telefono_usuario','placeholder'=>'No. de telefóno del reportante']) !!}
                                </div>
                                <div class="col-md-3">
                                    <label for="exampleInputEmail1" class="col-sm-5 control-label">Correo</label>
                                    {!! Form::text('correo_usuario_upd',$CorreoUsuario,['class'=>'form-control','id'=>'mod_correo_usuario','placeholder'=>'Correo(s) del reportante']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="exampleInputEmail1" class="col-sm-12 control-label">Nombre Jefe Directo</label>
                                    {!! Form::text('nombre_jefe',$NombreJefe,['class'=>'form-control','id'=>'mod_nombre_jefe','placeholder'=>'Nombre Jefe Directo']) !!}
                                </div>
                                <div class="col-md-4">
                                    <label for="exampleInputEmail1" class="col-md-12 control-label">Telefono Jefe</label>
                                    {!! Form::text('telefono_jefe',$TelefonoJefe,['class'=>'form-control','id'=>'mod_telefono_jefe','placeholder'=>'No. telefónico jefe']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="exampleInputEmail1" class="col-sm-5 control-label">Zona</label>
                                    {!! Form::select('id_zona_upd',$NombreZona,null,['class'=>'form-control','id'=>'mod_id_zona','readonly']) !!}
                                </div>
                                <div class="col-md-3">
                                    <label for="exampleInputEmail1" class="col-sm-5 control-label">Sede</label>
                                    {!! Form::select('id_sede_upd',$NombreSedes,null,['class'=>'form-control','id'=>'mod_id_sede','readonly']) !!}
                                </div>
                                <div class="col-md-3">
                                    <label for="exampleInputEmail1" class="col-sm-5 control-label">Área</label>
                                    {!! Form::select('id_area_upd',$NombreAreas,null,['class'=>'form-control','id'=>'mod_id_area','readonly']) !!}
                                </div>
                                <div class="col-md-3">
                                    <label for="exampleInputEmail1" class="col-sm-5 control-label">Prioridad</label>
                                    {!! Form::select('id_prioridad_upd',$NombrePrioridad,null,['class'=>'form-control','id'=>'mod_id_prioridad']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="exampleInputEmail1" class="col-sm-5 control-label">Categoria</label>
                                    {!! Form::select('id_categoriaupd',$NombreCategoria,null,['class'=>'form-control','id'=>'id_categoriaupd','onchange'=>'categoriaFuncUPD();']) !!}
                                </div>
                                <div class="col-md-3">
                                    <label for="exampleInputEmail1" class="col-sm-5 control-label">Asignado</label>
                                    {!! Form::select('id_usuarioupd',$NombreUsuario,null,['class'=>'form-control','id'=>'id_usuarioupd']) !!}
                                </div>
                                <div class="col-md-3">
                                    <label for="exampleInputEmail1" class="col-sm-5 control-label">Estado</label>
                                    {!! Form::select('id_estado_upd',$NombreEstadoUpd,null,['class'=>'form-control','id'=>'mod_id_estado']) !!}
                                </div>
                                <div class="col-md-3">
                                    <label for="exampleInputEmail1" class="col-sm-5 control-label">Evidencia</label>
                                    <input type="file" id="evidencia_upd[]" name="evidencia_upd[]" class="form-control" multiple>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <button type="button" id="VerAnexos" class="btn btn-success">Ver Anexos</button>
                                </div>
                                <div class="col-md-9">
                                    <div id="anexos"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Actualizar Ticket</button>
                </div>
                {!!  Form::close() !!}

            </div>
        </div>
    </div>
    <script>
        function obtener_datos_ticket(id) {
            var tipo                = $("#id_tipo" + id).val();
            var categoria           = $("#id_categoria" + id).val();
            var zona                = $("#id_zona" + id).val();
            var sede                = $("#id_sede" + id).val();
            var area                = $("#id_area" + id).val();
            var prioridad           = $("#id_prioridad" + id).val();
            var estado              = $("#id_estado" + id).val();
            var usuario             = $("#id_usuario" + id).val();
            var titulo              = $("#titulo" + id).val();
            var descripcion         = $("#descripcion" + id).val();
            var evidencias          = $("#evidencias" + id).val();
            var historial           = $("#historial" + id).val();
            var nombre_usuario      = $("#nombre_usuario" + id).val();
            var correo_usuario      = $("#correo_usuario" + id).val();
            var cargo_usuario       = $("#cargo_usuario" + id).val();
            var telefono_usuario    = $("#telefono_usuario" + id).val();
            var nombre_jefe         = $("#nombre_jefe" + id).val();
            var telefono_jefe       = $("#telefono_jefe" + id).val();

            $("#mod_idT").val(id);
            $("#mod_id_tipo").val(tipo);
            $("#mod_id_categoria").val(categoria);
            $("#mod_id_zona").val(zona);
            $("#mod_id_sede").val(sede);
            $("#mod_id_area").val(area);
            $("#mod_id_prioridad").val(prioridad);
            $("#mod_id_estado").val(estado);
            $("#mod_id_asignado").val(usuario);
            $("#mod_asunto").val(titulo);
            $("#mod_descripcion").val(descripcion);
            $("#mod_evidencias").val(evidencias);
            $("#mod_historial").val(historial);
            $("#mod_nombre_usuario").val(nombre_usuario);
            $("#mod_correo_usuario").val(correo_usuario);
            $("#mod_telefono_usuario").val(telefono_usuario);
            $("#mod_cargo_usuario").val(cargo_usuario);
            $("#mod_nombre_jefe").val(nombre_jefe);
            $("#mod_telefono_jefe").val(telefono_jefe);

            $("#VerAnexos").click(function(){
                document.getElementById('anexos').innerHTML = evidencias;
            });
        }
    </script>
    <script type="text/javascript">

        function categoriaFuncUPD() {
            var selectBox = document.getElementById("id_categoriaupd");
            var selectedValue = selectBox.options[selectBox.selectedIndex].value;
            var tipo = 'post';
            var select = document.getElementById("id_usuarioupd");

            $.ajax({
                url: "{{route('buscarCategoriaUPD')}}",
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

    </script>
