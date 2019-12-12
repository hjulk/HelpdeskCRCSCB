<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Roles extends Model
{
    protected $table = "rol";
    public $timestamps = false;
    protected $fillable = array('id','nombre');

    public static function ListarRoles(){
        $roles = DB::Select("SELECT * FROM rol");
        return $roles;
    }

    public static function ListarCategorias(){
        $categorias = DB::Select("SELECT * FROM categoria");
        return $categorias;
    }

    public static function BuscarNombreRol($nombreRol){
        $consultaRol = DB::Select("SELECT * FROM rol WHERE nombre like '%$nombreRol%'");
        return $consultaRol;
    }

    public static function CrearRol($nombreRol){
        $crearRol = DB::insert('INSERT INTO rol (nombre,activo) values (?,?)', [$nombreRol,1]);
        return $crearRol;
    }

    public static function ActualizarRol($id,$nombreRol,$idactivo){
        $actualizarRol = DB::Update("UPDATE rol SET nombre = '$nombreRol', activo = $idactivo WHERE id = $id");
        return $actualizarRol;
    }

    public static function BuscarNombreCategoria($nombreCategoria){
        $consultaCategoria = DB::Select("SELECT * FROM categoria WHERE nombre like '%$nombreCategoria%'");
        // dd("SELECT * FROM categoria WHERE nombre like '%$nombreCategoria%'");
        return $consultaCategoria;
    }

    public static function CrearCategoria($nombreCategoria){
        $crearCategoria = DB::insert('INSERT INTO categoria (nombre,activo) values (?,?)', [$nombreCategoria,1]);
        return $crearCategoria;
    }

    public static function ActualizarCategoria($id,$nombreCategoria,$idactivo){
        $actualizarCategoria = DB::Update("UPDATE categoria SET nombre = '$nombreCategoria', activo = $idactivo WHERE id = $id");
        return $actualizarCategoria;
    }
}
