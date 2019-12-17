<div class="modal fade" id="modal-ticket-usuario">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="color: white;background-color: rgba(162, 27, 37, 1);">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Crear Ticket de Creación de Usuario</h4>
            </div>

            {!! Form::open(['url' => 'crearTicketUsuario', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
            <div class="modal-body">
                <div class="box-body">
                    <legend class="subtitle2" style="color: rgba(162, 27, 37, 1);">DATOS USUARIO</legend>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-5">
                                <label for="exampleInputEmail1" class="col-sm-12 control-label">Nombres y Apellidos</label>
                                {!! Form::text('nombres',$NombresCompletos,['class'=>'form-control','id'=>'nombres','required','placeholder'=>'Nombre Completo del usuario',]) !!}
                            </div>
                            <div class="col-md-3">
                                <label for="exampleInputEmail1" class="col-sm-12 control-label">Identificación</label>
                                {!! Form::text('identificacion',$Identificacion,['class'=>'form-control','id'=>'identificacion','placeholder'=>'Identificación','required']) !!}
                            </div>
                            <div class="col-md-4">
                                <label for="exampleInputEmail1" class="col-sm-12 control-label">Cargo</label>
                                {!! Form::text('cargo',$Cargo,['class'=>'form-control','id'=>'cargo','placeholder'=>'Cargo del Usuario','required']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="exampleInputEmail1" class="col-sm-5 control-label">Sede</label>
                                {!! Form::select('sede',$Sede,null,['class'=>'form-control','id'=>'sede','onchange'=>'sedeFunc();','required']) !!}
                            </div>
                            <div class="col-md-4">
                                <label for="exampleInputEmail1" class="col-sm-12 control-label">Área / Dependencia</label>
                                {!! Form::text('area',$Area,['class'=>'form-control','id'=>'area','required','placeholder'=>'Area o Dependencia del usuario']) !!}
                            </div>
                            <div class="col-md-4">
                                <label for="exampleInputEmail1" class="col-sm-12 control-label">Jefe Inmediato</label>
                                {!! Form::text('jefe',$Jefe,['class'=>'form-control','id'=>'jefe','required','placeholder'=>'Nombre del jefe inmediato']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="exampleInputEmail1" class="col-sm-12 control-label">Fecha Ingreso</label>
                                {!! Form::text('fechaIngreso',$FechaIngreso,['class'=>'form-control','id'=>'fechaIngreso','required','placeholder'=>'Fecha de Ingreso del Usuario']) !!}
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputEmail1" class="col-sm-12 control-label">Correo Solicitante</label>
                                {!! Form::text('correoS',$CorreoFuncionario,['class'=>'form-control','id'=>'correoS','required','placeholder'=>'Correo(s) del solicitante']) !!}
                            </div>
                        </div>
                    </div>
                    <legend class="subtitle2" style="color: rgba(162, 27, 37, 1);">DATOS INGRESO INFRAESTRUCTURA</legend>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="exampleInputEmail1" class="col-sm-12 control-label">Cargo Nuevo?</label>
                                {!! Form::select('cargo_nuevo',$Opciones,null,['class'=>'form-control','id'=>'cargo_nuevo','required']) !!}
                            </div>
                            <div class="col-md-5">
                                <label for="exampleInputEmail1" class="col-sm-12 control-label">Funcionario A Reemplazar</label>
                                {!! Form::text('funcionario',$Funcionario,['class'=>'form-control','id'=>'funcionario','placeholder'=>'Nombre del Funcionario a reemplazar']) !!}
                            </div>
                            <div class="col-md-3">
                                <label for="exampleInputEmail1" class="col-sm-12 control-label">Usuario en Dominio?</label>
                                {!! Form::select('usuario_dominio',$Opciones,null,['class'=>'form-control','id'=>'usuario_dominio']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="exampleInputEmail1" class="col-sm-12 control-label">Correo Electrónico?</label>
                                {!! Form::select('correo_electronico',$Opciones,null,['class'=>'form-control','id'=>'correo_electronico']) !!}
                            </div>
                            <div class="col-md-5">
                                <label for="exampleInputEmail1" class="col-sm-12 control-label">Correo funcionario de reemplazar</label>
                                {!! Form::text('correo_funcionario',$Funcionario,['class'=>'form-control','id'=>'correo_funcionario','placeholder'=>'Correo del Funcionario a reemplazar']) !!}
                            </div>
                            <div class="col-md-3">
                                <label for="exampleInputEmail1" class="col-sm-12 control-label">Equipo de Computo?</label>
                                {!! Form::select('equipo_computo',$Equipo,null,['class'=>'form-control','id'=>'equipo_computo']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-8">
                                <label for="exampleInputEmail1" class="col-sm-12 control-label">Acceso Carpeta Compartida</label>
                                {!! Form::text('acceso_carpeta',$Carpeta,['class'=>'form-control','id'=>'acceso_carpeta','placeholder'=>'URL o nombre carpeta compartida']) !!}
                            </div>
                        </div>
                    </div>
                    <legend class="subtitle2" style="color: rgba(162, 27, 37, 1);">DATOS INGRESO REDES Y COMUNICACIONES</legend>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="exampleInputEmail1" class="col-sm-12 control-label">Celular Corporativo?</label>
                                {!! Form::select('celular',$Opciones,null,['class'=>'form-control','id'=>'celular']) !!}
                            </div>
                            <div class="col-md-3">
                                <label for="exampleInputEmail1" class="col-sm-12 control-label">Datos?</label>
                                {!! Form::select('datos',$Opciones,null,['class'=>'form-control','id'=>'datos']) !!}
                            </div>
                            <div class="col-md-3">
                                <label for="exampleInputEmail1" class="col-sm-12 control-label">Minutos?</label>
                                {!! Form::select('minutos',$Opciones,null,['class'=>'form-control','id'=>'minutos']) !!}
                            </div>
                            <div class="col-md-3">
                                <label for="exampleInputEmail1" class="col-sm-12 control-label">Extensión Telefónica?</label>
                                {!! Form::select('extension_tel',$Opciones,null,['class'=>'form-control','id'=>'extension_tel']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="exampleInputEmail1" class="col-sm-12 control-label">Conectividad VPN?</label>
                                {!! Form::select('conectividad',$Opciones,null,['class'=>'form-control','id'=>'conectividad']) !!}
                            </div>
                            <div class="col-md-3">
                                <label for="exampleInputEmail1" class="col-sm-12 control-label">Nivel de Acceso a Internet</label>
                                {!! Form::select('acceso_internet',$Acceso,null,['class'=>'form-control','id'=>'acceso_internet']) !!}
                            </div>
                        </div>
                    </div>
                    <legend class="subtitle2" style="color: rgba(162, 27, 37, 1);">DATOS INGRESO APLICACIONES Y DESARROLLO</legend>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="exampleInputEmail1" class="col-sm-12 control-label">Sistema 8.5</label>
                                {!! Form::select('app_85',$Opciones,null,['class'=>'form-control','id'=>'app_85']) !!}
                            </div>
                            <div class="col-md-3">
                                <label for="exampleInputEmail1" class="col-sm-12 control-label">Dinamica?</label>
                                {!! Form::select('app_dinamica',$Opciones,null,['class'=>'form-control','id'=>'app_dinamica']) !!}
                            </div>
                            <div class="col-md-5">
                                <label for="exampleInputEmail1" class="col-sm-12 control-label">Otro Aplicativo</label>
                                {!! Form::text('otro_aplicativo',$Aplicativo,['class'=>'form-control','id'=>'otro_aplicativo','placeholder'=>'Otro(s) apicativo(s)']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="exampleInputEmail1" class="col-sm-12 control-label">Capacitación 8.5?</label>
                                {!! Form::select('cap_85',$Opciones,null,['class'=>'form-control','id'=>'cap_85']) !!}
                            </div>
                            <div class="col-md-3">
                                <label for="exampleInputEmail1" class="col-sm-12 control-label">Capacitación Dinamica?</label>
                                {!! Form::select('cap_dinamica',$Opciones,null,['class'=>'form-control','id'=>'cap_dinamica']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="exampleInputEmail1" class="col-sm-12 control-label">Observaciones de la Solicitud</label>
                                {!! Form::textarea('observaciones',$Observaciones,['class'=>'form-control','id'=>'observaciones','placeholder'=>'Ingrese la observación sobre la solicitud','rows'=>'3']) !!}
                            </div>
                            <div class="col-md-3">
                                <label for="exampleInputEmail1" class="col-sm-12 control-label">Prioridad</label>
                                {!! Form::select('prioridad',$Prioridad,null,['class'=>'form-control','id'=>'prioridad']) !!}
                            </div>
                            <div class="col-md-3">
                                <label for="exampleInputEmail1" class="col-sm-12 control-label">Estado</label>
                                {!! Form::select('estado',$Estado,null,['class'=>'form-control','id'=>'estado']) !!}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Crear Ticket</button>
            </div>
            {!!  Form::close() !!}

        </div>
    </div>
</div>
