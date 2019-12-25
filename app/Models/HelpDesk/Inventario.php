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

    public static function BuscarInfoEquipoMovil($Serial){
        $BuscarInfoEquipoMovil = DB::Select("SELECT * FROM equipo_movil WHERE serial LIKE '%$Serial%'");
        return $BuscarInfoEquipoMovil;
    }

    public static function RegistrarEquipoMovil($TipoEquipo,$FechaAdquisicion,$Serial,$Marca,$Modelo,$IMEI,$Capacidad,$LineaMovil,$Area,$NombreAsignado,$EstadoEquipo,$creadoPor){
        date_default_timezone_set('America/Bogota');
        $fecha_sistema  = date('Y-m-d H:i');
        $fechaCreacion  = date('Y-m-d H:i', strtotime($fecha_sistema));
        $RegistrarEquipoMovil = DB::Insert('INSERT INTO equipo_movil (tipo_equipo,fecha_ingreso,serial,marca,modelo,IMEI,capacidad,usuario,area,linea,estado_equipo,created_at,user_id)
                                            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)',
                                            [$TipoEquipo,$FechaAdquisicion,$Serial,$Marca,$Modelo,$IMEI,$Capacidad,$NombreAsignado,$Area,$LineaMovil,$EstadoEquipo,$fechaCreacion,$creadoPor]);

        if($RegistrarEquipoMovil){
            if($LineaMovil){
                DB::Update("UPDATE linea SET estado_equipo = 2 WHERE id = $LineaMovil");
            }

        }
        return $RegistrarEquipoMovil;
    }

    public static function ActualizarEquipoMovil($TipoEquipo,$FechaAdquisicion,$Serial,$Marca,$Modelo,$IMEI,$Capacidad,$LineaMovil,$Area,$NombreAsignado,$EstadoEquipo,$creadoPor,$idEquipoMovil,$Desvincular){
        date_default_timezone_set('America/Bogota');
        $fecha_sistema      = date('Y-m-d H:i');
        $fechaActualizacion = date('Y-m-d H:i', strtotime($fecha_sistema));
        if($Desvincular === 1){
            $IdLineaMovil = 0;
            DB::Update("UPDATE linea UPDATE linea SET estado_equipo = 1 WHERE id = $LineaMovil");
        }else{
            $IdLineaMovil = $LineaMovil;
        }
        if($LineaMovil){
            if(($EstadoEquipo === 3) ||  ($EstadoEquipo === 4)){
                $IdLineaMovil = 0;
                DB::Update("UPDATE linea UPDATE linea SET estado_equipo = 1 WHERE id = $LineaMovil");
            }
        }
        $ActualizarEquipoMovil = DB::Update("UPDATE equipo_movil SET
                                                tipo_equipo     = $TipoEquipo,
                                                fecha_ingreso   = '$FechaAdquisicion',
                                                serial          = '$Serial',
                                                marca           = '$Marca',
                                                modelo          = '$Modelo',
                                                IMEI            = '$IMEI',
                                                capacidad       = '$Capacidad',
                                                usuario         = '$NombreAsignado',
                                                area            = '$Area',
                                                linea           = $IdLineaMovil,
                                                estado_equipo   = $EstadoEquipo,
                                                update_at       = '$fechaActualizacion',
                                                user_id         = $creadoPor
                                                WHERE id = $idEquipoMovil");
        return $ActualizarEquipoMovil;
    }

    public static function BuscarLastEquipoMovil($creadoPor){
        $buscarUltimo = DB::Select("SELECT max(id) as id FROM equipo_movil WHERE user_id = $creadoPor");
        return $buscarUltimo;
    }

    public static function EvidenciaEM($idEquipoMovil,$NombreFoto){
        $Evidencia = DB::Insert('INSERT INTO evidencia_inventario (nombre,id_equipo_movil) VALUES (?, ?)', [$NombreFoto,$idEquipoMovil]);
        return $Evidencia;
    }

    public static function HistorialEM($idEquipoMovil,$Comentario,$EstadoEquipo,$creadoPor){
        date_default_timezone_set('America/Bogota');
        $fecha_sistema      = date('Y-m-d H:i');
        $fechaCreacion = date('Y-m-d H:i', strtotime($fecha_sistema));
        DB::insert('INSERT INTO historial_inventario (id_movil,comentario,status_id,user_id,created)
                    VALUES (?,?,?,?,?)',
                    [$idEquipoMovil,$Comentario,$EstadoEquipo,$creadoPor,$fechaCreacion]);
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

    public static function LineMobileStock(){
        $Stock = DB::Select("SELECT COUNT(*) AS total FROM linea WHERE estado_equipo = 1");
        return $Stock;
    }

    public static function LineMobileAsigned(){
        $Asigned = DB::Select("SELECT COUNT(*) AS total FROM linea WHERE estado_equipo = 2");
        return $Asigned;
    }

    public static function LineMobileMaintenance(){
        $Maintenance = DB::Select("SELECT COUNT(*) AS total FROM linea WHERE estado_equipo = 3");
        return $Maintenance;
    }

    public static function LineMobileObsolete(){
        $Obsolete = DB::Select("SELECT COUNT(*) AS total FROM linea WHERE estado_equipo = 4");
        return $Obsolete;
    }

    public static function ListarLineasMoviles(){
        $ListarEquiposMoviles = DB::Select("SELECT * FROM linea");
        return $ListarEquiposMoviles;
    }

    public static function EvidenciaLineaM($IdLineaMovil){
        $EvidenciaEquipoM = DB::Select("SELECT * FROM evidencia_inventario WHERE id_linea = $IdLineaMovil");
        return $EvidenciaEquipoM;
    }

    public static function EvidenciaLM($idEquipoMovil,$NombreFoto){
        $Evidencia = DB::Insert('INSERT INTO evidencia_inventario (nombre,id_linea) VALUES (?,?)', [$NombreFoto,$idEquipoMovil]);
        return $Evidencia;
    }

    public static function ProveedorLM(){
        $ListarProveedores = DB::Select("SELECT * FROM proveedor_linea");
        return $ListarProveedores;
    }

    public static function BuscarInfoLineaMovil($Serial){
        $BuscarInfoEquipoMovil = DB::Select("SELECT * FROM linea WHERE serial LIKE '%$Serial%'");
        return $BuscarInfoEquipoMovil;
    }

    public static function RegistrarLineaMovil($NroLinea,$FechaAdquisicion,$Serial,$Activo,$Proveedor,$Plan,$PtoCargo,$Cc,$Area,$Personal,$Estado,$creadoPor){
        date_default_timezone_set('America/Bogota');
        $fecha_sistema      = date('Y-m-d H:i');
        $fechaCreacion = date('Y-m-d H:i', strtotime($fecha_sistema));
        $RegistrarLineaMovil = DB::insert('INSERT INTO linea (nro_linea,activo,proveedor,plan,serial,fecha_ingreso,pto_cargo,cc,area,personal,estado_equipo,created_at,user_id)
                                            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)',
                                            [$NroLinea,$Activo,$Proveedor,$Plan,$Serial,$FechaAdquisicion,$PtoCargo,$Cc,$Area,$Personal,$Estado,$fechaCreacion,$creadoPor]);
        return $RegistrarLineaMovil;
    }

    public static function BuscarLastLineaMovil($creadoPor){
        $buscarUltimo = DB::Select("SELECT max(id) as id FROM linea WHERE user_id = $creadoPor");
        return $buscarUltimo;
    }

    public static function HistorialLM($idEquipoMovil,$Comentario,$EstadoEquipo,$creadoPor){
        date_default_timezone_set('America/Bogota');
        $fecha_sistema      = date('Y-m-d H:i');
        $fechaCreacion = date('Y-m-d H:i', strtotime($fecha_sistema));
        DB::insert('INSERT INTO historial_inventario (id_linea,comentario,status_id,user_id,created)
                    VALUES (?,?,?,?,?)',
                    [$idEquipoMovil,$Comentario,$EstadoEquipo,$creadoPor,$fechaCreacion]);
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
        $BuscarAsignado = DB::Select("SELECT * FROM asignados WHERE nombre_usuario LIKE '%$NombreAsignado%' AND id IS NOT NULL");
        foreach($BuscarAsignado as $row){
            $IdAsignado = (int)$row->id;
        }
        $TotalBusqueda  = (int)count($BuscarAsignado);
        if($TotalBusqueda === 0){
            DB::Insert('INSERT INTO asignados (tipo_equipo,id_movil,area,nombre_usuario,estado_asignado,created_at,user_id,id_ticket)
                        VALUES (?,?,?,?,?,?,?,?)',
                        [$TipoEquipo,$idEquipoMovil,$Area,$NombreAsignado,$EstadoEquipo,$fechaCreacion,$creadoPor,0]);
        }else{
            if((int)$EstadoEquipo === 1){
                DB::Update("UPDATE asignados SET id_movil = 1,update_at = '$fechaCreacion' WHERE id = $IdAsignado");
            }else{
                DB::Update("UPDATE asignados SET id_movil = $idEquipoMovil, estado_asignado = $EstadoEquipo, update_at = '$fechaCreacion' WHERE id = $IdAsignado");
            }
        }
    }

    public static function RegistrarAsignadoLM($idEquipoMovil,$Area,$NombreAsignado,$EstadoEquipo,$creadoPor){
        date_default_timezone_set('America/Bogota');
        $fecha_sistema  = date('Y-m-d H:i');
        $fechaCreacion  = date('Y-m-d H:i', strtotime($fecha_sistema));
        $BuscarAsignado = DB::Select("SELECT * FROM asignados WHERE nombre_usuario LIKE '%$NombreAsignado%' AND id IS NOT NULL");
        foreach($BuscarAsignado as $row){
            $IdAsignado = (int)$row->id;
        }
        $TotalBusqueda  = (int)count($BuscarAsignado);
        if($TotalBusqueda === 0){
            DB::Insert('INSERT INTO asignados (id_linea,area,nombre_usuario,estado_asignado,created_at,user_id,id_ticket)
                        VALUES (?,?,?,?,?,?,?)',
                        [$idEquipoMovil,$Area,$NombreAsignado,$EstadoEquipo,$fechaCreacion,$creadoPor,0]);
        }else{
            if((int)$EstadoEquipo === 1){
                DB::Update("UPDATE asignados SET id_linea = 1,update_at = '$fechaCreacion' WHERE id = $IdAsignado");
            }else{
                DB::Update("UPDATE asignados SET id_linea = $idEquipoMovil, estado_asignado = $EstadoEquipo, update_at = '$fechaCreacion' WHERE id = $IdAsignado");
            }
        }
    }

    // IMPRESORAS


}
