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
        $NombreRol = array();
        $NombreRol[''] = 'Seleccione: ';
        foreach ($Rol as $row){
            $NombreRol[$row->rol_id] = $row->name;
        }
        $NombreCategoria = array();
        $NombreCategoria[''] = 'Seleccione: ';
        foreach ($Categoria as $row){
            $NombreCategoria[$row->id] = $row->name;
        }
        $NombreActivo = array();
        $NombreActivo[''] = 'Seleccione: ';
        foreach ($Activo as $row){
            $NombreActivo[$row->id] = $row->name;
        }

        $RolAdmin       = Session::get('Rol');
        $CategoriaAdmin = Session::get('Categoria');

        $Usuarios = Usuarios::ListarUsuarios();
        $UsuariosIndex = array();
        $contU = 0;
        foreach($Usuarios as $value){
            $UsuariosIndex[$contU]['id'] = $value->id;
            $UsuariosIndex[$contU]['nombre'] = $value->name;
            $UsuariosIndex[$contU]['username'] = $value->username;
            $UsuariosIndex[$contU]['email'] = $value->email;
            $UsuariosIndex[$contU]['profile_pic'] = $value->profile_pic;
            $UsuariosIndex[$contU]['fecha_creacion'] = date('d/m/Y h:i A', strtotime($value->created_at));
            $idrol = $value->rol_id;
            $UsuariosIndex[$contU]['id_rol'] = $value->rol_id;
            $idcategoria = $value->category_id;
            $UsuariosIndex[$contU]['id_categoria'] = $value->category_id;
            $idactivo = $value->is_active;
            $UsuariosIndex[$contU]['activo'] = $value->is_active;
            $nombreRolS = Usuarios::RolID($idrol);
            foreach($nombreRolS as $valor){
                $UsuariosIndex[$contU]['rol'] = $valor->name;
            }
            $nombreCategoriaS = Usuarios::CategoriaID($idcategoria);
            foreach($nombreCategoriaS as $valor){
                $UsuariosIndex[$contU]['categoria'] = $valor->name;
            }
            $nombreActivoS = Usuarios::ActivoID($idactivo);
            foreach($nombreActivoS as $valor){
                $UsuariosIndex[$contU]['estado'] = $valor->name;
            }
            $contU++;
        }

        return view('admin.usuarios',['Rol' => $NombreRol, 'Categoria' => $NombreCategoria, 'Usuarios' => $UsuariosIndex,
                                        'Activo' => $NombreActivo,'NombreUsuario' => null,'UserName' => null,'Correo' => null,
                                        'Contrasena' => null,'RolAdmin' => $RolAdmin,'CategoriaAdmin' => $CategoriaAdmin]);
    }

    public function usuarioFinal(){
        $NombreArea = array();
        $NombreArea[''] = 'Seleccione: ';
        $NombreSede = array();
        $NombreSede[''] = 'Seleccione: ';
        $Sedes  = Sedes::Sedes();
        foreach ($Sedes as $row){
            $NombreSede[$row->id] = $row->name;
        }
        $Activo     = Usuarios::Activo();
        $NombreActivo = array();
        $NombreActivo[''] = 'Seleccione: ';
        foreach ($Activo as $row){
            $NombreActivo[$row->id] = $row->name;
        }
        $Usuarios       = Usuarios::ListarUsuarioFinal();
        $UsuariosFinal  = array();
        $contUF         = 0;
        foreach($Usuarios as $value){
            $UsuariosFinal[$contUF]['id']               = (int)$value->id;
            $UsuariosFinal[$contUF]['nombre']           = $value->nombre;
            $UsuariosFinal[$contUF]['username']         = $value->username;
            $UsuariosFinal[$contUF]['email']            = $value->email;
            $UsuariosFinal[$contUF]['cargo']            = $value->cargo;
            $UsuariosFinal[$contUF]['foto']             = $value->foto;
            $UsuariosFinal[$contUF]['fecha_creacion']   = date('d/m/Y h:i A', strtotime($value->fecha_creacion));
            $idSede         = (int)$value->sede;
            $UsuariosFinal[$contUF]['sede']             = (int)$value->sede;
            $idArea         = (int)$value->area;
            $UsuariosFinal[$contUF]['area']             = (int)$value->area;
            $idactivo       = (int)$value->activo;
            $UsuariosFinal[$contUF]['activo']           = $value->activo;
            $NombreSedeU    = Sedes::BuscarSedeID($idSede);
            foreach($NombreSedeU as $valor){
                $UsuariosFinal[$contUF]['nombresede']   = $valor->name;
            }
            $NombreAreaU    = Sedes::BuscarAreaId($idArea);
            foreach($NombreAreaU as $valor){
                $UsuariosFinal[$contUF]['nombrearea']   = $valor->name;
            }
            $NombreActivoU  = Usuarios::ActivoID($idactivo);
            foreach($NombreActivoU as $valor){
                $UsuariosFinal[$contUF]['estado']        = $valor->name;
            }
            $contUF++;
        }
        // dd($UsuariosFinal);
        return view('admin.usuarioFinal',['Area' => $NombreArea,'Sede' => $NombreSede, 'UsuarioFinal' => $UsuariosFinal,
                                            'Activo' => $NombreActivo]);
    }

    public function inicio()
    {
        return view('admin.login');
    }

    public function crearUsuario(){

        $data = Input::all();
        $creadoPor          = (int)Session::get('IdUsuario');
        $reglas = array(
            'nombre_usuario'    =>  'required',
            'username'          =>  'required',
            'email'             =>  'required|email',
            'password'          =>  'required',
            'id_rol'            =>  'required',
            'id_categoria'      =>  'required'
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
            $destinationPath = null;
            $filename        = null;
            if (Input::hasFile('profile_pic')) {
                $file            = Input::file('profile_pic');
                $destinationPath = public_path().'/assets/dist/img/profiles';
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
                return Redirect::to('admin/usuarios')->withErrors(['errors' => $verrors])->withInput();
            }else{
                $crearUsuario = Usuarios::CrearUsuario($nombreUsuario,$userName,$email,$contrasena,$idrol,$idcategoria,$NombreFoto,$creadoPor);
                if($crearUsuario){
                    $verrors = 'Se creo con éxito el usuario '.$userName;
                    return redirect('admin/usuarios')->with('mensaje', $verrors);
                }else{
                    $verrors = array();
                    array_push($verrors, 'Hubo un problema al crear el usuario');
                    // return redirect('admin/usuarios')->withErrors(['errors' => $verrors])->withInput();
                    return Redirect::to('admin/usuarios')->withErrors(['errors' => $verrors])->withInput();
                }
            }

        }else{
            return Redirect::to('admin/usuarios')->withErrors(['errors' => $verrors])->withInput();
        }

    }

    public function actualizarUsuarioAdmin(){
        $data = Input::all();
        $creadoPor          = (int)Session::get('IdUsuario');
        $reglas = array(
            'nombre_usuario_amd'    =>  'required',
            'username_amd'          =>  'required',
            'email_amd'             =>  'required|email',
            'id_rol_amd'            =>  'required',
            'id_categoria_amd'      =>  'required'
        );
        $validador = Validator::make($data, $reglas);
        $messages = $validador->messages();
        foreach ($reglas as $key => $value){
            $verrors[$key] = $messages->first($key);
        }
        if($validador->passes()) {
            $id             = (int)Session::get('IdUsuario');
            $nombreUsuario  = Input::get('nombre_usuario_amd');
            $userName       = Input::get('username_amd');
            $email          = Input::get('email_amd');
            $password       = Input::get('password_amd');
            $contrasena     = hash('sha512', $password);
            $idrol          = Input::get('id_rol_amd');
            $idcategoria    = Input::get('id_categoria_amd');


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
                    $destinationPath = public_path().'/assets/dist/img/profiles';
                    $extension       = $file->getClientOriginalExtension();
                    $nombrearchivo   = str_replace(".", "_", $userName);
                    $filename        = $nombrearchivo.'.'.$extension;
                    $uploadSuccess   = $file->move($destinationPath, $filename);
                    $archivofoto    = file_get_contents($uploadSuccess);
                }

                $NombreFoto         = $filename;
                $ActualizarUsuario = Usuarios::ActualizarUsuarioAdmin($id,$nombreUsuario,$userName,$email,$clave,$NombreFoto,$creadoPor,$idrol,$idcategoria);

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
        $creadoPor          = (int)Session::get('IdUsuario');
        $reglas = array(
            'nombre_usuario_upd'    =>  'required',
            'username_upd'          =>  'required',
            'email_upd'             =>  'required|email',
            'id_rol_upd'            =>  'required',
            'id_categoria_upd'      =>  'required',
            'id_activo_upd'         =>  'required'
        );
        $validador = Validator::make($data, $reglas);
        $messages = $validador->messages();
        foreach ($reglas as $key => $value){
            $verrors[$key] = $messages->first($key);
        }
        if($validador->passes()) {
            $id             = (int)Input::get('idU');
            $nombreUsuario  = Input::get('nombre_usuario_upd');
            $userName       = Input::get('username_upd');
            $email          = Input::get('email_upd');
            $password       = Input::get('password_upd');
            $contrasena     = hash('sha512', $password);
            $idrol          = Input::get('id_rol_upd');
            $idcategoria    = Input::get('id_categoria_upd');
            $idactivo       = (int)Input::get('id_activo_upd');

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
            if (Input::hasFile('profile_pic_upd')) {
                $file            = Input::file('profile_pic_upd');
                $destinationPath = public_path().'/assets/dist/img/profiles';
                $extension       = $file->getClientOriginalExtension();
                $nombrearchivo   = str_replace(".", "_", $userName);
                $filename        = $nombrearchivo.'.'.$extension;
                $uploadSuccess   = $file->move($destinationPath, $filename);
                $archivofoto    = file_get_contents($uploadSuccess);
            }

            $NombreFoto         = $filename;
            $ActualizarUsuario = Usuarios::ActualizarUsuario($id,$nombreUsuario,$userName,$email,$clave,$idactivo,$idrol,$idcategoria,$NombreFoto,$creadoPor);

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

    public function crearUsuarioFinal(){
        $data = Input::all();
        $creadoPor          = (int)Session::get('IdUsuario');
        $reglas = array(
            'nombre_usuario'    =>  'required',
            'username'          =>  'required',
            'email'             =>  'required|email',
            'password'          =>  'required',
            'sede'              =>  'required',
            'area'              =>  'required'
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
            $Cargo          = Input::get('cargo');
            $password       = Input::get('password');
            $contrasena     = hash('sha512', $password);
            $Sede           = (int)Input::get('sede');
            $Area           = (int)Input::get('area');
            $destinationPath = null;
            $filename        = null;
            if (Input::hasFile('profile_pic')) {
                $file            = Input::file('profile_pic');
                $destinationPath = public_path().'/assets/dist/img/profiles';
                $extension       = $file->getClientOriginalExtension();
                $nombrearchivo   = str_replace(".", "_", $userName);
                $filename        = $nombrearchivo.'.'.$extension;
                $uploadSuccess   = $file->move($destinationPath, $filename);
                $archivofoto    = file_get_contents($uploadSuccess);

            }
            $NombreFoto     = $filename;
            $consultarUsuario = Usuarios::BuscarUserFinal($userName);
            if($consultarUsuario){
                $verrors = array();
                array_push($verrors, 'El usuario '.$userName.' ya se encuentra creado');
                return Redirect::to('admin/usuarioFinal')->withErrors(['errors' => $verrors])->withInput();
            }else{
                $crearUsuario = Usuarios::CrearUsuarioFinal($nombreUsuario,$userName,$email,$contrasena,$Sede,$Area,$Cargo,$NombreFoto,$creadoPor);
                if($crearUsuario){
                    $verrors = 'Se creo con éxito el usuario '.$userName;
                    return redirect('admin/usuarioFinal')->with('mensaje', $verrors);
                }else{
                    $verrors = array();
                    array_push($verrors, 'Hubo un problema al crear el usuario');
                    // return redirect('admin/usuarios')->withErrors(['errors' => $verrors])->withInput();
                    return Redirect::to('admin/usuarioFinal')->withErrors(['errors' => $verrors])->withInput();
                }
            }
        }else{
            return redirect('admin/usuarioFinal')->withErrors(['errors' => $verrors]);
        }
    }

    public function actualizarUsuarioFinal(){
        $data = Input::all();
        $creadoPor          = (int)Session::get('IdUsuario');
        $reglas = array(
            'nombre_usuario_upd'    =>  'required',
            'username_upd'          =>  'required',
            'email_upd'             =>  'required|email',
            'sede_upd'              =>  'required',
            'id_activo_upd'         =>  'required'
        );
        $validador = Validator::make($data, $reglas);
        $messages = $validador->messages();
        foreach ($reglas as $key => $value){
            $verrors[$key] = $messages->first($key);
        }
        if($validador->passes()) {
            $id             = (int)Input::get('idUF');
            $nombreUsuario  = Input::get('nombre_usuario_upd');
            $userName       = Input::get('username_upd');
            $email          = Input::get('email_upd');
            $Cargo          = Input::get('cargo_upd');
            $password       = Input::get('password_upd');
            $contrasena     = hash('sha512', $password);
            $Sede           = (int)Input::get('sede_upd');
            $idArea         = (int)Input::get('area_upd');
            $idactivo       = (int)Input::get('id_activo_upd');
            if($password){
                $clave = $contrasena;
            }else{
                $consultarLogin = Usuarios::BuscarUsuarioFinal($id);
                foreach($consultarLogin as $value){
                    $clave = $value->password;
                }
            }
            if($idArea){
                $Area = $idArea;
            }else{
                $consultarLogin = Usuarios::BuscarUsuarioFinal($id);
                foreach($consultarLogin as $value){
                    $Area = $value->area;
                }
            }
            $destinationPath = null;
            $filename        = null;
            if (Input::hasFile('profile_pic_upd')) {
                $file            = Input::file('profile_pic_upd');
                $destinationPath = public_path().'/assets/dist/img/profiles';
                $extension       = $file->getClientOriginalExtension();
                $nombrearchivo   = str_replace(".", "_", $userName);
                $filename        = $nombrearchivo.'.'.$extension;
                $uploadSuccess   = $file->move($destinationPath, $filename);
                $archivofoto    = file_get_contents($uploadSuccess);
            }

            $NombreFoto         = $filename;
            $ActualizarUsuarioFinal = Usuarios::ActualizarUsuarioFinal($id,$nombreUsuario,$userName,$email,$clave,$Sede,$Area,$Cargo,$idactivo,$NombreFoto,$creadoPor);
            if($ActualizarUsuarioFinal){
                $verrors = 'Se actualizo con éxito el usuario '.$userName;
                return redirect('admin/usuarioFinal')->with('mensaje', $verrors);
            }else{
                $verrors = array();
                array_push($verrors, 'Hubo un problema al actualizar el usuario');
                return redirect('admin/usuarioFinal')->withErrors(['errors' => $verrors]);
            }
        }else{
            return redirect('admin/usuarioFinal')->withErrors(['errors' => $verrors]);
        }
    }

}
