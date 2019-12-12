<div class="modal fade" id="modal-cambios-upd">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Actualizar Solicitud Control de Cambios</h4>
                </div>

                {!! Form::open(['url' => 'actualizarSolicitud', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
                <div class="modal-body">
                        <input type="hidden" name="IdUsuario" id="IdUsuario" value="{!! Session::get('IdUsuario') !!}">
                        <input type="hidden" name="idCC" id="mod_idCC">
                    <div class="box-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="exampleInputEmail1" class="col-sm-5 control-label">Impacto</label>
                                    {!! Form::select('id_impactoC',$NombreImpacto,null,['class'=>'form-control','id'=>'mod_id_impacto']) !!}
                                </div>
                                <div class="col-md-4">
                                    <label for="exampleInputEmail1" class="col-sm-6 control-label">Plataforma Core</label>
                                    {!! Form::select('id_plataformaC',$NombrePlataforma,null,['class'=>'form-control','id'=>'mod_id_plataforma','readonly']) !!}
                                </div>
                                <div class="col-md-2">
                                    <label for="exampleInputEmail1" class="col-sm-5 control-label">Ambiente</label>
                                    {!! Form::select('id_ambienteC',$NombreAmbiente,null,['class'=>'form-control','id'=>'mod_id_ambiente']) !!}
                                </div>
                                <div class="col-md-4">
                                    <label for="exampleInputEmail1" class="col-sm-10 control-label">Fecha Estimada Publicación</label>
                                    {!! Form::text('fecha_publicacionC',$FechaPublicacion,['class'=>'form-control','id'=>'mod_fecha_publicacion','placeholder'=>'Fecha estimada publicación']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1" class="col-sm-5 control-label">Descripcion Solicitud</label>
                                    {!! Form::textarea('descripcionC',$Descripcion,['class'=>'form-control','id'=>'mod_descripcion','placeholder'=>'Ingrese la descripción de la solicitud','rows'=>'3','readonly']) !!}
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1" class="col-sm-5 control-label">Agregar Comentario</label>
                                    {!! Form::textarea('comentarioC',$Comentario,['class'=>'form-control','id'=>'comentarioC','placeholder'=>'Ingrese el comentario sobre la gestión de la solicitud','rows'=>'3']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="col-sm-5 control-label">Historial de la solicitud</label>
                            {!! Form::textarea('historialC',$Descripcion,['class'=>'form-control','id'=>'mod_historial','placeholder'=>'Ingrese la descripción de la solicitud','rows'=>'3','readonly']) !!}
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="exampleInputEmail1" class="col-sm-12 control-label">Nombre Usuario</label>
                                    {!! Form::text('nombre_solicitante',$NombreUsuario,['class'=>'form-control','id'=>'mod_nombre_solicitante','placeholder'=>'Nombre de quien reporta']) !!}
                                </div>
                                <div class="col-md-3">
                                    <label for="exampleInputEmail1" class="col-md-5 control-label">Cargo</label>
                                    {!! Form::text('cargo_solicitante',$NombreCargo,['class'=>'form-control','id'=>'mod_cargo_solicitante','placeholder'=>'Cargo Usuario']) !!}
                                </div>
                                <div class="col-md-3">
                                    <label for="exampleInputEmail1" class="col-md-5 control-label">Telefóno</label>
                                    {!! Form::text('telefono_solicitante',$TelefonoUsuario,['class'=>'form-control','id'=>'mod_telefono_solicitante','placeholder'=>'No. de telefóno del reportante']) !!}
                                </div>
                                <div class="col-md-3">
                                    <label for="exampleInputEmail1" class="col-sm-5 control-label">Correo</label>
                                    {!! Form::text('correo_solicitante',$CorreoUsuario,['class'=>'form-control','id'=>'mod_correo_solicitante','placeholder'=>'Correo(s) del reportante']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="exampleInputEmail1" class="col-sm-12 control-label">Nombre Jefe Directo</label>
                                    {!! Form::text('nombre_jefe',$NombreUsuario,['class'=>'form-control','id'=>'mod_nombre_jefe','placeholder'=>'Nombre Jefe Directo']) !!}
                                </div>
                                <div class="col-md-3">
                                    <label for="exampleInputEmail1" class="col-md-12 control-label">Telefono Jefe</label>
                                    {!! Form::text('telefono_jefe',$NombreCargo,['class'=>'form-control','id'=>'mod_telefono_jefe','placeholder'=>'No. Telefono Jefe']) !!}
                                </div>
                                <div class="col-md-3">
                                    <label for="exampleInputEmail1" class="col-sm-5 control-label">Categoria</label>
                                    {!! Form::select('id_categoriaCUPD',$NombreCategoria,null,['class'=>'form-control','id'=>'id_categoriaCUPD','onchange'=>'categoriaCUPDFunc();']) !!}
                                </div>
                                <div class="col-md-3">
                                    <label for="exampleInputEmail1" class="col-sm-5 control-label">Asignado</label>
                                    {!! Form::select('id_usuarioCUPD',$Usuario,null,['class'=>'form-control','id'=>'id_usuarioCUPD']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">

                                <div class="col-md-3">
                                    <label for="exampleInputEmail1" class="col-sm-5 control-label">Estado</label>
                                    {!! Form::select('id_estadoC',$NombreEstadoUpd,null,['class'=>'form-control','id'=>'mod_id_estado']) !!}
                                </div>
                                <div class="col-md-3">
                                    <label for="exampleInputEmail1" class="col-sm-12 control-label">Escalamiento Proveedor</label>
                                    {!! Form::select('escalamientoC',$NombreEscalamiento,null,['class'=>'form-control','id'=>'mod_escalamiento']) !!}
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1" class="col-sm-5 control-label">Evidencia</label>
                                    <input type="file" id="evidenciaCambio_upd[]" name="evidenciaCambio_upd[]" class="form-control" multiple>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <button type="button" id="VerAnexosC" class="btn btn-success">Ver Anexos</button>
                                </div>
                                <div class="col-md-9">
                                    <div id="anexosCambio"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Actualizar Solicitud</button>
                </div>
                {!!  Form::close() !!}

            </div>
        </div>
    </div>
    <script>


            function categoriaCUPDFunc() {
                var selectBox = document.getElementById("id_categoriaCUPD");
                var selectedValue = selectBox.options[selectBox.selectedIndex].value;
                var tipo = 'post';
                var select = document.getElementById("id_usuarioCUPD");

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
        </script>
        <script>
            function obtener_datos_solicitud(id) {
                var impacto             = $("#id_impacto" + id).val();
                var plataforma          = $("#id_plataforma" + id).val();
                var ambiente            = $("#id_ambiente" + id).val();
                var FechaPublicacion    = $("#fecha_publicacion" + id).val();
                var categoria           = $("#id_categoria" + id).val();
                var usuario             = $("#asignado_a" + id).val();
                var estado              = $("#id_estado" + id).val();
                var descripcion         = $("#descripcion" + id).val();
                var historial           = $("#historial" + id).val();
                var nombre_solicitante  = $("#nombre_solicitante" + id).val();
                var correo_solicitante  = $("#correo_solicitante" + id).val();
                var telefono_solicitante= $("#telefono_solicitante" + id).val();
                var cargo_solicitante   = $("#cargo_solicitante" + id).val();
                var nombre_jefe         = $("#nombre_jefe" + id).val();
                var telefono_jefe       = $("#telefono_jefe" + id).val();
                var escalamiento        = $("#escalamiento" + id).val();
                var evidencias          = $("#evidencias_cambio" + id).val();

                $("#mod_idCC").val(id);
                $("#mod_id_impacto").val(impacto);
                $("#mod_id_plataforma").val(plataforma);
                $("#mod_id_ambiente").val(ambiente);
                $("#mod_fecha_publicacion").val(FechaPublicacion);
                $("#mod_id_usuarioCUPD").val(usuario);
                $("#mod_id_categoriaCUPD").val(categoria);
                $("#mod_id_estado").val(estado);
                $("#mod_descripcion").val(descripcion);
                $("#mod_cargo_solicitante").val(cargo_solicitante);
                $("#mod_historial").val(historial);
                $("#mod_escalamiento").val(escalamiento);
                $("#mod_nombre_solicitante").val(nombre_solicitante);
                $("#mod_correo_solicitante").val(correo_solicitante);
                $("#mod_telefono_solicitante").val(telefono_solicitante);
                $("#mod_nombre_jefe").val(nombre_jefe);
                $("#mod_telefono_jefe").val(telefono_jefe);
                $("#mod_evidenciasCambio").val(evidencias);

                $("#VerAnexosC").click(function(){
                    document.getElementById('anexosCambio').innerHTML = evidencias;
                });
            }


        </script>

