<div class="modal fade bs-example-modal-lg-udpR" id="modal-roles-upd">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Actualizar Rol</h4>
                </div>

                {!! Form::open(['action' => 'Admin\RolesController@actualizarRol', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
                    <div class="modal-body">
                            <input type="hidden" name="idR" id="mod_idR">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label">Nombre Rol</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" placeholder="Nombre Rol" id="mod_rol" name="rol">
                                </div>
                            </div>
                            <br>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-4 control-label">Activo</label>
                                    <div class="col-sm-4">
                                                {!! Form::select('id_activo',$Activo,null,['class'=>'form-control','id'=>'mod_id_activoR']) !!}
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Actualizar Rol</button>
                    </div>
                {!!  Form::close() !!}
            </div>
        </div>

    </div>
    <div class="modal fade bs-example-modal-lg-udpC" id="modal-categorias-upd">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Actualizar Categoria</h4>
                    </div>

                    {!! Form::open(['action' => 'Admin\RolesController@actualizarCategoria', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
                        <div class="modal-body">
                                <input type="hidden" name="idC" id="mod_idC">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-4 control-label">Nombre Categoria</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" placeholder="Nombre Categoria" id="mod_categoria" name="categoria">
                                    </div>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-4 control-label">Activo</label>
                                    <div class="col-sm-4">
                                                {!! Form::select('id_activo',$Activo,null,['class'=>'form-control','id'=>'mod_id_activoC']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Actualizar Categoria</button>
                        </div>
                    {!!  Form::close() !!}
                </div>
            </div>

        </div>
        <script>
                function obtener_datos_rol(id) {
                    var nombre = $("#rol" + id).val();
                    var activa = $("#id_activo" + id).val();

                        $("#mod_idR").val(id);
                        $("#mod_rol").val(nombre);
                        $("#mod_id_activoR").val(activa);

                }
                function obtener_datos_categoria(id) {
                    var nombre = $("#categoria" + id).val();
                    var activa = $("#id_activo" + id).val();

                        $("#mod_idC").val(id);
                        $("#mod_categoria").val(nombre);
                        $("#mod_id_activoC").val(activa);

                }
        </script>
