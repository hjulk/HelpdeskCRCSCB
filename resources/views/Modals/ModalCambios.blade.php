<div class="modal fade" id="modal-cambios">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title modal-title-primary">Crear Solicitud Control de Cambios</h4>
                </div>

                {!! Form::open(['url' => 'crearSolicitud', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
                <div class="modal-body">
                        <input type="hidden" name="IdUsuario" id="IdUsuario" value="{!! Session::get('IdUsuario') !!}">
                    <div class="box-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="exampleInputEmail1" class="col-sm-12 control-label">Impacto</label>
                                    {!! Form::select('id_impacto',$NombreImpacto,null,['class'=>'form-control','id'=>'id_impacto']) !!}
                                </div>
                                <div class="col-md-4">
                                    <label for="exampleInputEmail1" class="col-sm-12 control-label">Plataforma Core</label>
                                    {!! Form::select('id_plataforma',$NombrePlataforma,null,['class'=>'form-control','id'=>'id_plataforma']) !!}
                                </div>
                                <div class="col-md-2">
                                    <label for="exampleInputEmail1" class="col-sm-12 control-label">Ambiente</label>
                                    {!! Form::select('id_ambiente',$NombreAmbiente,null,['class'=>'form-control','id'=>'id_ambiente']) !!}
                                </div>
                                <div class="col-md-4">
                                    <label for="exampleInputEmail1" class="col-sm-12 control-label">Fecha Estimada Publicación</label>
                                    {!! Form::text('fecha_publicacion',$FechaPublicacion,['class'=>'form-control','id'=>'fecha_publicacion','placeholder'=>'Fecha estimada publicación']) !!}
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
                                    {!! Form::text('nombre_solicitante',$NombreUsuario,['class'=>'form-control','id'=>'nombre_solicitante','placeholder'=>'Nombre de quien reporta']) !!}
                                </div>
                                <div class="col-md-3">
                                    <label for="exampleInputEmail1" class="col-md-5 control-label">Cargo</label>
                                    {!! Form::text('cargo_solicitante',$NombreCargo,['class'=>'form-control','id'=>'cargo_solicitante','placeholder'=>'Cargo Usuario']) !!}
                                </div>
                                <div class="col-md-3">
                                    <label for="exampleInputEmail1" class="col-md-5 control-label">Telefóno</label>
                                    {!! Form::text('telefono_solicitante',$TelefonoUsuario,['class'=>'form-control','id'=>'telefono_solicitante','placeholder'=>'No. de telefóno del reportante']) !!}
                                </div>
                                <div class="col-md-3">
                                    <label for="exampleInputEmail1" class="col-sm-5 control-label">Correo</label>
                                    {!! Form::text('correo_solicitante',$CorreoUsuario,['class'=>'form-control','id'=>'correo_solicitante','placeholder'=>'Correo(s) del reportante']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="exampleInputEmail1" class="col-sm-12 control-label">Nombre Jefe Directo</label>
                                        {!! Form::text('nombre_jefe',$NombreUsuario,['class'=>'form-control','id'=>'nombre_jefe','placeholder'=>'Nombre Jefe Directo']) !!}
                                    </div>
                                    <div class="col-md-3">
                                        <label for="exampleInputEmail1" class="col-md-12 control-label">Telefono Jefe</label>
                                        {!! Form::text('telefono_jefe',$NombreCargo,['class'=>'form-control','id'=>'telefono_jefe','placeholder'=>'No. telefónico jefe']) !!}
                                    </div>
                                    <div class="col-md-3">
                                        <label for="exampleInputEmail1" class="col-sm-5 control-label">Categoria</label>
                                        {!! Form::select('id_categoriaC',$NombreCategoria,null,['class'=>'form-control','id'=>'id_categoriaC','onchange'=>'categoriaCFunc();']) !!}
                                    </div>
                                    <div class="col-md-3">
                                        <label for="exampleInputEmail1" class="col-sm-5 control-label">Asignado</label>
                                        {!! Form::select('id_usuarioC',$Usuario,null,['class'=>'form-control','id'=>'id_usuarioC']) !!}
                                    </div>
                                </div>
                            </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="exampleInputEmail1" class="col-sm-5 control-label">Estado</label>
                                    {!! Form::select('id_estado',$NombreEstado,null,['class'=>'form-control','id'=>'id_estado']) !!}
                                </div>
                                <div class="col-md-3">
                                    <label for="exampleInputEmail1" class="col-sm-12 control-label">Escalamiento Proveedor</label>
                                    {!! Form::select('escalamiento',$NombreEscalamiento,null,['class'=>'form-control','id'=>'escalamiento']) !!}
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleInputEmail1" class="col-sm-5 control-label">Evidencia</label>
                                    <input type="file" id="evidenciaCambio[]" name="evidenciaCambio[]" class="form-control" multiple>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Crear Solicitud</button>
                </div>
                {!!  Form::close() !!}

            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-reabrir-solicitud">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Reabrir Solicitud</h4>
                    </div>

                    {!! Form::open(['action' => 'Admin\ControlCambiosController@reabrirsolicitud', 'method' => 'post', 'enctype' => 'multipart/form-data','class' => 'form-horizontal']) !!}
                    <div class="modal-body">

                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label">No. de Solicitud</label>
                                <div class="col-sm-3">
                                    {!! Form::number('id_solicitud',$Asunto,['class'=>'form-control','id'=>'id_solicitud','placeholder'=>'Nro. de la Solicitud']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label">Descripcion Apertura</label>
                                <div class="col-sm-8">
                                    {!! Form::textarea('descripcion_solicitudCC',$Descripcion,['class'=>'form-control','id'=>'descripcion_solicitudCC','placeholder'=>'Ingrese la descripción de la apertura','rows'=>'3']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label">Categoria</label>
                                <div class="col-sm-4">
                                    {!! Form::select('id_categoriaCC',$NombreCategoria,null,['class'=>'form-control','id'=>'id_categoriaCC','onchange'=>'categoriaCFuncA();']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label">Asignado</label>
                                <div class="col-sm-4">
                                    {!! Form::select('id_usuarioCC',$Usuario,null,['class'=>'form-control','id'=>'id_usuarioCC']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label">Estado</label>
                                <div class="col-sm-4">
                                    {!! Form::select('id_estadoCC',$NombreEstadoA,null,['class'=>'form-control','id'=>'id_estadoCC']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label">Impacto</label>
                                <div class="col-sm-4">
                                    {!! Form::select('id_impactoCC',$NombreImpactoA,null,['class'=>'form-control','id'=>'id_impactoCC']) !!}
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Abrir Solicitud</button>
                    </div>
                    {!!  Form::close() !!}

                </div>
            </div>
        </div>
    <script>

        function categoriaCFunc() {
            var selectBox = document.getElementById("id_categoriaC");
            var selectedValue = selectBox.options[selectBox.selectedIndex].value;
            var tipo = 'post';
            var select = document.getElementById("id_usuarioC");

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

        function categoriaCFuncA() {
            var selectBox = document.getElementById("id_categoriaCC");
            var selectedValue = selectBox.options[selectBox.selectedIndex].value;
            var tipo = 'post';
            var select = document.getElementById("id_usuarioCC");

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

