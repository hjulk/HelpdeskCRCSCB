<div class="modal fade bs-example-modal-lg-udpU" id="modal-usuarios-upd">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Actualizar Usuario</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['action' => 'Admin\UsuarioController@actualizarUsuario', 'method' => 'post', 'enctype' => 'multipart/form-data','role' => 'form']) !!}
                <input type="hidden" name="idU" id="mod_idU">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="exampleInputEmail1">Nombre Completo</label>
                            <input type="text" class="form-control" id="mod_nombre_usuario" name="nombre_usuario" placeholder="Nombre Completo">
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1">Usuario</label>
                            <input type="text" class="form-control" id="mod_username" name="username" placeholder="Usuario">
                        </div>
                        <div class="col-md-5">
                            <label for="exampleInputEmail1">Correo Electrónico</label>
                            <input type="email" class="form-control" id="mod_email" name="email" placeholder="Correo Electrónico">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="exampleInputEmail1">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="contraseña">
                        </div>
                        <div class="col-md-4">
                            <label for="exampleInputEmail1">Rol</label>
                            {!! Form::select('id_rol',$Rol,null,['class'=>'form-control','id'=>'mod_id_rol']) !!}
                        </div>
                        <div class="col-md-4">
                            <label for="exampleInputEmail1">Categoria</label>
                            {!! Form::select('id_categoria',$Categoria,null,['class'=>'form-control','id'=>'mod_id_categoria']) !!}
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="exampleInputFile">Foto</label>
                            <input type="file" id="profile_pic" name="profile_pic">
                        </div>
                        <div class="col-md-4">
                            <label for="exampleInputEmail1">Zona</label>
                            {!! Form::select('id_zona1',$Zona,null,['class'=>'form-control','id'=>'mod_id_zona1']) !!}
                        </div>
                        <div class="col-md-4" id="Sedes11" hidden>
                            <label for="exampleInputEmail1">Sede</label>

                            {!! Form::select('id_sede1',$Sede1,null,['class'=>'form-control','id'=>'mod_id_sede1']) !!}

                        </div>
                        <div class="col-md-4" id="Sedes21" hidden>
                            <label for="exampleInputEmail1">Sede</label>

                            {!! Form::select('id_sede2',$Sede2,null,['class'=>'form-control','id'=>'mod_id_sede2']) !!}

                        </div>
                        <div class="col-md-4" id="Sedes31" hidden>
                            <label for="exampleInputEmail1">Sede</label>

                            {!! Form::select('id_sede3',$Sede3,null,['class'=>'form-control','id'=>'mod_id_sede3']) !!}

                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="exampleInputEmail1">Activo</label>
                            {!! Form::select('id_activo',$Activo,null,['class'=>'form-control','id'=>'mod_activo']) !!}
                        </div>
                        <div class="col-md-4">
                            <label for="exampleInputEmail1">Administrador</label>
                            {!! Form::select('id_administracion',$Desicion,null,['class'=>'form-control','id'=>'mod_id_administracion']) !!}
                        </div>
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-success pull-right">Actualizar Usuario</button>
                </div>
                {!!  Form::close() !!}
            </div>
        </div>
    </div>

</div>
<div class="modal fade bs-example-modal-lg-updAdmin" id="modal-usuarios-upd">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Actualizar Usuario Admin</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['action' => 'Admin\UsuarioController@actualizarUsuarioAdmin', 'method' => 'post', 'enctype' => 'multipart/form-data','role' => 'form']) !!}
                <input type="hidden" name="idU" id="mod_idU">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="exampleInputEmail1">Nombre Completo</label>
                            <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" placeholder="Nombre Completo" value="{!! Session::get('NombreUsuario') !!}">
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1">Usuario</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Usuario" value="{!! Session::get('UserName') !!}">
                        </div>
                        <div class="col-md-5">
                            <label for="exampleInputEmail1">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Correo Electrónico" value="{!! Session::get('Email') !!}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-5">
                            <label for="exampleInputEmail1">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="contraseña">
                        </div>
                        <div class="col-md-7">
                            <label for="exampleInputFile">Foto</label>
                            <input type="file" id="profile_pic" name="profile_pic">
                        </div>


                    </div>
                </div>



                <div class="box-footer">
                    <button type="submit" class="btn btn-success pull-right">Actualizar Usuario</button>
                </div>
                {!!  Form::close() !!}
            </div>
        </div>
    </div>

</div>
    <script>

        function obtener_datos_usuario(id) {
            var nombre = $("#nombre" + id).val();
            var username = $("#username" + id).val();
            var email = $("#email" + id).val();
            var rol = $("#id_rol" + id).val();
            var categoria = $("#id_categoria" + id).val();
            var activo = $("#activo" + id).val();
            var id_zona = $("#id_zona" + id).val();
            var id_sede1 = $("#id_sede1" + id).val();
            var id_sede2 = $("#id_sede2" + id).val();
            var id_sede3 = $("#id_sede3" + id).val();
            var administracion = $("#id_administracion" + id).val();

            $("#mod_idU").val(id);
            $("#mod_nombre_usuario").val(nombre);
            $("#mod_username").val(username);
            $("#mod_email").val(email);
            $("#mod_id_rol").val(rol);
            $("#mod_id_categoria").val(categoria);
            $("#mod_activo").val(activo);
            $("#mod_id_zona1").val(id_zona);
            $("#mod_id_sede1").val(id_sede1);
            $("#mod_id_sede2").val(id_sede2);
            $("#mod_id_sede3").val(id_sede3);
            $("#mod_id_administracion").val(administracion);

            if (id_sede1 > 0) {
                $('#Sedes11').show();
                $('#Sedes21').hide().val('0');
                $('#Sedes31').hide().val('0');
            } else if (id_sede2 > 0) {
                $('#Sedes11').hide().val('0');
                $('#Sedes21').show();
                $('#Sedes31').hide().val('0');
            } else if (id_sede3 > 0) {
                $('#Sedes31').show();
                $('#Sedes11').hide().val('0');
                $('#Sedes21').hide().val('0');
            } else {
                $('#Sedes11').hide();
                $('#Sedes21').hide();
                $('#Sedes31').hide();
            }

            $('#id_zona1').change(function () {
                var seleccion = $("#id_zona1").val();
                if (seleccion === "0") {
                    $('#Sedes11').hide();
                    $('#Sedes21').hide();
                    $('#Sedes31').hide();

                    seleccion = 0;
                } else if (seleccion === "1") {
                    $('#Sedes11').show();
                    $('#Sedes21').hide().val('0');
                    $('#Sedes31').hide().val('0');

                    seleccion = 1;
                } else if (seleccion === "2") {
                    $('#Sedes11').hide().val('0');
                    $('#Sedes21').show();
                    $('#Sedes31').hide().val('0');

                    seleccion = 2;
                } else if (seleccion === "3") {
                    $('#Sedes11').hide().val('0');
                    $('#Sedes21').hide().val('0');
                    $('#Sedes31').show();

                    seleccion = 3;
                }

            });



        }


    </script>
