<div class="modal fade bd-example-modal-xl" id="modal-asignados" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="color: white;background-color: rgba(162, 27, 37, 1);">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title modal-title-primary">Asignar Equipo</h4>
            </div>
            {!! Form::open(['url' => 'ingresarAsignacion', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
            <div class="modal-body">
                <legend class="subtitle2" style="color: rgba(162, 27, 37, 1);">DATOS QUIPO</legend>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Tipo Equipo</label>
                            {!! Form::Select('tipo_equipo',$Equipos,null,['class'=>'form-control','id'=>'tipo_equipo','required','onchange'=>'equipoFunc();','required']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Marca - Serial</label>
                            {!! Form::Select('marca_serial',$Marca,null,['class'=>'form-control','id'=>'marca_serial']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Mouse</label>
                            {!! Form::Select('mouse',$Mouse,null,['class'=>'form-control','id'=>'mouse']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Pantalla</label>
                            {!! Form::Select('pantalla',$Pantalla,null,['class'=>'form-control','id'=>'pantalla']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Teclado</label>
                            {!! Form::Select('teclado',$Teclado,null,['class'=>'form-control','id'=>'teclado']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Requiere Guaya</label>
                            {!! Form::Select('opcion',$Opcion,null,['class'=>'form-control','id'=>'opcion','onChange'=>'mostrar(this.value);',]) !!}
                        </div>
                        <div class="col-md-3" id="guaya_op" style="display: none;">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Guaya</label>
                            {!! Form::Select('guaya',$Guaya,null,['class'=>'form-control','id'=>'guaya']) !!}
                        </div>
                        <div class="col-md-3" id="guaya_op1" style="display: none;">
                            <input type="radio" id="tipo_guaya" name="tipo_guaya" value="1" onclick="code_guaya.disabled = false;id_guaya.disabled = false"> Con Clave&nbsp;&nbsp;&nbsp;
                            <input type="radio" id="tipo_guaya" name="tipo_guaya" value="2" onclick="code_guaya.disabled = true;id_guaya.disabled = false"> Con Llave&nbsp;&nbsp;&nbsp;
                            {!! Form::text('code_guaya',null,['class'=>'form-control','id'=>'code_guaya','placeholder'=>'Clave Guaya','disabled']) !!}
                        </div>
                    </div>
                </div>
                <legend class="subtitle2" style="color: rgba(162, 27, 37, 1);">DATOS USUARIO</legend>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Sede</label>
                            {!! Form::Select('sede',$Sede,null,['class'=>'form-control','id'=>'sede']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Area</label>
                            {!! Form::text('area',null,['class'=>'form-control','id'=>'area','placeholder'=>'Area Usuario']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Nombre Asignado</label>
                            {!! Form::text('nombre_asignado',null,['class'=>'form-control','id'=>'nombre_asignado','placeholder'=>'Nombre Usuario']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Cargo</label>
                            {!! Form::text('cargo',null,['class'=>'form-control','id'=>'cargo','placeholder'=>'Cargo Usuario']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Cédula</label>
                            {!! Form::text('cedula',null,['class'=>'form-control','id'=>'cedula','placeholder'=>'Cedula Usuario']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label">No. Telefónico</label>
                            {!! Form::text('telefono',null,['class'=>'form-control','id'=>'telefono','placeholder'=>'Telefono Usuario']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Correo</label>
                            {!! Form::text('correo',null,['class'=>'form-control','id'=>'correo','placeholder'=>'Correo Usuario']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label">No. Ticket</label>
                            {!! Form::text('ticket',null,['class'=>'form-control','id'=>'ticket','placeholder'=>'Ticket Asignacion']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Fecha Asignación</label>
                            {!! Form::text('fecha_adquision',$FechaAsignacion,['class'=>'form-control','id'=>'fecha_adquision','placeholder'=>'Fecha de Asignación']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Estado Asignación</label>
                            {!! Form::select('estado',$Estado,null,['class'=>'form-control','id'=>'estado']) !!}
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Evidencia</label>
                            <input type="file" id="evidencia[]" name="evidencia[]" class="form-control" multiple>
                            <div align="right"><small class="text-muted" style="font-size: 73%;">Tamaño maximo permitido (5MB), si se supera este tamaño, su archivo no será cargado.</small> <span id="cntDescripHechos" align="right"> </span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success">Crear Asignación</button>
            </div>
            {!!  Form::close() !!}
        </div>
    </div>
</div>

    <script>
        function equipoFunc() {
            var selectBox = document.getElementById("tipo_equipo");
            var selectedValue = selectBox.options[selectBox.selectedIndex].value;
            var tipo = 'post';
            var select = document.getElementById("marca_serial");

            $.ajax({
                url: "{{route('buscarEquipo')}}",
                type: "get",
                data: {_method: tipo, tipo_equipo: selectedValue},
                success: function (data) {
                    var vValido = data['valido'];

                    if (vValido === 'true') {
                        var ListUsuario = data['Equipo'];
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
        function mostrar(id) {
            if (id === '1') {
                $("#guaya_op").show();
                $("#guaya_op1").show();
            }else{
                $("#guaya_op").hide();
                $("#guaya_op1").hide();
            }
        }
        function mostrarUpd(id) {
            if (id === '1') {
                $("#guaya_op_upd").show();
                $("#guaya_op1_upd").show();
            }else{
                $("#guaya_op_upd").hide();
                $("#guaya_op1_upd").hide();
            }
        }
    </script>
    <script>
        function obtener_datos_asignado(id){

            var TipoEquipo  = $("#tipo_equipo" + id).val();
            var IdEquipo    = $("#id_equipo" + id).val();
            var IdMouse     = $("#id_mouse" + id).val();

            var Evidencia       = $("#evidencia" + id).val();
            var Historial       = $("#historial" + id).val();

            $("#mod_idA").val(id);

            $("#mod_evidencia").val(Evidencia);
            $("#mod_historial").val(Historial);

            $("#VerAnexosA").click(function(){
                document.getElementById('anexosA').innerHTML = Evidencia;
            });
        }
    </script>
