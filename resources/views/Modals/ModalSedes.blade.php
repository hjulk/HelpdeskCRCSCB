<div class="modal fade" id="modal-sedes">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="color: white;background-color: rgba(162, 27, 37, 1);">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Crear Sede</h4>
            </div>
            {!! Form::open(['action' => 'Admin\SedesController@crearSede', 'method' => 'post', 'enctype' => 'multipart/form-data','class' => 'form-horizontal','autocomplete'=>'off']) !!}
                <div class="modal-body">
                    <div class="box-body">

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nombre Sede</label>
                            <div class="col-sm-9">
                                {!! Form::text('nombre',$Sede,['class'=>'form-control','id'=>'nombre','placeholder'=>'Nombre Sede']) !!}
                                {{--  <input type="text" class="form-control" placeholder="Nombre Sede" id="sede" name="sede">  --}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Dirección</label>
                            <div class="col-sm-9">
                                {!! Form::text('descripcion',$Descripcion,['class'=>'form-control','id'=>'descripcion','placeholder'=>'Descripción de la Sede']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Crear Sede</button>
                </div>
            {!!  Form::close() !!}
        </div>
    </div>
</div>
<div class="modal fade bs-example-modal-md-udpS" id="modal-sedes-upd">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="color: white;background-color: rgba(162, 27, 37, 1);">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Actualizar Sede</h4>
                </div>
                {!! Form::open(['action' => 'Admin\SedesController@actualizarSede', 'method' => 'post', 'enctype' => 'multipart/form-data','class' => 'form-horizontal','autocomplete'=>'off']) !!}
                    <div class="modal-body">
                        <div class="box-body">
                                <input type="hidden" name="idS" id="mod_idS">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nombre Sede</label>
                                <div class="col-sm-9">
                                    {!! Form::text('nombre_upd',$Sede,['class'=>'form-control','id'=>'mod_nombre_upd','placeholder'=>'Nombre Sede']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Descripcion</label>
                                <div class="col-sm-9">
                                    {!! Form::text('descripcion_upd',$Descripcion,['class'=>'form-control','id'=>'mod_descripcion_upd','placeholder'=>'Descripción de la Sede']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label for="inputEmail3" class="col-sm-4 control-label">Activo</label>
                                    <div class="col-sm-4">
                                        {!! Form::select('activo',$Activo,null,['class'=>'form-control','id'=>'mod_activo_upd']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success">Actualizar Sede</button>
                    </div>
                {!!  Form::close() !!}
            </div>
        </div>
    </div>

    <script>
        function obtener_datos_sede(id) {
            var Nombre      = $("#name" + id).val();
            var Descripcion = $("#description" + id).val();
            var Activo      = $("#activo" + id).val();

            $("#mod_idS").val(id);
            $("#mod_nombre_upd").val(Nombre);
            $("#mod_descripcion_upd").val(Descripcion);
            $("#mod_activo_upd").val(Activo);
        }
    </script>
