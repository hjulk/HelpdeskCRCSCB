<?php

namespace App\Models\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Sedes extends Model
{
    protected $table = "sedes";
    public $timestamps = false;

    public static function Sedes(){
        $Sedes = DB::Select("SELECT * FROM project ORDER BY name");
        return $Sedes;
    }

    public static function BuscarSedeID($idsede){
        $consultaSedeId = DB::Select("SELECT * FROM project WHERE id = $idsede");
        return $consultaSedeId;
    }

    public static function BuscarSede($Sede){
        $consultaSede = DB::Select("SELECT * FROM project WHERE name LIKE '%$Sede%'");
        return $consultaSede;
    }

    public static function CrearSede($Sede,$Descripcion){
        $CrearSedes = DB::Insert('INSERT INTO project (name,description,activo)
                                    VALUES (?,?)', [$Sede,$Descripcion,1]);
        return $CrearSedes;
    }

    public static function ActualizarSede($id,$Sede,$Descripcion,$idActivo){
        $ActualizarSede = DB::Update("UPDATE project SET name = '$Sede', description = '$Descripcion',activo = $idActivo WHERE id = $id");
        return $ActualizarSede;
    }
}
