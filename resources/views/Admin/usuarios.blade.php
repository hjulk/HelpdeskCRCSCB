@extends("theme.$theme.layout")

@section('titulo')
Usuarios
@endsection

@section('contenido')

<section class="content-header">
    <h1>Usuarios</h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li>Admin</a></li>
        <li class="active">Usuarios</li>
    </ol>
</section>

<section class="content">

    <div class="row">
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-body box-profile">
                    {{--  <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">  --}}
                    {!! Session::get('ProfileUser') !!}
                    <h3 class="profile-username text-center">{!! Session::get('NombreUsuario') !!}</h3>

                    <p class="text-muted text-center">{!! Session::get('NombreRol') !!}</p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Usuario desde</b> <a class="pull-right">{!! Session::get('FechaCreacion') !!}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Categoría</b> <a class="pull-right">{!! Session::get('NombreCategoria') !!}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Área</b> <a class="pull-right">{!! Session::get('NombreArea') !!}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Sede</b> <a class="pull-right">{!! Session::get('NombreSede') !!}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Zona</b> <a class="pull-right">{!! Session::get('NombreZona') !!}</a>
                        </li>
                    </ul>

                    {{--  <a href="#" class="btn btn-primary btn-block"><b>Editar</b></a>  --}}
                    <a href="#" class="btn btn-primary btn-block" title="Editar" data-toggle="modal" data-target=".bs-example-modal-lg-updAdmin"><b>Editar</b></a>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-9">

            <div class="row">
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title"><strong>Crear Usuario</strong></h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>

                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    {!! Form::open(['action' => 'Admin\UsuarioController@crearUsuario', 'method' => 'post', 'enctype' => 'multipart/form-data','role' => 'form']) !!}

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="exampleInputEmail1">Nombre Completo</label>
                                                {!! Form::text('nombre_usuario',$NombreUsuario,['class'=>'form-control','id'=>'nombre_usuario','placeholder'=>'Nombre Completo']) !!}
                                            </div>
                                            <div class="col-md-3">
                                                <label for="exampleInputEmail1">Usuario</label>
                                                {!! Form::text('username',$UserName,['class'=>'form-control','id'=>'username','placeholder'=>'Usuario']) !!}
                                            </div>
                                            <div class="col-md-5">
                                                <label for="exampleInputEmail1">Correo Electrónico</label>
                                                {!! Form::email('email',$Correo,['class'=>'form-control','id'=>'email','placeholder'=>'Correo Electrónico']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="exampleInputEmail1">Contraseña</label>
                                                {!! Form::input('password','password',$Contrasena,['class'=>'form-control','id'=>'password','placeholder'=>'Contraseña','type'=>'password']) !!}
                                            </div>
                                            <div class="col-md-3">
                                                <label for="exampleInputEmail1">Rol</label>
                                                {!! Form::select('id_rol',$Rol,null,['class'=>'form-control','id'=>'id_rol']) !!}
                                            </div>
                                            <div class="col-md-3">
                                                <label for="exampleInputEmail1">Categoria</label>
                                                {!! Form::select('id_categoria',$Categoria,null,['class'=>'form-control','id'=>'id_categoria']) !!}
                                            </div>
                                            <div class="col-md-3">
                                                <label for="exampleInputEmail1">Administrador</label>
                                                {!! Form::select('id_administracion',$Desicion,null,['class'=>'form-control','id'=>'id_administracion']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="exampleInputFile">Foto</label>
                                                <input type="file" id="profile_pic" name="profile_pic" class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="exampleInputEmail1">Zona</label>
                                                {!! Form::select('id_zona',$Zona,null,['class'=>'form-control','id'=>'id_zona','onchange'=>'zonaFunc();']) !!}
                                            </div>
                                            <div class="col-md-4">
                                                <label for="exampleInputEmail1">Sede</label>
                                                {!! Form::select('id_sede',$Sede,null,['class'=>'form-control','id'=>'id_sede']) !!}
                                            </div>

                                        </div>
                                    </div>


                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary pull-right">Crear Usuario</button>
                                    </div>
                                    {!!  Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title"><strong>Listado Usuarios</strong></h3>

                        </div>
                        <div class="box-body">


                            <table id="usuarios" class="display responsive hover" style="width: 100%;">
                                    <thead style="background: linear-gradient(60deg,rgba(51,101,155,1),rgba(66,132,206,1));color: #ECF0F1;">
                                    <tr>
                                        <th>Nombre Completo</th>
                                        <th>Usuario</th>
                                        <th>Correo</th>
                                        <th>Rol</th>
                                        <th>Categoria</th>
                                        <th>Estado</th>
                                        <th>Editar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($Usuarios as $usuario)
                                    <tr>
                                        <td>{{$usuario['nombre']}}</td>
                                        <td>{{$usuario['username']}}</td>
                                        <td>{{$usuario['email']}}</td>
                                        <td>{{$usuario['rol']}}</td>
                                        <td>{{$usuario['categoria']}}</td>
                                        <td>{{$usuario['estado']}}</td>
                                        <td><a href="#" class="btn btn-warning" title="Editar" onclick="obtener_datos_usuario('{{$usuario['id']}}');" data-toggle="modal" data-target=".bs-example-modal-lg-udpU"><i class="glyphicon glyphicon-edit"></i></a></td>
                                <input type="hidden" value="{{$usuario['id']}}" id="id{{$usuario['id']}}">
                                <input type="hidden" value="{{$usuario['nombre']}}" id="nombre{{$usuario['id']}}">
                                <input type="hidden" value="{{$usuario['username']}}" id="username{{$usuario['id']}}">
                                <input type="hidden" value="{{$usuario['email']}}" id="email{{$usuario['id']}}">
                                <input type="hidden" value="{{$usuario['activo']}}" id="activo{{$usuario['id']}}">
                                <input type="hidden" value="{{$usuario['id_zona']}}" id="id_zona{{$usuario['id']}}">
                                <input type="hidden" value="{{$usuario['id_sede1']}}" id="id_sede1{{$usuario['id']}}">
                                <input type="hidden" value="{{$usuario['id_sede2']}}" id="id_sede2{{$usuario['id']}}">
                                <input type="hidden" value="{{$usuario['id_sede3']}}" id="id_sede3{{$usuario['id']}}">
                                <input type="hidden" value="{{$usuario['id_rol']}}" id="id_rol{{$usuario['id']}}">
                                <input type="hidden" value="{{$usuario['id_categoria']}}" id="id_categoria{{$usuario['id']}}">
                                <input type="hidden" value="{{$usuario['administrador']}}" id="id_administracion{{$usuario['id']}}">
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</section>
@include('Modals.ModalUsuarios')
@endsection

@section('scripts')

    <script src="{{asset("assets/$theme/dist/js/usuarios.js")}}"></script>
    <script>
        @if (session("mensaje"))
            toastr.success("{{ session("mensaje") }}");
        @endif

        @if (count($errors) > 0)
            @foreach($errors -> all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
    </script>
    <script>
        function zonaFunc() {
            var selectBox = document.getElementById("id_zona");
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


@endsection
