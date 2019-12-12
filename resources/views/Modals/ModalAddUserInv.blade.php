<div class="modal fade bd-example-modal-xl" id="modal-agregar-userInv" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title modal-title-primary"><b>Crear Responsable de Equipo Movil</b></h4>
            </div>
            {!! Form::open(['url' => 'asignacionResponsableMovil', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
            <div class="modal-body">
                <input type="hidden" name="IdUsuario" id="IdUsuario" value="{!! Session::get('IdUsuario') !!}">
                <input type="hidden" name="idMUR" id="mod_idMUR">
                <input type="hidden" name="NroLiena" id="mod_NroLinea">
                <div class="form-group">
                    <input type="hidden" name="idUsuarioInv" id="mod_idUsuarioInv">
                    <div class="row">
                        <div class="col-md-5">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Nombre Responsable</label>
                            {!! Form::text('nombre_usuario',$Nombre,['class'=>'form-control','id'=>'nombre_usuario','placeholder'=>'Nombre de la persona responsable del equipo']) !!}
                        </div>
                        <div class="col-md-2">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Nro. Cédula</label>
                            {!! Form::text('cedula',$Cedula,['class'=>'form-control','id'=>'cedula','placeholder'=>'Nro. de Cédula']) !!}
                        </div>
                        <div class="col-md-5">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Cargo</label>
                            {!! Form::text('cargo',$Cargo,['class'=>'form-control','id'=>'cargo','placeholder'=>'Cargo del Responsable']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Area</label>
                            {!! Form::select('area',$Areas,null,['class'=>'form-control','id'=>'area']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Sede</label>
                            {!! Form::select('sede',$Sedes,null,['class'=>'form-control','id'=>'sede']) !!}
                        </div>
                        <div class="col-md-4">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Centro de Costos</label>
                            {!! Form::text('centro_costos',$CentroCostos,['class'=>'form-control','id'=>'centro_costos','placeholder'=>'Centro de Costos']) !!}
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Crear Responsable</button>
            </div>
            {!!  Form::close() !!}

        </div>
    </div>
</div>
{{--  ACTUALIZACIÓN  --}}
<div class="modal fade bd-example-modal-xl" id="modal-update-responsable" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title modal-title-primary"><b>Actualizar Responsable de Equipo Movil</b></h4>
            </div>
            {!! Form::open(['url' => 'actualizarResponsableMovil', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
            <div class="modal-body">
                <input type="hidden" name="IdUsuario" id="IdUsuario" value="{!! Session::get('IdUsuario') !!}">
                <input type="hidden" name="idMURU" id="mod_idMURU">
                <input type="hidden" name="idLineaU" id="mod_idLineaU">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-5">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Nombre Responsable</label>
                            {!! Form::text('nombre_usuarioU',$Nombre,['class'=>'form-control','id'=>'mod_nombre_usuarioU','placeholder'=>'Nombre de la persona responsable del equipo']) !!}
                        </div>
                        <div class="col-md-2">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Nro. Cédula</label>
                            {!! Form::text('cedulaU',$Cedula,['class'=>'form-control','id'=>'mod_cedulaU','placeholder'=>'Nro. de Cédula']) !!}
                        </div>
                        <div class="col-md-5">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Cargo</label>
                            {!! Form::text('cargoU',$Cargo,['class'=>'form-control','id'=>'mod_cargoU','placeholder'=>'Cargo del Responsable']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Area</label>
                            {!! Form::select('areaU',$Areas,null,['class'=>'form-control','id'=>'mod_areaU']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Sede</label>
                            {!! Form::select('sedeU',$Sedes,null,['class'=>'form-control','id'=>'mod_sedeU']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Centro de Costos</label>
                            {!! Form::text('centro_costosU',$CentroCostos,['class'=>'form-control','id'=>'mod_centro_costosU','placeholder'=>'Centro de Costos']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Estado</label>
                            {!! Form::select('estadoU',$Estado,null,['class'=>'form-control','id'=>'mod_estadoU']) !!}
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Actualizar Responsable</button>
            </div>
            {!!  Form::close() !!}
        </div>
    </div>
</div>

        <script>
            function obtener_datos_usuarioInv(id) {
                $("#mod_idMUR").val(id);
            }
            function obtener_update_responsable(id) {

                var Cedula      = $("#cedula_responsable"+ id).val();
                var Nombre      = $("#nombre_responsable"+ id).val();
                var Cargo       = $("#cargo_responsable"+ id).val();
                var Area        = $("#area_responsable"+ id).val();
                var Sede        = $("#sede_responsable"+ id).val();
                var CentroCosto = $("#centroC_responsable"+ id).val();
                var Estado      = $("#estado"+ id).val();
                var IdLinea     = $("#id_mobile"+ id).val();

                $("#mod_idMURU").val(id);
                $("#mod_cedulaU").val(Cedula);
                $("#mod_nombre_usuarioU").val(Nombre);
                $("#mod_cargoU").val(Cargo);
                $("#mod_areaU").val(Area);
                $("#mod_sedeU").val(Sede);
                $("#mod_centro_costosU").val(CentroCosto);
                $("#mod_estadoU").val(Estado);
                $("#mod_idLineaU").val(IdLinea);
            }
        </script>
