<?php

namespace App\Models\HelpDesk;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Inventario extends Model
{
    public static function ListarEstado(){
        $ListarEstado = DB::Select("SELECT * FROM activo");
        return $ListarEstado;
    }

    public static function ListarEstadoEquipos(){
        $ListarEstado = DB::Select("SELECT * FROM estado_equipo");
        return $ListarEstado;
    }

    public static function EstadoEquipoId($IdEstadoEquipo){
    $EstadoEquipoId    = DB::Select("SELECT * FROM estado_equipo WHERE id = $IdEstadoEquipo");
        return $EstadoEquipoId;
    }

    // EQUIPOS MOVILES

    public static function MobileStock(){
        $Stock = DB::Select("SELECT COUNT(*) AS total FROM equipo_movil WHERE estado_equipo = 1");
        return $Stock;
    }

    public static function MobileAsigned(){
        $Asigned = DB::Select("SELECT COUNT(*) AS total FROM equipo_movil WHERE estado_equipo = 2");
        return $Asigned;
    }

    public static function MobileMaintenance(){
        $Maintenance = DB::Select("SELECT COUNT(*) AS total FROM equipo_movil WHERE estado_equipo = 3");
        return $Maintenance;
    }

    public static function MobileObsolete(){
        $Obsolete = DB::Select("SELECT COUNT(*) AS total FROM equipo_movil WHERE estado_equipo = 4");
        return $Obsolete;
    }

    public static function ListarEquiposMoviles(){
        $ListarEquiposMoviles = DB::Select("SELECT * FROM equipo_movil");
        return $ListarEquiposMoviles;
    }

    public static function EvidenciaEquipoM($IdEquipoMovil){
        $EvidenciaEquipoM = DB::Select("SELECT * FROM evidencia_inventario WHERE id_equipo_movil = $IdEquipoMovil");
        return $EvidenciaEquipoM;
    }

    public static function ListadoTipoEquipoMovil(){
        $ListadoTipoEquipoMovil = DB::Select("SELECT * FROM tipo_equipo WHERE id IN (3,4,5)");
        return $ListadoTipoEquipoMovil;
    }

    public static function RegistrarEquipoMovil($TipoEquipo,$FechaAdquisicion,$Serial,$Marca,$Modelo,$IMEI,$Capacidad,$LineaMovil,$Area,$NombreAsignado,$EstadoEquipo,$creadoPor){
        date_default_timezone_set('America/Bogota');
        $fecha_sistema  = date('Y-m-d H:i');
        $fechaCreacion  = date('Y-m-d H:i', strtotime($fecha_sistema));
        $RegistrarEquipoMovil = DB::Insert('INSERT INTO equipo_movil (tipo_equipo,fecha_ingreso,serial,marca,modelo,IMEI,capacidad,usuario,area,linea,estado_equipo,created_at,user_id)
                                            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)',
                                            [$TipoEquipo,$FechaAdquisicion,$Serial,$Marca,$Modelo,$IMEI,$Capacidad,$NombreAsignado,$Area,$LineaMovil,$EstadoEquipo,$fechaCreacion,$creadoPor]);

        if($RegistrarEquipoMovil){
            DB::Update("UPDATE linea SET estado_equipo = 2 WHERE id = $LineaMovil");
        }
        return $RegistrarEquipoMovil;
    }

    public static function BuscarLastEquipoMovil($creadoPor){
        $buscarUltimo = DB::Select("SELECT max(id) as id FROM equipo_movil WHERE user_id = $creadoPor");
        return $buscarUltimo;
    }

    public static function EvidenciaEM($idEquipoMovil,$NombreFoto){
        $Evidencia = DB::Insert('INSERT INTO evidencia_inventario (nombre,id_equipo_movil) VALUES (?, ?)', [$NombreFoto,$idEquipoMovil]);
        return $Evidencia;
    }

    // LINEA MOVIL

    public static function BuscarNroLinea($IdLinea){
        $BuscarNroLinea = DB::Select("SELECT * FROM linea WHERE id = $IdLinea");
        return $BuscarNroLinea;
    }

    public static function ListadoLineaMovil(){
        $ListadoLineaMovil = DB::Select("SELECT * FROM linea WHERE estado_equipo = 1 ORDER BY nro_linea");
        return $ListadoLineaMovil;
    }

    public static function ListadoLineaMovilUpd(){
        $ListadoLineaMovil = DB::Select("SELECT * FROM linea ORDER BY nro_linea");
        return $ListadoLineaMovil;
    }

    // EQUIPOS

    public static function ListarEquipoUsuarioC(){
        $ListarEquipo = DB::Select("SELECT * FROM tipo_equipo WHERE id IN (1,2)");
        return $ListarEquipo;
    }

    public static function BuscarEquipoId($IdTipoEquipo){
        $BuscarEquipoId = DB::Select("SELECT * FROM tipo_equipo WHERE id = $IdTipoEquipo");
        return $BuscarEquipoId;
    }

    // PERIFERICOS


    // CONSUMIBLES


    // ASIGNACIONES
    public static function RegistrarAsignadoEM($TipoEquipo,$idEquipoMovil,$Area,$NombreAsignado,$EstadoEquipo,$creadoPor){
        date_default_timezone_set('America/Bogota');
        $fecha_sistema  = date('Y-m-d H:i');
        $fechaCreacion  = date('Y-m-d H:i', strtotime($fecha_sistema));
        DB::Insert('INSERT INTO asignados (tipo_equipo,id_movil,area,nombre_usuario,estado_asignado,created_at,user_id,id_ticket)
                    VALUES (?,?,?,?,?,?,?,?)',
                    [$TipoEquipo,$idEquipoMovil,$Area,$NombreAsignado,$EstadoEquipo,$fechaCreacion,$creadoPor,0]);
    }

    // IMPRESORAS


}
