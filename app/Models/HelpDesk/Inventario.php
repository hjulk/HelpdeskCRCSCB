<?php

namespace App\Models\HelpDesk;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Inventario extends Model
{
    public static function ListarEquiposMoviles(){
        $ListarMobiles = DB::Select("SELECT * FROM mobile");
        return $ListarMobiles;
    }

    public static function BuscarInfoLinea($IdEquipo){
        $ListarMobiles = DB::Select("SELECT * FROM mobile WHERE id = $IdEquipo");
        return $ListarMobiles;
    }

    public static function BuscarInfoNumLinea($Linea){
        $ListarMobiles = DB::Select("SELECT * FROM mobile WHERE linea like '$Linea'");
        return $ListarMobiles;
    }

    public static function UsuarioInventario($usuario_inventario){
        $UsuarioInventario = DB::Select("SELECT * FROM usuario_inventario WHERE id_usuario = $usuario_inventario");
        return $UsuarioInventario;
    }

    public static function InputMobile($Linea, $Operador, $Empresa, $Plan, $Datos, $MinutosClaro, $MinutosOtro, $SMSClaro, $SMSOtro, $Equipo1, $IMEI1, $Equipo2, $IMEI2, $Equipo3, $IMEI3, $FechaCorte, $CargoFijo, $Servicio, $Cuenta, $NombreUsuario, $Cedula, $Cargo, $Area, $Sede, $CentroCostos, $creadoPor){
        date_default_timezone_set('America/Bogota');
        $fecha_sistema  = date('Y-m-d H:i');
        $fechaCreacion  = date('Y-m-d H:i', strtotime($fecha_sistema));
        $buscarUsuario  = DB::Select("SELECT * FROM usuario_inventario WHERE cedula = '$Cedula'");
        $ContadorResultado = count($buscarUsuario);
        foreach($buscarUsuario as $row){
            $id_usuario = $row->id_usuario;
        }
        if($ContadorResultado > 0){
            $usuario_inventario = $id_usuario;
        }else{
            $IngresarUsuario = DB::Insert('INSERT INTO usuario_inventario (nombre_usuario,cedula,cargo,area,sede,creado_por,fecha_creacion)
                                           VALUES (?,?,?,?,?,?,?)',
                                           [$NombreUsuario,$Cedula,$Cargo,$Area,$Sede,$creadoPor,$fechaCreacion]);
            if($IngresarUsuario){
                $buscarUltimo = DB::Select("SELECT max(id_usuario) as id FROM usuario_inventario WHERE creado_por = $creadoPor");
                foreach($buscarUltimo as $value){
                    $usuario_inventario = $value->id;
                }
            }
        }
        $InputMobile = DB::Insert('INSERT INTO mobile (linea,operador,empresa,plan,datos,minutos_claro,minutos_otro,sms_claro,sms_otro,fecha_corte,cargo_fijo,equipo1,imei1,equipo2,imei2,equipo3,imei3,servicio,cuenta,usuario_inventario,centro_costos,creado_por,fecha_creacion,estado)
                                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
                                    [$Linea,$Operador,$Empresa,$Plan,$Datos,$MinutosClaro,$MinutosOtro,$SMSClaro,$SMSOtro,$FechaCorte,$CargoFijo,$Equipo1,$IMEI1,$Equipo2,$IMEI2,$Equipo3,$IMEI3,$Servicio,$Cuenta,$usuario_inventario,$CentroCostos,$creadoPor,$fechaCreacion,1]);
        return$InputMobile;
    }

    public static function BuscarArea($id_area){
        $consultaSedeId = DB::Select("SELECT * FROM areas WHERE id = $id_area");
        return $consultaSedeId;
    }

    public static function BuscarSede($id_sede){
        $consultaSedeId = DB::Select("SELECT * FROM sedes WHERE id = $id_sede");
        return $consultaSedeId;
    }

    public static function UpdateMobile($Linea, $Operador, $Empresa, $Plan, $Datos, $MinutosClaro, $MinutosOtro, $SMSClaro, $SMSOtro, $Equipo1, $IMEI1, $Equipo2, $IMEI2, $Equipo3, $IMEI3, $FechaCorte, $CargoFijo, $Servicio, $Cuenta, $NombreUsuario, $Cedula, $Cargo, $Area, $Sede, $CentroCostos, $creadoPor, $Estado, $IdEquipo,$idUsuarioInv){
        date_default_timezone_set('America/Bogota');
        $fecha_sistema      = date('Y-m-d H:i');
        $fechaActualizacion = date('Y-m-d H:i', strtotime($fecha_sistema));
        $UpdateUsuario      = DB::Update("UPDATE usuario_inventario SET
                                            nombre_usuario      = '$NombreUsuario',
                                            cedula              = '$Cedula',
                                            cargo               = '$Cargo',
                                            area                = $Area,
                                            sede                = $Sede,
                                            actualizado_por     = $creadoPor,
                                            fecha_actualizacion = '$fechaActualizacion'
                                            WHERE id_usuario = $idUsuarioInv");
        $ActualizacionAsignacion = DB::Update("UPDATE mobile SET
                                                linea               = '$Linea',
                                                operador            = '$Operador',
                                                empresa             = '$Empresa',
                                                plan                = '$Plan',
                                                datos               = '$Datos',
                                                minutos_claro       = '$MinutosClaro',
                                                minutos_otro        = '$MinutosOtro',
                                                sms_claro           = '$SMSClaro',
                                                sms_otro            = '$SMSOtro',
                                                fecha_corte        = '$FechaCorte',
                                                cargo_fijo          = '$CargoFijo',
                                                equipo1             = '$Equipo1',
                                                imei1               = '$IMEI1',
                                                equipo2             = '$Equipo2',
                                                imei2               = '$IMEI2',
                                                equipo3             = '$Equipo3',
                                                imei3               = '$IMEI3',
                                                servicio            = '$Servicio',
                                                cuenta              = '$Cuenta',
                                                usuario_inventario  = $idUsuarioInv,
                                                actualizado_por     = $creadoPor,
                                                fecha_actualizacion = '$fechaActualizacion',
                                                estado              = $Estado
                                                WHERE id = $IdEquipo");
        return $ActualizacionAsignacion;
    }

    public static function CrearResponsable($NombreUsuario,$Cedula,$Cargo,$Area,$Sede,$CentroCostos,$IdEquipo,$creadoPor){
        date_default_timezone_set('America/Bogota');
        $fecha_sistema  = date('Y-m-d H:i');
        $fechaCreacion  = date('Y-m-d H:i', strtotime($fecha_sistema));
        $BuscarResponsable = DB::Select("SELECT * FROM usuario_inventario WHERE cedula = '$Cedula'");
        if($BuscarResponsable){
            foreach($BuscarResponsable as $value){
                $IdUsuario = $value->id_usuario;
            }
            $BuscarResponsableMobile = DB::Select("SELECT * FROM responsable_mobile WHERE id_responsable = $IdUsuario AND id_mobile = $IdEquipo");
            if($BuscarResponsableMobile){
                foreach($BuscarResponsableMobile as $value){
                    $IdResponsable = $value->id;
                }
                DB::Update("UPDATE responsable_mobile SET
                            id_responsable = $IdUsuario,
                            id_mobile = $IdEquipo
                            WHERE id = $IdResponsable");
            }else{
                $IngresarResponsable = DB::Insert('INSERT INTO responsable_mobile (id_responsable,id_mobile,creado_por,fecha_creacion,estado)
                                                    VALUES (?,?,?,?,?)',
                                                    [$IdUsuario,$IdEquipo,$creadoPor,$fechaCreacion,1]);
                return $IngresarResponsable;
            }
        }else{
            $IngresarUsuario = DB::Insert('INSERT INTO usuario_inventario (nombre_usuario,cedula,cargo,area,sede,centro_costos,creado_por,fecha_creacion)
                                           VALUES (?,?,?,?,?,?,?,?)',
                                           [$NombreUsuario,$Cedula,$Cargo,$Area,$Sede,$CentroCostos,$creadoPor,$fechaCreacion]);
            if($IngresarUsuario){
                $buscarUltimo = DB::Select("SELECT max(id_usuario) as id FROM usuario_inventario WHERE creado_por = $creadoPor");
                foreach($buscarUltimo as $value){
                    $usuario_inventario = $value->id;
                }
                $IngresarResponsable = DB::Insert('INSERT INTO responsable_mobile (id_responsable,id_mobile,creado_por,fecha_creacion,estado)
                                                VALUES (?,?,?,?,?)',
                                                [$usuario_inventario,$IdEquipo,$creadoPor,$fechaCreacion,1]);
                return $IngresarResponsable;
            }
        }

    }

    public static function ActualizarResponsable($NombreUsuario,$Cedula,$Cargo,$Area,$Sede,$CentroCostos,$IdEquipo,$creadoPor,$Estado,$IdResponsable){
        date_default_timezone_set('America/Bogota');
        $fecha_sistema  = date('Y-m-d H:i');
        $fechaCreacion  = date('Y-m-d H:i', strtotime($fecha_sistema));
        $BuscarResponsable = DB::Select("SELECT * FROM usuario_inventario WHERE cedula = '$Cedula'");
        if($BuscarResponsable){
            foreach($BuscarResponsable as $value){
                $IdUsuario = $value->id_usuario;
            }
            $UpdateUsuario      = DB::Update("UPDATE usuario_inventario SET
                                            nombre_usuario      = '$NombreUsuario',
                                            cedula              = '$Cedula',
                                            cargo               = '$Cargo',
                                            area                = $Area,
                                            sede                = $Sede,
                                            actualizado_por     = $creadoPor,
                                            fecha_actualizacion = '$fechaCreacion'
                                            WHERE id_usuario = $IdUsuario");
            $actualizacion = DB::Update("UPDATE responsable_mobile SET
                            id_responsable = $IdUsuario,
                            id_mobile = $IdEquipo,
                            estado = $Estado,
                            actualizado_por = $creadoPor,
                            fecha_actualizacion = '$fechaCreacion'
                            WHERE id = $IdResponsable");
            return $actualizacion;

        }else{
            $IngresarUsuario = DB::Insert('INSERT INTO usuario_inventario (nombre_usuario,cedula,cargo,area,sede,centro_costos,creado_por,fecha_creacion)
                                           VALUES (?,?,?,?,?,?,?,?)',
                                           [$NombreUsuario,$Cedula,$Cargo,$Area,$Sede,$CentroCostos,$creadoPor,$fechaCreacion]);
            if($IngresarUsuario){
                $buscarUltimo = DB::Select("SELECT max(id_usuario) as id FROM usuario_inventario WHERE creado_por = $creadoPor");
                foreach($buscarUltimo as $value){
                    $usuario_inventario = $value->id;
                }
                $actualizacion = DB::Insert('INSERT INTO responsable_mobile (id_responsable,id_mobile,creado_por,fecha_creacion,estado)
                                                VALUES (?,?,?,?,?)',
                                                [$usuario_inventario,$IdEquipo,$creadoPor,$fechaCreacion,1]);
                return $actualizacion;
            }
        }

    }

    public static function BuscarResponsableMobile($idLinea){
        $BuscarResponsable = DB::Select("SELECT * FROM responsable_mobile WHERE id_mobile = $idLinea AND estado = 1");
        return $BuscarResponsable;
    }

    public static function BuscarNovedadMobile($idLinea){
        $BuscarNovedad = DB::Select("SELECT * FROM novedad_mobile WHERE id_equipo = $idLinea AND estado = 1");
        return $BuscarNovedad;
    }

    public static function desctivarResponsableMovil($idResponsable){
        $updateResponsable = DB::Update("UPDATE responsable_mobile SET estado = 0 WHERE id = $idResponsable");;
        return $updateResponsable;
    }

    public static function ListarNovedadesMobile(){
        $ListarNovedadesMobile = DB::Select("SELECT * FROM mobile");
        return $ListarNovedadesMobile;
    }

    public static function ListarNovedadMobileId($IdLinea){
        $ListarNovedadesMobile = DB::Select("SELECT * FROM novedad_mobile WHERE id_equipo = $IdLinea");
        return $ListarNovedadesMobile;
    }

    public static function CrearNovedadMobile($IdEquipo,$AnoNovedad,$MesNovedad,$ValorMes,$Novedad,$creadoPor){
        date_default_timezone_set('America/Bogota');
        $fecha_sistema  = date('Y-m-d H:i');
        $fechaCreacion  = date('Y-m-d H:i', strtotime($fecha_sistema));
        $CrearNovedadMobile = DB::Insert('INSERT INTO novedad_mobile (id_equipo,year,mes,valor_mes,novedad_mes,creado_por,fecha_creacion,estado)
                                            VALUES (?,?,?,?,?,?,?,?)',
                                            [$IdEquipo,$AnoNovedad,$MesNovedad,$ValorMes,$Novedad,$creadoPor,$fechaCreacion,1]);
        return $CrearNovedadMobile;
    }

    public static function UpdateNovedadMobile($idNovedad,$YearNovedad,$MonthNovedad,$ValorNovedad,$NovedadMes,$creadoPor){
        date_default_timezone_set('America/Bogota');
        $fecha_sistema  = date('Y-m-d H:i');
        $fechaCreacion  = date('Y-m-d H:i', strtotime($fecha_sistema));
        $UpdateNovedadMobile = DB::Update("UPDATE novedad_mobile SET
                                            year = $YearNovedad,
                                            mes = $MonthNovedad,
                                            valor_mes = '$ValorNovedad',
                                            novedad_mes = '$NovedadMes',
                                            actualizado_por = $creadoPor,
                                            fecha_actualizacion = '$fechaCreacion'
                                            WHERE id_novedad = $idNovedad");
        return $UpdateNovedadMobile;
    }

    public static function ListarYear(){
        date_default_timezone_set('America/Bogota');
        $fecha_sistema  = date('Y-m-d H:i');
        $yearSystem  = date('Y', strtotime($fecha_sistema));

        $Year = DB::Select("SELECT max(year) as year FROM year");
        foreach($Year as $row){
            $ResultYear = $row->year;
        }
        while($ResultYear < $yearSystem){
            $ResultYear++;
            DB::Insert('INSERT INTO year(year) VALUE (?)',[$ResultYear]);
        }

        $SearchYear = DB::Select("SELECT * FROM year");
        return $SearchYear;

    }

    public static function ListarYearId($idYear){
        $SearchYear = DB::Select("SELECT * FROM year WHERE id = $idYear");
        return $SearchYear;
    }

    public static function ListarMonth(){
        $SearchMonth = DB::Select("SELECT * FROM month");
        return $SearchMonth;
    }

    public static function ListarMonthId($idMonth){
        $SearchMonth = DB::Select("SELECT * FROM month WHERE id = $idMonth");
        return $SearchMonth;
    }

    public static function ListarEstado(){
        $ListarEstado = DB::Select("SELECT * FROM activo");
        return $ListarEstado;
    }

    public static function ListarEquipoUsuarioC(){
        $ListarEquipo = DB::Select("SELECT * FROM tipo_equipo WHERE id IN (1,2)");
        return $ListarEquipo;
    }
}
