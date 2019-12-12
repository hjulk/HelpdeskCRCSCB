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

    public static function CrearUsuario($nombreUsuario,$userName,$email,$contrasena,$idrol,$idcategoria,$idzona,$idsede,$NombreFoto,$administracion){
        date_default_timezone_set('America/Bogota');
        $fecha_sistema = date('Y-m-d H:i');
        $fechaCreacion = date('Y-m-d H:i', strtotime($fecha_sistema));
        $crearUsuario = DB::insert('INSERT INTO user (username,nombre,email,password,profile_pic,activo,id_categoria,id_rol,id_zona,created_at,id_sede,id_area,administrador)
                                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)', [$userName,$nombreUsuario,$email,$contrasena,$NombreFoto,1,$idcategoria,$idrol,$idzona,$fechaCreacion,$idsede,1,$administracion]);
        return $crearUsuario;
    }

    public static function ActualizarUsuario($id,$nombreUsuario,$userName,$email,$contrasena,$idactivo,$idrol,$idcategoria,$idzona,$idsede,$NombreFoto,$administracion){
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
                                                            id_zona = $idzona,
                                                            id_sede = $idsede,
                                                            updated_at = '$fechaActualizacion',
                                                            administrador = $administracion
                                                            WHERE id = $id");

        }else{
            $actualizarUsuario = DB::Update("UPDATE user SET username = '$userName',
                                                            nombre = '$nombreUsuario',
                                                            email = '$email',
                                                            password = '$contrasena',
                                                            activo = $idactivo,
                                                            id_categoria = $idcategoria,
                                                            id_rol = $idrol,
                                                            id_zona = $idzona,
                                                            id_sede = $idsede,
                                                            updated_at = '$fechaActualizacion',
                                                            administrador = $administracion
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

    public static function ActualizarUsuarioAdmin($id,$nombreUsuario,$userName,$email,$contrasena,$NombreFoto){
        date_default_timezone_set('America/Bogota');
        $fecha_sistema      = date('Y-m-d H:i');
        $fechaActualizacion = date('Y-m-d H:i', strtotime($fecha_sistema));
        if($NombreFoto){
            $actualizarUsuario = DB::Update("UPDATE user SET username = '$userName',
                                                            nombre = '$nombreUsuario',
                                                            email = '$email',
                                                            password = '$contrasena',
                                                            profile_pic = '$NombreFoto',
                                                            updated_at = '$fechaActualizacion'
                                                            WHERE id = $id");

        }else{
            $actualizarUsuario = DB::Update("UPDATE user SET username = '$userName',
                                                            nombre = '$nombreUsuario',
                                                            email = '$email',
                                                            password = '$contrasena',
                                                            updated_at = '$fechaActualizacion'
                                                            WHERE id = $id");
        }
        return $actualizarUsuario;
    }

    public static function BuscarNombre($id_usuario){
        $consulta = DB::Select("SELECT * FROM user WHERE id = $id_usuario");
        // $consulta = DB::table('user')->where('username',$Usuario)->get();
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

    public static function BuscarNombreArea($id_area){
        $consulta = DB::Select("SELECT nombre FROM areas WHERE id = $id_area");
        // $consulta = DB::table('user')->where('username',$Usuario)->get();
        return $consulta;
    }

    public static function BuscarNombreSede($id_sede){
        $consulta = DB::Select("SELECT name FROM project WHERE id = $id_sede");
        // $consulta = DB::table('user')->where('username',$Usuario)->get();
        return $consulta;
    }

    public static function Rol(){
        $Rol = DB::Select("SELECT * FROM rol");
        return $Rol;
    }

    public static function Categoria(){
        $Categoria = DB::Select("SELECT * FROM category");
        return $Categoria;
    }

    public static function RolID($id_rol){
        $Rol = DB::Select("SELECT * FROM rol WHERE rol_id = $id_rol");
        return $Rol;
    }

    public static function CategoriaID($id_categoria){
        $Categoria = DB::Select("SELECT * FROM categoria WHERE id = $id_categoria");
        return $Categoria;
    }

    public static function Activo(){
        $activo = DB::Select("SELECT * FROM activo");
        return $activo;
    }

    public static function Desicion(){
        $activo = DB::Select("SELECT * FROM desicion");
        return $activo;
    }

    public static function ActivoID($id_activo){
        $activo = DB::Select("SELECT * FROM activo WHERE id = $id_activo");
        return $activo;
    }

    public static function ListarUsuarios(){
        $Usuarios = DB::Select("SELECT * FROM user ORDER BY nombre");
        return $Usuarios;
    }

    public static function BuscarXCategoria($id_categoria){
        $activo = DB::Select("SELECT * FROM user WHERE id_categoria = $id_categoria ORDER BY nombre");
        return $activo;
    }

    public static function BuscarXZona($id_zona){
        $activo = DB::Select("SELECT * FROM sedes WHERE id_zona = $id_zona ORDER BY nombre");
        return $activo;
    }

    public static function BuscarXSede($id_sede){
        $activo = DB::Select("SELECT * FROM areas WHERE id_sede = $id_sede");
        return $activo;
    }

    public static function ActualizarProfile($Password,$idUsuario,$NombreFoto){
        $fecha_sistema      = date('Y-m-d H:i');
        $updateProfile = DB::Update("UPDATE user SET password = '$Password',
                                            profile_pic = '$NombreFoto',
                                            updated_at = '$fecha_sistema'
                                            WHERE id = $idUsuario");
        return $updateProfile;
    }

    public static function RestablecerPassword($UserName,$UserEmail){
        $contrasena= DB::Select("SELECT * FROM user WHERE username = '$UserName' AND email = '$UserEmail'");
        return $contrasena;
    }

    public static function NuevaContrasena($idUser,$nuevaContrasena){

        $contrasena = DB::Update("UPDATE user SET PASSWORD = '$nuevaContrasena' WHERE id = $idUser");
        return $contrasena;
    }

}
