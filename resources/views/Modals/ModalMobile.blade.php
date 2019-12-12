<div class="modal fade bd-example-modal-xl" id="modal-mobile" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title modal-title-primary"><b>Crear Asignación de Equipo Movil</b></h4>
            </div>
            {!! Form::open(['url' => 'asignacionMovil', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
            <div class="modal-body">
                <input type="hidden" name="IdUsuario" id="IdUsuario" value="{!! Session::get('IdUsuario') !!}">
                <div class="form-group">
                    <legend style="color:#006891;text-align:center;">DATOS EQUIPO</legend>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Nro. Linea</label>
                            {!! Form::text('linea',$NumLinea,['class'=>'form-control','id'=>'linea','placeholder'=>'Nro. de Linea']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Operador</label>
                            {!! Form::text('operador',$Operador,['class'=>'form-control','id'=>'operador','placeholder'=>'Nombre Operador']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Empresa</label>
                            {!! Form::text('empresa',$Empresa,['class'=>'form-control','id'=>'empresa','placeholder'=>'Nombre Empresa']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Plan</label>
                            {!! Form::text('plan',$Plan,['class'=>'form-control','id'=>'plan','placeholder'=>'Tipo Plan']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Datos</label>
                            {!! Form::text('datos',$Datos,['class'=>'form-control','id'=>'datos','placeholder'=>'Total Datos']) !!}
                        </div>
                        <div class="col-md-2">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Minutos Claro</label>
                            {!! Form::text('minutos_claro',$MinutosClaro,['class'=>'form-control','id'=>'minutos_claro','placeholder'=>'Minutos']) !!}
                        </div>
                        <div class="col-md-2">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Minutos Otros</label>
                            {!! Form::text('minutos_otro',$MinutosOtros,['class'=>'form-control','id'=>'minutos_otro','placeholder'=>'Minutos']) !!}
                        </div>
                        <div class="col-md-2">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">SMS Claro</label>
                            {!! Form::text('sms_claro',$SmsClaro,['class'=>'form-control','id'=>'sms_claro','placeholder'=>'Mensajes Texto']) !!}
                        </div>
                        <div class="col-md-2">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">SMS Otros</label>
                            {!! Form::text('sms_otro',$SmsOtros,['class'=>'form-control','id'=>'sms_otro','placeholder'=>'Mensajes Texto']) !!}
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Equipo 1</label>
                            {!! Form::text('equipo1',$Equipo1,['class'=>'form-control','id'=>'equipo1','placeholder'=>'Marca Equipo']) !!}
                        </div>
                        <div class="col-md-2">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">IMEI 1</label>
                            {!! Form::text('imei1',$IMEI1,['class'=>'form-control','id'=>'imei1','placeholder'=>'IMEI Equipo']) !!}
                        </div>
                        <div class="col-md-2">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Equipo 2</label>
                            {!! Form::text('equipo2',$Equipo2,['class'=>'form-control','id'=>'equipo2','placeholder'=>'Marca Equipo']) !!}
                        </div>
                        <div class="col-md-2">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">IMEI 2</label>
                            {!! Form::text('imei2',$IMEI2,['class'=>'form-control','id'=>'imei2','placeholder'=>'IMEI Equipo']) !!}
                        </div>
                        <div class="col-md-2">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Equipo 3</label>
                            {!! Form::text('equipo3',$Equipo3,['class'=>'form-control','id'=>'equipo3','placeholder'=>'Marca Equipo']) !!}
                        </div>
                        <div class="col-md-2">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label"  style="font-size: 1.9vh;">IMEI 3</label>
                            {!! Form::text('imei3',$IMEI3,['class'=>'form-control','id'=>'imei3','placeholder'=>'IMEI Equipo']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Fecha Corte</label>
                            {!! Form::text('fecha_corte',$FechaCorte,['class'=>'form-control','id'=>'fecha_corte','placeholder'=>'Fecha de Corte']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Cargo Fijo</label>
                            {!! Form::text('cargo_fijo',$CargoFijo,['class'=>'form-control','id'=>'cargo_fijo','placeholder'=>'$ Cargo Fijo']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Servicio</label>
                            {!! Form::text('servicio',$Servicio,['class'=>'form-control','id'=>'servicio','placeholder'=>'Tipo Servicio']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Cuenta Claro / Movistar</label>
                            {!! Form::text('cuenta',$Cuenta,['class'=>'form-control','id'=>'cuenta','placeholder'=>'Nro. de Cuenta']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <legend style="color:#006891;text-align:center;">DATOS RESPONSABLE EQUIPO</legend>
                </div>
                <div class="form-group">
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
                        <div class="col-md-4">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Area</label>
                            {!! Form::select('area',$Areas,null,['class'=>'form-control','id'=>'area']) !!}
                        </div>
                        <div class="col-md-4">
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
                <button type="submit" class="btn btn-primary">Crear Asignación</button>
            </div>
            {!!  Form::close() !!}

        </div>
    </div>
</div>

<!-- ACTUALIZACION -->

<div class="modal fade bd-example-modal-xl" id="modal-cambios-mobile" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title modal-title-primary"><b>Actualizar Asignación de Equipo Movil</b></h4>
            </div>
            {!! Form::open(['url' => 'actualizacionMovil', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
            <div class="modal-body">
                <input type="hidden" name="IdUsuario" id="IdUsuario" value="{!! Session::get('IdUsuario') !!}">
                <input type="hidden" name="idMU" id="mod_idMU">
                <div class="form-group">
                        <legend style="color:#006891;text-align:center;">DATOS EQUIPO</legend>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Nro. Linea</label>
                            {!! Form::text('linea',$NumLinea,['class'=>'form-control','id'=>'mod_linea','placeholder'=>'Nro. de Linea']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Operador</label>
                            {!! Form::text('operador',$Operador,['class'=>'form-control','id'=>'mod_operador','placeholder'=>'Nombre Operador']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Empresa</label>
                            {!! Form::text('empresa',$Empresa,['class'=>'form-control','id'=>'mod_empresa','placeholder'=>'Nombre Empresa']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Plan</label>
                            {!! Form::text('plan',$Plan,['class'=>'form-control','id'=>'mod_plan','placeholder'=>'Tipo Plan']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Datos</label>
                            {!! Form::text('datos',$Datos,['class'=>'form-control','id'=>'mod_datos','placeholder'=>'Total Datos']) !!}
                        </div>
                        <div class="col-md-2">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Minutos Claro</label>
                            {!! Form::text('minutos_claro',$MinutosClaro,['class'=>'form-control','id'=>'mod_minutos_claro','placeholder'=>'Minutos']) !!}
                        </div>
                        <div class="col-md-2">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Minutos Otros</label>
                            {!! Form::text('minutos_otro',$MinutosOtros,['class'=>'form-control','id'=>'mod_minutos_otro','placeholder'=>'Minutos']) !!}
                        </div>
                        <div class="col-md-2">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">SMS Claro</label>
                            {!! Form::text('sms_claro',$SmsClaro,['class'=>'form-control','id'=>'mod_sms_claro','placeholder'=>'Mensajes Texto']) !!}
                        </div>
                        <div class="col-md-2">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">SMS Otros</label>
                            {!! Form::text('sms_otro',$SmsOtros,['class'=>'form-control','id'=>'mod_sms_otro','placeholder'=>'Mensajes Texto']) !!}
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Equipo 1</label>
                            {!! Form::text('equipo1',$Equipo1,['class'=>'form-control','id'=>'mod_equipo1','placeholder'=>'Marca Equipo']) !!}
                        </div>
                        <div class="col-md-2">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">IMEI 1</label>
                            {!! Form::text('imei1',$IMEI1,['class'=>'form-control','id'=>'mod_imei1','placeholder'=>'IMEI Equipo']) !!}
                        </div>
                        <div class="col-md-2">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Equipo 2</label>
                            {!! Form::text('equipo2',$Equipo2,['class'=>'form-control','id'=>'mod_equipo2','placeholder'=>'Marca Equipo']) !!}
                        </div>
                        <div class="col-md-2">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">IMEI 2</label>
                            {!! Form::text('imei2',$IMEI2,['class'=>'form-control','id'=>'mod_imei2','placeholder'=>'IMEI Equipo']) !!}
                        </div>
                        <div class="col-md-2">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Equipo 3</label>
                            {!! Form::text('equipo3',$Equipo3,['class'=>'form-control','id'=>'mod_equipo3','placeholder'=>'Marca Equipo']) !!}
                        </div>
                        <div class="col-md-2">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">IMEI 3</label>
                            {!! Form::text('imei3',$IMEI3,['class'=>'form-control','id'=>'mod_imei3','placeholder'=>'IMEI Equipo']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Fecha Corte</label>
                            {!! Form::text('fecha_corte',$FechaCorte,['class'=>'form-control','id'=>'mod_fecha_corte','placeholder'=>'Fecha de Corte']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Cargo Fijo</label>
                            {!! Form::text('cargo_fijo',$CargoFijo,['class'=>'form-control','id'=>'mod_cargo_fijo','placeholder'=>'$ Cargo Fijo']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Servicio</label>
                            {!! Form::text('servicio',$Servicio,['class'=>'form-control','id'=>'mod_servicio','placeholder'=>'Tipo Servicio']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Cuenta Claro / Movistar</label>
                            {!! Form::text('cuenta',$Cuenta,['class'=>'form-control','id'=>'mod_cuenta','placeholder'=>'Nro. de Cuenta']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <legend style="color:#006891;text-align:center;">DATOS RESPONSABLE EQUIPO</legend>
                </div>
                <div class="form-group">
                    <input type="hidden" name="idUsuarioInv" id="mod_idUsuarioInv">
                    <div class="row">
                        <div class="col-md-5">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Nombre Responsable</label>
                            {!! Form::text('nombre_usuario',$Nombre,['class'=>'form-control','id'=>'mod_nombre_usuario','placeholder'=>'Nombre de la persona responsable del equipo']) !!}
                        </div>
                        <div class="col-md-2">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Nro. Cédula</label>
                            {!! Form::text('cedula',$Cedula,['class'=>'form-control','id'=>'mod_cedula','placeholder'=>'Nro. de Cédula']) !!}
                        </div>
                        <div class="col-md-5">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Cargo</label>
                            {!! Form::text('cargo',$Cargo,['class'=>'form-control','id'=>'mod_cargo','placeholder'=>'Cargo del Responsable']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Area</label>
                            {!! Form::select('area',$Areas,null,['class'=>'form-control','id'=>'mod_area']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Sede</label>
                            {!! Form::select('sede',$Sedes,null,['class'=>'form-control','id'=>'mod_sede']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Centro de Costos</label>
                            {!! Form::text('centro_costos',$CentroCostos,['class'=>'form-control','id'=>'mod_centro_costos','placeholder'=>'Centro de Costos']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 1.9vh;">Estado</label>
                            <select class="form-control" id="mod_estado" name="estado">
                                <option value="">Seleccione: </option>
                                <option value="1">ACTIVO</option>
                                <option value="2">DE BAJA</option>
                                <option value="3">OBSOLETO</option>
                                <option value="4">EN REPOSICIÓN</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <legend style="color:#006891;text-align:center;">DATOS ANEXOS DEL EQUIPO</legend>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12" id="botones"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Actualizar Asignación</button>
            </div>
            {!!  Form::close() !!}

        </div>
    </div>
</div>

    <script>

        function obtener_datos_mobile(id) {

            var Linea           = $("#linea" + id).val();
            var Operador        = $("#operador" + id).val();
            var Empresa         = $("#empresa" + id).val();
            var Plan            = $("#plan" + id).val();
            var Datos           = $("#datos" + id).val();
            var MinutosClaro    = $("#minutos_claro" + id).val();
            var MinutosOtro     = $("#minutos_otro" + id).val();
            var SMSClaro        = $("#sms_claro" + id).val();
            var SMSOtro         = $("#sms_otro" + id).val();
            var Equipo1         = $("#equipo1" + id).val();
            var IMEI1           = $("#imei1" + id).val();
            var Equipo2         = $("#equipo2" + id).val();
            var IMEI2           = $("#imei2" + id).val();
            var Equipo3         = $("#equipo3" + id).val();
            var IMEI3           = $("#imei3" + id).val();
            var FechaCorte      = $("#fecha_corte" + id).val();
            var CargoFijo       = $("#cargo_fijo" + id).val();
            var Servicio        = $("#servicio" + id).val();
            var Cuenta          = $("#cuenta" + id).val();
            var NombreUsuario   = $("#nombre_usuario" + id).val();
            var Cedula          = $("#cedula" + id).val();
            var Cargo           = $("#cargo" + id).val();
            var Area            = $("#area" + id).val();
            var Sede            = $("#sede" + id).val();
            var CentroCosto     = $("#centro_costos" + id).val();
            var Estado          = $("#estado" + id).val();
            var UsuarioInv      = $("#idUsuarioInv" + id).val();
            var Botones         = $("#botones" + id).val();

            $("#mod_idMU").val(id);
            $("#mod_linea").val(Linea);
            $("#mod_operador").val(Operador);
            $("#mod_empresa").val(Empresa);
            $("#mod_plan").val(Plan);
            $("#mod_datos").val(Datos);
            $("#mod_minutos_claro").val(MinutosClaro);
            $("#mod_minutos_otro").val(MinutosOtro);
            $("#mod_sms_claro").val(SMSClaro);
            $("#mod_sms_otro").val(SMSOtro);
            $("#mod_equipo1").val(Equipo1);
            $("#mod_imei1").val(IMEI1);
            $("#mod_equipo2").val(Equipo2);
            $("#mod_imei2").val(IMEI2);
            $("#mod_equipo3").val(Equipo3);
            $("#mod_imei3").val(IMEI3);
            $("#mod_fecha_corte").val(FechaCorte);
            $("#mod_cargo_fijo").val(CargoFijo);
            $("#mod_servicio").val(Servicio);
            $("#mod_cuenta").val(Cuenta);
            $("#mod_nombre_usuario").val(NombreUsuario);
            $("#mod_cedula").val(Cedula);
            $("#mod_cargo").val(Cargo);
            $("#mod_area").val(Area);
            $("#mod_sede").val(Sede);
            $("#mod_centro_costos").val(CentroCosto);
            $("#mod_estado").val(Estado);
            $("#mod_idUsuarioInv").val(UsuarioInv);
            $("#mod_botones").val(Botones);

            document.getElementById('botones').innerHTML = Botones;
        }
    </script>
