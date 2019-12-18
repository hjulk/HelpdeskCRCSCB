<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Usuarios extends Model
{
    protected $table = "user";
    public $timestamps = false;
    protected $fillable = array('id_user','username','name','email','password','profile_pic','active','rol_id','category_id','created_at','update_at');

    public static function BuscarUser($Usuario){
        $consulta = DB::Select("SELECT * FROM user WHERE username = '$Usuario'");
        // $consulta = DB::table('user')->where('username',$Usuario)->get();
        return $consulta;
    }

    public static function BuscarUserEmail($UserEmail){
        $consulta = DB::Select("SELECT * FROM user WHERE email = '$UserEmail'");
        // $consulta = DB::table('user')->where('username',$Usuario)->get();
        return $consulta;
    }

    public static function BuscarPass($Usuario,$clave){

        $consulta = DB::Select("SELECT * FROM user WHERE username = '$Usuario' AND password = '$clave'");
        // $consulta = DB::table('user')->where('username',$Usuario)->where('password',$clave)->get();
        return $consulta;
    }

    public static function CrearUsuario($nombreUsuario,$userName,$email,$contrasena,$idrol,$idcategoria,$NombreFoto,$creadoPor){
        date_default_timezone_set('America/Bogota');
        $fecha_sistema = date('Y-m-d H:i');
        $fechaCreacion = date('Y-m-d H:i', strtotime($fecha_sistema));
        $crearUsuario = DB::insert('INSERT INTO user (username,name,email,password,profile_pic,is_active,kind,rol_id,category_id,created_at,creado_por)
                                    VALUES (?,?,?,?,?,?,?,?,?,?,?)',
                                    [$userName,$nombreUsuario,$email,$contrasena,$NombreFoto,1,1,$idrol,$idcategoria,$fechaCreacion,$creadoPor]);
        return $crearUsuario;
    }

    public static function ActualizarUsuario($id,$nombreUsuario,$userName,$email,$contrasena,$idactivo,$idrol,$idcategoria,$NombreFoto,$creadoPor){
        date_default_timezone_set('America/Bogota');
        $fecha_sistema      = date('Y-m-d H:i');
        $fechaActualizacion = date('Y-m-d H:i', strtotime($fecha_sistema));
        if($NombreFoto){
            $actualizarUsuario = DB::Update("UPDATE user SET username       = '$userName',
                                                            name            = '$nombreUsuario',
                                                            email           = '$email',
                                                            password        = '$contrasena',
                                                            profile_pic     = '$NombreFoto',
                                                            is_active       = $idactivo,
                                                            category_id     = $idcategoria,
                                                            rol_id          = $idrol,
                                                            updated_at      = '$fechaActualizacion',
                                                            actualizado_por = $creadoPor
                                                            WHERE id = $id");

        }else{
            $actualizarUsuario = DB::Update("UPDATE user SET username           = '$userName',
                                                                name            = '$nombreUsuario',
                                                                email           = '$email',
                                                                password        = '$contrasena',
                                                                is_active       = $idactivo,
                                                                category_id     = $idcategoria,
                                                                rol_id          = $idrol,
                                                                updated_at      = '$fechaActualizacion',
                                                                actualizado_por = $creadoPor
                                                                WHERE id = $id");
        }
        return $actualizarUsuario;
    }

    public static function ActualizarUsuarioP($id,$nombreUsuario,$userName,$email,$contrasena,$idactivo,$idrol,$idcategoria,$NombreFoto){
        date_default_timezone_set('America/Bogota');
        $fecha_sistema      = date('Y-m-d H:i');
        $fechaActualizacion = date('Y-m-d H:i', strtotime($fecha_sistema));
        if($NombreFoto){
            $actualizarUsuario = DB::Update("UPDATE user SET username = '$userName',
                                                            nombre = '$nombreUsuario',
                                                            email = '$email',
                                                            password = '$contrasena',
                                                            profile_pic = '$NombreFoto',
                                                            activo = $idactivo,
                                                            id_categoria = $idcategoria,
                                                            id_rol = $idrol,
                                                            updated_at = '$fechaActualizacion'
                                                            WHERE id = $id");

        }else{
            $actualizarUsuario = DB::Update("UPDATE user SET username = '$userName',
                                                            nombre = '$nombreUsuario',
                                                            email = '$email',
                                                            password = '$contrasena',
                                                            activo = $idactivo,
                                                            id_categoria = $idcategoria,
                                                            id_rol = $idrol,
                                                            updated_at = '$fechaActualizacion'
                                                            WHERE id = $id");
        }
        return $actualizarUsuario;
    }

    public static function ActualizarUsuarioAdmin($id,$nombreUsuario,$userName,$email,$contrasena,$NombreFoto,$creadoPor,$idrol,$idcategoria){
        date_default_timezone_set('America/Bogota');
        $fecha_sistema      = date('Y-m-d H:i');
        $fechaActualizacion = date('Y-m-d H:i', strtotime($fecha_sistema));
        if($NombreFoto){
            $actualizarUsuario = DB::Update("UPDATE user SET username = '$userName',
                                                            name = '$nombreUsuario',
                                                            email = '$email',
                                                            password = '$contrasena',
                                                            profile_pic = '$NombreFoto',
                                                            updated_at = '$fechaActualizacion',
                                                            actualizado_por = $creadoPor,
                                                            rol_id = $idrol,
                                                            category_id = $idcategoria
                                                            WHERE id = $id");

        }else{
            $actualizarUsuario = DB::Update("UPDATE user SET username = '$userName',
                                                            name = '$nombreUsuario',
                                                            email = '$email',
                                                            password = '$contrasena',
                                                            updated_at = '$fechaActualizacion',
                                                            actualizado_por = $creadoPor,
                                                            rol_id = $idrol,
                                                            category_id = $idcategoria
                                                            WHERE id = $id");
        }
        return $actualizarUsuario;
    }

    public static function BuscarNombre($id_usuario){
        $consulta = DB::Select("SELECT * FROM user WHERE id = $id_usuario");
        return $consulta;
    }

    public static function BuscarNombreRol($id_rol){
        $consulta = DB::Select("SELECT name FROM rol WHERE rol_id = $id_rol");
        // $consulta = DB::table('user')->where('username',$Usuario)->get();
        return $consulta;
    }

    public static function BuscarNombreCategoria($id_categoria){
        $consulta = DB::Select("SELECT name FROM category WHERE id = $id_categoria");
        // $consulta = DB::table('user')->where('username',$Usuario)->get();
        return $consulta;
    }

    public static function BuscarNombreSede($id_sede){
        $consulta = DB::Select("SELECT name FROM project WHERE id = $id_sede");
        // $consulta = DB::table('user')->where('username',$Usuario)->get();
        return $consulta;
    }

    public static function Rol(){
        $Rol = DB::Select("SELECT * FROM rol WHERE activo = 1");
        return $Rol;
    }

    public static function Categoria(){
        $Categoria = DB::Select("SELECT * FROM category WHERE activo = 1");
        return $Categoria;
    }

    public static function RolID($id_rol){
        $Rol = DB::Select("SELECT * FROM rol WHERE rol_id = $id_rol");
        return $Rol;
    }

    public static function CategoriaID($id_categoria){
        $Categoria = DB::Select("SELECT * FROM category WHERE id = $id_categoria");
        return $Categoria;
    }

    public static function Activo(){
        $activo = DB::Select("SELECT * FROM activo");
        return $activo;
    }


    public static function ActivoID($id_activo){
        $activo = DB::Select("SELECT * FROM activo WHERE id = $id_activo");
        return $activo;
    }

    public static function ListarUsuarios(){
        $Usuarios = DB::Select("SELECT * FROM user ORDER BY name");
        return $Usuarios;
    }

    public static function BuscarXCategoria($id_categoria){
        $activo = DB::Select("SELECT * FROM user WHERE category_id = $id_categoria ORDER BY name");
        return $activo;
    }

    public static function BuscarXSede($id_sede){
        $activo = DB::Select("SELECT * FROM areas WHERE id_sede = $id_sede");
        return $activo;
    }

    public static function ActualizarProfile($Password,$idUsuario,$NombreFoto,$creadoPor){
        $fecha_sistema      = date('Y-m-d H:i');
        $updateProfile = DB::Update("UPDATE user SET password = '$Password',
                                            profile_pic = '$NombreFoto',
                                            updated_at = '$fecha_sistema',
                                            actualizado_por = $creadoPor
                                            WHERE id = $idUsuario");
        return $updateProfile;
    }

    public static function RestablecerPassword($UserName,$UserEmail){
        $contrasena= DB::Select("SELECT * FROM user WHERE username = '$UserName' AND email = '$UserEmail'");
        return $contrasena;
    }

    public static function NuevaContrasena($idUser,$nuevaContrasena){

        $contrasena = DB::Update("UPDATE user SET password = '$nuevaContrasena' WHERE id = $idUser");
        return $contrasena;
    }

    public static function UsuarioTicket($Categoria){
        $BuscarUsuario = DB::Select("SELECT * FROM user WHERE category_id = $Categoria AND rol_id = 3 AND is_active = 1");
        return $BuscarUsuario;
    }

    public static function UsuarioTicketBackup($Categoria){
        $BuscarUsuario = DB::Select("SELECT * FROM user WHERE category_id = $Categoria AND is_active = 1");
        return $BuscarUsuario;
    }

}
