<div class="modal fade" id="modal-zonas">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Crear Zona</h4>
            </div>

            {!! Form::open(['action' => 'Admin\SedesController@crearZona', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-4 control-label">Nombre Zona</label>
                            <div class="col-sm-8">
                                {!! Form::text('zona',$Zona,['class'=>'form-control','id'=>'zona','placeholder'=>'Nombre Zona']) !!}
                                {{--  <input type="text" class="form-control" placeholder="Nombre Zona" id="zona" name="zona">  --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Crear Zona</button>
                </div>
            {!!  Form::close() !!}
        </div>
    </div>

</div>
<div class="modal fade bs-example-modal-lg-udpZ" id="modal-zonas-upd">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Actualizar Zona</h4>
            </div>

            {!! Form::open(['action' => 'Admin\SedesController@actualizarZona', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
                <div class="modal-body">

                    <div class="box-body">
                            <input type="hidden" name="idZ" id="mod_idZ">
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Nombre Zona</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="mod_zona" name="zona">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Activa</label>
                            <div class="col-sm-8">
                                {!! Form::select('id_activa',$activo,null,['class'=>'form-control','id'=>'mod_id_activaz']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Actualizar Zona</button>
                </div>
            {!!  Form::close() !!}
        </div>
    </div>

</div>
<div class="modal fade" id="modal-sedes">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Crear Sede</h4>
            </div>

            {!! Form::open(['action' => 'Admin\SedesController@crearSede', 'method' => 'post', 'enctype' => 'multipart/form-data','class' => 'form-horizontal']) !!}
                <div class="modal-body">
                    <div class="box-body">

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nombre Sede</label>
                            <div class="col-sm-9">
                                {!! Form::text('sede',$Sede,['class'=>'form-control','id'=>'sede','placeholder'=>'Nombre Sede']) !!}
                                {{--  <input type="text" class="form-control" placeholder="Nombre Sede" id="sede" name="sede">  --}}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Dirección</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Direccion Sede" id="direccionSede" name="direccionSede">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Zona</label>
                            <div class="col-sm-9">
                                {!! Form::select('tipoZona',$NombreZona,null,['class'=>'form-control','id'=>'tipoZona']) !!}
                            </div>
                        </div>

                    </div>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Crear Sede</button>
                </div>
            {!!  Form::close() !!}
        </div>
    </div>
</div>
<div class="modal fade bs-example-modal-lg-udpS" id="modal-sedes-upd">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Actualizar Sede</h4>
                </div>

                {!! Form::open(['action' => 'Admin\SedesController@actualizarSede', 'method' => 'post', 'enctype' => 'multipart/form-data','class' => 'form-horizontal']) !!}
                    <div class="modal-body">
                        <div class="box-body">
                                <input type="hidden" name="idS" id="mod_idS">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nombre Sede</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Nombre Sede" id="mod_sede" name="sede">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Dirección</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Direccion Sede" id="mod_direccionSede" name="direccionSede">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Zona</label>
                                <div class="col-sm-9">
                                    {!! Form::select('id_zona',$NombreZona,null,['class'=>'form-control','id'=>'mod_id_zona']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Activa</label>
                                <div class="col-sm-9">
                                    {!! Form::select('id_activa',$activo,null,['class'=>'form-control','id'=>'mod_id_activas']) !!}
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
<div class="modal fade" id="modal-areas">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Crear Área</h4>
                </div>

                {!! Form::open(['action' => 'Admin\SedesController@crearArea', 'method' => 'post', 'enctype' => 'multipart/form-data','class' => 'form-horizontal']) !!}
                    <div class="modal-body">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nombre Area</label>
                                <div class="col-sm-9">
                                    {!! Form::text('area',$Area,['class'=>'form-control','id'=>'area','placeholder'=>'Nombre Area']) !!}
                                    {{--  <input type="text" class="form-control" placeholder="Nombre Area" id="area" name="area">  --}}
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Crear Area</button>
                    </div>
                {!!  Form::close() !!}
            </div>
        </div>

    </div>
    <div class="modal fade bs-example-modal-lg-udpA" id="modal-areas-upd">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Actualizar Área</h4>
                    </div>

                    {!! Form::open(['action' => 'Admin\SedesController@actualizarArea', 'method' => 'post', 'enctype' => 'multipart/form-data','class' => 'form-horizontal']) !!}
                        <div class="modal-body">
                            <div class="box-body">
                                    <input type="hidden" name="idA" id="mod_idA">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Nombre Area</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" placeholder="Nombre Area" id="mod_area" name="area">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Activa</label>
                                    <div class="col-sm-9">
                                        {!! Form::select('id_activa',$activo,null,['class'=>'form-control','id'=>'mod_id_activaA']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success">Actualizar Area</button>
                        </div>
                    {!!  Form::close() !!}
                </div>
            </div>

        </div>
    <script>
    function obtener_datos_zona(id) {
        var nombre = $("#nombre" + id).val();
        var activa = $("#id_activa" + id).val();

            $("#mod_idZ").val(id);
            $("#mod_zona").val(nombre);
            $("#mod_id_activaz").val(activa);

    }

    function obtener_datos_sede(id) {
        var nombre = $("#sede" + id).val();
        var direccion = $("#direccionSede" + id).val();
        var id_zona = $("#id_zona" + id).val();
        var activa = $("#id_activa" + id).val();

            $("#mod_idS").val(id);
            $("#mod_sede").val(nombre);
            $("#mod_direccionSede").val(direccion);
            $("#mod_id_zona").val(id_zona);
            $("#mod_id_activas").val(activa);

    }

    function obtener_datos_area(id) {
        var nombre = $("#area" + id).val();

        var activa = $("#id_activa" + id).val();

            $("#mod_idA").val(id);
            $("#mod_area").val(nombre);
            $("#mod_id_activaA").val(activa);
    }

    function zonaFunc() {
        var selectBox = document.getElementById("tipoZonaArea");
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
