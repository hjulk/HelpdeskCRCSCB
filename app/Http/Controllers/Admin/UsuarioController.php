<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Models\Admin\Usuarios;
use App\Models\Admin\Sedes;
use Monolog\Handler\ZendMonitorHandler;
use App\Http\Middleware\VerifyCsrfToken;
use App\Models\Admin\Activo;
use Illuminate\Support\Facades\Session;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Rol        = Usuarios::Rol();
        $Categoria  = Usuarios::Categoria();
        $Activo     = Usuarios::Activo();
        $Desicion   = Usuarios::Desicion();
        $NombreRol = array();
        $NombreRol[''] = 'Seleccione: ';
        foreach ($Rol as $row){
            $NombreRol[$row->id] = $row->nombre;
        }
        $NombreCategoria = array();
        $NombreCategoria[''] = 'Seleccione: ';
        foreach ($Categoria as $row){
            $NombreCategoria[$row->id] = $row->nombre;
        }
        $NombreActivo = array();
        $NombreActivo[''] = 'Seleccione: ';
        foreach ($Activo as $row){
            $NombreActivo[$row->id] = $row->nombre;
        }
        $NombreDesicion = array();
        $NombreDesicion[''] = 'Seleccione: ';
        foreach ($Desicion as $row){
            $NombreDesicion[$row->id] = $row->nombre;
        }

        $Zonas = Sedes::Zonas();
        $Sedes1 = Sedes::Sedes1();
        $Sedes2 = Sedes::Sedes2();
        $Sedes3 = Sedes::Sedes3();

        $NombreZona = array();
        $NombreZona[''] = 'Seleccione: ';
        foreach ($Zonas as $row){
            $NombreZona[$row->id] = $row->nombre;
        }
        $NombreSede = array();
        $NombreSede[''] = 'Seleccione: ';

        $NombreSede1 = array();
        $NombreSede1[''] = 'Seleccione: ';
        foreach ($Sedes1 as $row){
            $NombreSede1[$row->id] = $row->nombre;
        }
        $NombreSede2 = array();
        $NombreSede2[''] = 'Seleccione: ';
        foreach ($Sedes2 as $row){
            $NombreSede2[$row->id] = $row->nombre;
        }
        $NombreSede3 = array();
        $NombreSede3[''] = 'Seleccione: ';
        foreach ($Sedes3 as $row){
            $NombreSede3[$row->id] = $row->nombre;
        }

        $Usuarios = Usuarios::ListarUsuarios();
        $UsuariosIndex = array();
        $contU = 0;
        foreach($Usuarios as $value){
            $UsuariosIndex[$contU]['id'] = $value->id;
            $UsuariosIndex[$contU]['nombre'] = $value->nombre;
            $UsuariosIndex[$contU]['username'] = $value->username;
            $UsuariosIndex[$contU]['email'] = $value->email;
            $UsuariosIndex[$contU]['profile_pic'] = $value->profile_pic;
            $idrol = $value->id_rol;
            $UsuariosIndex[$contU]['id_rol'] = $value->id_rol;
            $idcategoria = $value->id_categoria;
            $UsuariosIndex[$contU]['id_categoria'] = $value->id_categoria;
            $idzona = $value->id_zona;
            $UsuariosIndex[$contU]['id_zona'] = $value->id_zona;
            $idsede = $value->id_sede;
            $UsuariosIndex[$contU]['id_sede'] = $value->id_sede;
            $idarea = $value->id_area;
            $UsuariosIndex[$contU]['id_area'] = $value->id_area;
            $idactivo = $value->activo;
            $UsuariosIndex[$contU]['activo'] = $value->activo;
            $nombreZonaS = Sedes::BuscarZonaID($idzona);
            foreach($nombreZonaS as $valor){
                $UsuariosIndex[$contU]['zona'] = $valor->nombre;
            }
            $nombreSedeS = Sedes::BuscarSedeID($idsede);
            foreach($nombreSedeS as $valor){
                $UsuariosIndex[$contU]['sede'] = $valor->nombre;
            }
            $nombreAreaS = Sedes::BuscarAreaID($idarea);
            foreach($nombreAreaS as $valor){
                $UsuariosIndex[$contU]['area'] = $valor->nombre;
            }
            $nombreRolS = Usuarios::RolID($idrol);
            foreach($nombreRolS as $valor){
                $UsuariosIndex[$contU]['rol'] = $valor->nombre;
            }
            $nombreCategoriaS = Usuarios::CategoriaID($idcategoria);
            foreach($nombreCategoriaS as $valor){
                $UsuariosIndex[$contU]['categoria'] = $valor->nombre;
            }
            $nombreActivoS = Usuarios::ActivoID($idactivo);
            foreach($nombreActivoS as $valor){
                $UsuariosIndex[$contU]['estado'] = $valor->nombre;
            }
            if($value->id_zona === 1){
                $UsuariosIndex[$contU]['id_sede1'] = $value->id_sede;
                $UsuariosIndex[$contU]['id_sede2'] = 0;
                $UsuariosIndex[$contU]['id_sede3'] = 0;
            }else if($value->id_zona === 2){
                $UsuariosIndex[$contU]['id_sede1'] = 0;
                $UsuariosIndex[$contU]['id_sede2'] = $value->id_sede;
                $UsuariosIndex[$contU]['id_sede3'] = 0;
            }else if($value->id_zona === 3){
                $UsuariosIndex[$contU]['id_sede1'] = 0;
                $UsuariosIndex[$contU]['id_sede2'] = 0;
                $UsuariosIndex[$contU]['id_sede3'] = $value->id_sede;
            }
            $UsuariosIndex[$contU]['editar'] = $value->id;
            $UsuariosIndex[$contU]['administrador'] = $value->administrador;
            $contU++;
        }

        return view('admin.usuarios',['Rol' => $NombreRol, 'Categoria' => $NombreCategoria, 'Zona' => $NombreZona,
                                     'Sede1' => $NombreSede1, 'Sede2' => $NombreSede2, 'Sede3' => $NombreSede3,
                                     'Usuarios' => $UsuariosIndex,'Activo' => $NombreActivo,'Sede' => $NombreSede,
                                     'NombreUsuario' => null,'UserName' => null,'Correo' => null,'Contrasena' => null,
                                     'Desicion' => $NombreDesicion,]);
    }

    public function inicio()
    {
        return view('admin.login');
    }

    public function tickets()
    {
        return view('user.tickets');
    }

    public function crearUsuario(){

        $data = Input::all();

        $reglas = array(
            'nombre_usuario'    =>  'required',
            'username'          =>  'required',
            'email'             =>  'required|email',
            'password'          =>  'required',
            'id_rol'            =>  'required',
            'id_categoria'      =>  'required',
            'id_zona'           =>  'required',
            'id_sede'           =>  'required'
        );
        $validador = Validator::make($data, $reglas);
        $messages = $validador->messages();
        foreach ($reglas as $key => $value){
            $verrors[$key] = $messages->first($key);
        }
        if($validador->passes()) {
            $nombreUsuario  = Input::get('nombre_usuario');
            $userName       = Input::get('username');
            $email          = Input::get('email');
            $password       = Input::get('password');
            $contrasena     = hash('sha512', $password);
            $idrol          = Input::get('id_rol');
            $idcategoria    = Input::get('id_categoria');
            $idzona         = Input::get('id_zona');
            $Sede           = (int)Input::get('id_sede');
            $administracion = (int)Input::get('id_administracion');

             $destinationPath = null;
                $filename        = null;
                if (Input::hasFile('profile_pic')) {
                    $file            = Input::file('profile_pic');
                    $destinationPath = public_path().'/aplicativo/profile_pics';
                    $extension       = $file->getClientOriginalExtension();
                    $nombrearchivo   = str_replace(".", "_", $userName);
                    $filename        = $nombrearchivo.'.'.$extension;
                    $uploadSuccess   = $file->move($destinationPath, $filename);
                    $archivofoto    = file_get_contents($uploadSuccess);

                }

                $NombreFoto     = $filename;
                $consultarUsuario = Usuarios::BuscarUser($userName);
                if($consultarUsuario){
                    $verrors = array();
                    array_push($verrors, 'El usuario '.$userName.' ya se encuentra creado');
                    // return redirect('admin/usuarios')->withErrors(['errors' => $verrors])->withInput();
                    return \Redirect::to('admin/usuarios')->withErrors(['errors' => $verrors])->withInput();
                }else{
                    $crearUsuario = Usuarios::CrearUsuario($nombreUsuario,$userName,$email,$contrasena,$idrol,$idcategoria,$idzona,$Sede,$NombreFoto,$administracion);
                    if($crearUsuario){
                        $verrors = 'Se creo con éxito el usuario '.$userName;
                        return redirect('admin/usuarios')->with('mensaje', $verrors);
                    }else{
                        $verrors = array();
                        array_push($verrors, 'Hubo un problema al crear el usuario');
                        // return redirect('admin/usuarios')->withErrors(['errors' => $verrors])->withInput();
                        return \Redirect::to('admin/usuarios')->withErrors(['errors' => $verrors])->withInput();
                    }
                }


        }else{

            // return redirect('admin/sedes')->with('mensaje',$verrors);
            return \Redirect::to('admin/usuarios')->withErrors(['errors' => $verrors])->withInput();
        }

    }

    public function actualizarUsuarioAdmin(){
        $data = Input::all();
        $reglas = array(
            'nombre_usuario'    =>  'required',
            'username'          =>  'required',
            'email'             =>  'required|email'
        );
        $validador = Validator::make($data, $reglas);
        $messages = $validador->messages();
        foreach ($reglas as $key => $value){
            $verrors[$key] = $messages->first($key);
        }
        if($validador->passes()) {
            $id             = (int)Session::get('IdUsuario');
            $nombreUsuario  = Input::get('nombre_usuario');
            $userName       = Input::get('username');
            $email          = Input::get('email');
            $password       = Input::get('password');
            $contrasena     = hash('sha512', $password);

            if($password){

                $clave = $contrasena;
            }else{
                $consultarLogin = Usuarios::BuscarUser($userName);

                foreach($consultarLogin as $value){
                    $clave = $value->password;
                }
            }

                $destinationPath = null;
                $filename        = null;
                if (Input::hasFile('profile_pic')) {
                    $file            = Input::file('profile_pic');
                    $destinationPath = public_path().'/aplicativo/profile_pics';
                    $extension       = $file->getClientOriginalExtension();
                    $nombrearchivo   = str_replace(".", "_", $userName);
                    $filename        = $nombrearchivo.'.'.$extension;
                    $uploadSuccess   = $file->move($destinationPath, $filename);
                    $archivofoto    = file_get_contents($uploadSuccess);
                }

                $NombreFoto         = $filename;
                $ActualizarUsuario = Usuarios::ActualizarUsuarioAdmin($id,$nombreUsuario,$userName,$email,$clave,$NombreFoto);

                if($ActualizarUsuario){
                    $verrors = 'Se actualizo con éxito el usuario '.$userName;
                    return redirect('admin/usuarios')->with('mensaje', $verrors);
                }else{
                    $verrors = array();
                    array_push($verrors, 'Hubo un problema al actualizar el usuario');
                    return redirect('admin/usuarios')->withErrors(['errors' => $verrors]);
                }




        }else{
            return redirect('admin/usuarios')->withErrors(['errors' => $verrors]);
        }
    }

    public function actualizarUsuario(){
        $data = Input::all();
        $reglas = array(
            'nombre_usuario'    =>  'required',
            'username'          =>  'required',
            'email'             =>  'required|email',
            'id_rol'            =>  'required',
            'id_categoria'      =>  'required',
            'id_zona1'          =>  'required',
            'id_activo'         =>  'required'
        );
        $validador = Validator::make($data, $reglas);
        $messages = $validador->messages();
        foreach ($reglas as $key => $value){
            $verrors[$key] = $messages->first($key);
        }
        if($validador->passes()) {
            $id             = (int)Input::get('idU');
            $nombreUsuario  = Input::get('nombre_usuario');
            $userName       = Input::get('username');
            $email          = Input::get('email');
            $password       = Input::get('password');
            $contrasena     = hash('sha512', $password);
            $idrol          = Input::get('id_rol');
            $idcategoria    = Input::get('id_categoria');
            $idzona         = Input::get('id_zona1');
            $Sede1          = (int)Input::get('id_sede1');
            $Sede2          = (int)Input::get('id_sede2');
            $Sede3          = (int)Input::get('id_sede3');
            $idactivo       = (int)Input::get('id_activo');
            $administracion = (int)Input::get('id_administracion');

            if($password){

                $clave = $contrasena;
            }else{
                $consultarLogin = Usuarios::BuscarUser($userName);

                foreach($consultarLogin as $value){
                    $clave = $value->password;
                }
            }


            if(($Sede1 > 0) && ($Sede2 === 0) && ($Sede3 === 0)){

                $destinationPath = null;
                $filename        = null;
                if (Input::hasFile('profile_pic')) {
                    $file            = Input::file('profile_pic');
                    $destinationPath = public_path().'/aplicativo/profile_pics';
                    $extension       = $file->getClientOriginalExtension();
                    $nombrearchivo   = str_replace(".", "_", $userName);
                    $filename        = $nombrearchivo.'.'.$extension;
                    $uploadSuccess   = $file->move($destinationPath, $filename);
                    $archivofoto    = file_get_contents($uploadSuccess);
                }

                $NombreFoto     = $filename;
                $ActualizarUsuario = Usuarios::ActualizarUsuario($id,$nombreUsuario,$userName,$email,$clave,$idactivo,$idrol,$idcategoria,$idzona,$Sede1,$NombreFoto,$administracion);

                if($ActualizarUsuario){
                    $verrors = 'Se actualizo con éxito el usuario '.$userName;
                    return redirect('admin/usuarios')->with('mensaje', $verrors);
                }else{
                    $verrors = array();
                    array_push($verrors, 'Hubo un problema al actualizar el usuario');
                    return redirect('admin/usuarios')->withErrors(['errors' => $verrors]);
                }

            }else if(($Sede1 === 0) && ($Sede2 > 0) && ($Sede3 === 0)){
                $destinationPath = null;
                $filename        = null;
                if (Input::hasFile('profile_pic')) {
                    $file            = Input::file('profile_pic');
                    $destinationPath = public_path().'/aplicativo/profile_pics';
                    $extension       = $file->getClientOriginalExtension();
                    $nombrearchivo   = str_replace(".", "_", $userName);
                    $filename        = $nombrearchivo.'.'.$extension;
                    $uploadSuccess   = $file->move($destinationPath, $filename);
                    $archivofoto    = file_get_contents($uploadSuccess);
                }

                $NombreFoto     = $filename;
                $ActualizarUsuario = Usuarios::ActualizarUsuario($id,$nombreUsuario,$userName,$email,$clave,$idactivo,$idrol,$idcategoria,$idzona,$Sede2,$NombreFoto,$administracion);

                if($ActualizarUsuario){
                    $verrors = 'Se actualizo con éxito el usuario '.$userName;
                    return redirect('admin/usuarios')->with('mensaje', $verrors);
                }else{
                    $verrors = array();
                    array_push($verrors, 'Hubo un problema al actualizar el usuario');
                    return redirect('admin/usuarios')->withErrors(['errors' => $verrors]);
                }

            }else if(($Sede1 === 0) && ($Sede2 === 0) && ($Sede3 > 0)){
                $destinationPath = null;
                $filename        = null;
                if (Input::hasFile('profile_pic')) {
                    $file            = Input::file('profile_pic');
                    $destinationPath = public_path().'/aplicativo/profile_pics';
                    $extension       = $file->getClientOriginalExtension();
                    $nombrearchivo   = str_replace(".", "_", $userName);
                    $filename        = $nombrearchivo.'.'.$extension;
                    $uploadSuccess   = $file->move($destinationPath, $filename);
                    $archivofoto    = file_get_contents($uploadSuccess);
                }

                $NombreFoto     = $filename;
                $ActualizarUsuario = Usuarios::ActualizarUsuario($id,$nombreUsuario,$userName,$email,$clave,$idactivo,$idrol,$idcategoria,$idzona,$Sede3,$NombreFoto,$administracion);

                if($ActualizarUsuario){
                    $verrors = 'Se actualizo con éxito el usuario '.$userName;
                    return redirect('admin/usuarios')->with('mensaje', $verrors);
                }else{
                    $verrors = array();
                    array_push($verrors, 'Hubo un problema al actualizar el usuario');
                    return redirect('admin/usuarios')->withErrors(['errors' => $verrors]);
                }

            }


        }else{
            return redirect('admin/usuarios')->withErrors(['errors' => $verrors]);
        }
    }

    public function actualizarUsuarioP(){
        $data = Input::all();
        $reglas = array(
            'nombre_usuario'    =>  'required',
            'username'          =>  'required',
            'email'             =>  'required|email',
            'id_rol'            =>  'required',
            'id_categoria'      =>  'required',
            'id_activo'         =>  'required'
        );
        $validador = Validator::make($data, $reglas);
        $messages = $validador->messages();
        foreach ($reglas as $key => $value){
            $verrors[$key] = $messages->first($key);
        }
        if($validador->passes()) {
            $id             = (int)Input::get('idUP');
            $nombreUsuario  = Input::get('nombre_usuario');
            $userName       = Input::get('username');
            $email          = Input::get('email');
            $password       = Input::get('password1');
            $contrasena     = hash('sha512', $password);
            $idrol          = (int)Input::get('id_rol');
            $idcategoria    = (int)Input::get('id_categoria');
            $idactivo       = (int)Input::get('id_activo');

            if($password){

                $clave = $contrasena;
            }else{
                $consultarLogin = Usuarios::BuscarUser($userName);

                foreach($consultarLogin as $value){
                    $clave = $value->password;
                }
            }

                $destinationPath = null;
                $filename        = null;
                if (Input::hasFile('profile_pic')) {
                    $file            = Input::file('profile_pic');
                    $destinationPath = public_path().'/aplicativo/profile_pics';
                    $extension       = $file->getClientOriginalExtension();
                    $nombrearchivo   = str_replace(".", "_", $userName);
                    $filename        = $nombrearchivo.'.'.$extension;
                    $uploadSuccess   = $file->move($destinationPath, $filename);
                    $archivofoto    = file_get_contents($uploadSuccess);
                }

                $NombreFoto         = $filename;
                $ActualizarUsuario = Usuarios::ActualizarUsuarioP($id,$nombreUsuario,$userName,$email,$clave,$idactivo,$idrol,$idcategoria,$NombreFoto);

                if($ActualizarUsuario){
                    $verrors = 'Se actualizo con éxito el usuario '.$userName;
                    return redirect('admin/usuarios')->with('mensaje', $verrors);
                }else{
                    $verrors = array();
                    array_push($verrors, 'Hubo un problema al actualizar el usuario');
                    return redirect('admin/usuarios')->withErrors(['errors' => $verrors]);
                }




        }else{
            return redirect('admin/usuarios')->withErrors(['errors' => $verrors]);
        }
    }

}
