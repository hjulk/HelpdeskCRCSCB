<?php

namespace App\Models\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Sedes extends Model
{
    protected $table = "sedes";
    public $timestamps = false;

    public static function Zonas(){
        $Zonas = DB::Select("SELECT * FROM zona ORDER BY nombre");
        return $Zonas;
    }
    public static function Sedes(){
        $Sedes = DB::Select("SELECT * FROM sedes ORDER BY nombre");
        return $Sedes;
    }
    public static function Sedes1(){
        $Sedes = DB::Select("SELECT * FROM sedes WHERE id_zona = 1 ORDER BY nombre");
        return $Sedes;
    }
    public static function Sedes2(){
        $Sedes = DB::Select("SELECT * FROM sedes WHERE id_zona = 2 ORDER BY nombre");
        return $Sedes;
    }
    public static function Sedes3(){
        $Sedes = DB::Select("SELECT * FROM sedes WHERE id_zona = 3 ORDER BY nombre");
        return $Sedes;
    }

    public static function Areas1(){
        $Areas = DB::Select("SELECT * FROM areas WHERE id_zona = 1 ORDER BY nombre");
        return $Areas;
    }
    public static function Areas2(){
        $Areas = DB::Select("SELECT * FROM areas WHERE id_zona = 2 ORDER BY nombre");
        return $Areas;
    }
    public static function Areas3(){
        $Areas = DB::Select("SELECT * FROM areas WHERE id_zona = 3 ORDER BY nombre");
        return $Areas;
    }

    public static function Areas(){
        $Areas = DB::Select("SELECT * FROM areas WHERE activa = 1 ORDER BY nombre");
        return $Areas;
    }

    public static function AreasInventario(){
        $Areas = DB::Select("SELECT * FROM areas ORDER BY nombre");
        return $Areas;
    }

    public static function BuscarZona($Zona){
        $consultaZona = DB::Select("SELECT * FROM zona WHERE nombre like '%$Zona%'");

        return $consultaZona;
    }
    public static function BuscarZonaID($idzona){
        $consultaZonaId = DB::Select("SELECT * FROM zona WHERE id = $idzona AND activa = 1");

        return $consultaZonaId;
    }
    public static function CrearZona($Zona){
        $InsertarZona = DB::insert('INSERT INTO zona (nombre,activa) VALUES (?, ?)', [$Zona,1]);

        return $InsertarZona;
    }
    public static function ActualizarZona($id,$nombre,$activo){
        $ActualizarZona = DB::Update("UPDATE zona SET nombre = '$nombre', activa = $activo WHERE id = $id");
        return $ActualizarZona;
    }

    public static function BuscarSede($Sede){
        $consultaSede = DB::Select("SELECT * FROM sedes WHERE nombre like '%$Sede%'");

        return $consultaSede;
    }
    public static function BuscarSedeID($idsede){
        $consultaSedeId = DB::Select("SELECT * FROM sedes WHERE id = $idsede AND activa = 1");

        return $consultaSedeId;
    }

    public static function BuscarSedeA($id_zona){
        $consultaSedeId = DB::Select("SELECT * FROM sedes WHERE id_zona = $id_zona AND activa = 1");

        return $consultaSedeId;
    }
    public static function CrearSede($Sede,$Direccion,$Zona){
        $InsertarSede = DB::insert('INSERT INTO sedes (nombre,direccion,id_zona,activa) VALUES (?,?,?,?)', [$Sede,$Direccion,$Zona,1]);
        return $InsertarSede;
    }
    public static function ActualizarSede($id,$nombre,$direccion,$activo){
        $ActualizarSede = DB::Update("UPDATE sedes SET nombre = '$nombre', direccion = '$direccion', activa = $activo WHERE id = $id");
        return $ActualizarSede;
    }
    public static function BuscarArea($Area){
        $consultaArea = DB::Select("SELECT * FROM areas WHERE nombre like '%$Area%'");
        return $consultaArea;
    }

    public static function BuscarAreaID($idarea){
        $consultaSedeId = DB::Select("SELECT * FROM areas WHERE id = $idarea AND activa = 1");

        return $consultaSedeId;
    }

    public static function CrearArea($Area){
        $InsertarArea = DB::insert('INSERT INTO areas (nombre,activa) VALUES (?,?)', [$Area,1]);
        return $InsertarArea;
    }
    public static function ActualizarArea($id,$nombre,$activo){
        $ActualizarArea = DB::Update("UPDATE areas SET nombre = '$nombre', activa = $activo WHERE id = $id");
        return $ActualizarArea;
    }


}
