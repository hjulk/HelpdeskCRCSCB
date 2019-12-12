<?php

namespace App\Models\User;

use App\Models\Admin\Usuarios;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class ControlCambios extends Model
{
    protected $table = "control_cambios";
    public $timestamps = false;

    public static function ListarImpacto(){
        $impacto = DB::Select("select * from impacto");
        return $impacto;
    }
    public static function IdImpacto($id_impacto){
        $impacto = DB::Select("select * from impacto where id = $id_impacto");
        return $impacto;
    }

    public static function ListarAmbiente(){
        $ambiente = DB::Select("select * from ambiente");
        return $ambiente;
    }
    public static function IdAmbiente($id_ambiente){
        $ambiente = DB::Select("select * from ambiente where id = $id_ambiente");
        return $ambiente;
    }

    public static function ListarPlataforma(){
        $plataforma = DB::Select("select * from plataforma where activo = 1 order by 2");
        return $plataforma;
    }
    public static function IdPlataforma($id_plataforma){
        $plataforma = DB::Select("select * from plataforma where activo = 1 and id = $id_plataforma");
        return $plataforma;
    }

    public static function ListarSolicitudes(){
        $solicitudes = DB::Select("select * from control_cambios where id_estado in (1,2) and finalizado = 0");
        return $solicitudes;
    }

    public static function ListarSolicitudesUser($id_user){
        $solicitudes = DB::Select("select * from control_cambios where id_estado in (1,2) and finalizado = 0 and asignado_a = $id_user");
        return $solicitudes;
    }


    public static function EvidenciaCambio($id_solicitud){
        $evidencia = DB::Select("SELECT * FROM evidencia_cambios WHERE id_cambio = $id_solicitud");
        return $evidencia;
    }

    public static function HistorialCambio($id_solicitud){
        $historial = DB::Select("SELECT * FROM historial_cambios WHERE id_cambio = $id_solicitud");
        return $historial;
    }

    public static function BuscarSolicitud($idSolicitud){
        $solicitud = DB::Select("SELECT * FROM control_cambios WHERE id = $idSolicitud");
        return $solicitud;
    }

    public static function BuscarLastSolicitud($creadoPor){
        $buscarUltimo = DB::Select("SELECT max(id) as id FROM control_cambios WHERE creado_por = $creadoPor");
        return $buscarUltimo;
    }

    public static function EnDesarrollo(){
        $desarrollo = DB::Select("SELECT count(*) as total FROM control_cambios WHERE id_estado = 2");
        return $desarrollo;
    }
    public static function EnDesarrolloUsuario($id_user){
        $desarrollo = DB::Select("SELECT count(*) as total FROM control_cambios WHERE id_estado = 2 AND asignado_a = $id_user");
        return $desarrollo;
    }

    public static function Pendientes(){
        $pendientes = DB::Select("SELECT count(*) as total FROM control_cambios WHERE id_estado = 1");
        return $pendientes;
    }
    public static function PendientesUsuario($id_user){
        $pendientes = DB::Select("SELECT count(*) as total FROM control_cambios WHERE id_estado = 1 AND asignado_a = $id_user");
        return $pendientes;
    }

    public static function Terminados(){
        $terminados = DB::Select("SELECT count(*) as total FROM control_cambios WHERE id_estado = 3 AND finalizado = 1");
        return $terminados;
    }
    public static function TerminadosUsuario($id_user){
        $terminados = DB::Select("SELECT count(*) as total FROM control_cambios WHERE id_estado = 3 AND finalizado = 1 AND actualizado_por = $id_user");
        return $terminados;
    }

    public static function Cancelados(){
        $cancelados = DB::Select("SELECT count(*) as total FROM control_cambios WHERE id_estado = 4 AND finalizado = 1");
        return $cancelados;
    }
    public static function CanceladosUsuario($id_user){
        $cancelados = DB::Select("SELECT count(*) as total FROM control_cambios WHERE id_estado = 4 AND finalizado = 1 AND actualizado_por = $id_user");
        return $cancelados;
    }
    public static function Infraestructura(){
        $infraestructura = DB::Select("SELECT count(*) as total FROM control_cambios WHERE id_categoria = 1 AND id_estado = 3");
        return $infraestructura;
    }

    public static function Redes(){
        $redes = DB::Select("SELECT count(*) as total FROM control_cambios WHERE id_categoria = 2 AND id_estado = 3");
        return $redes;
    }

    public static function Aplicaciones(){
        $aplicaciones = DB::Select("SELECT count(*) as total FROM control_cambios WHERE id_categoria = 3 AND id_estado = 3");
        return $aplicaciones;
    }

    public static function Desarrollo(){
        $desarrollo = DB::Select("SELECT count(*) as total FROM control_cambios WHERE id_categoria = 4 AND id_estado = 3");
        return $desarrollo;
    }

    public static function Soporte(){
        $soporte = DB::Select("SELECT count(*) as total FROM control_cambios WHERE id_categoria = 5 AND id_estado = 3");
        return $soporte;
    }

    public static function SolicitudesXMes(){
        $control_cambiossMes = DB::Select("SELECT count(*) as total FROM control_cambios WHERE MONTH(creado) = MONTH(CURDATE())");
        return $control_cambiossMes;
    }

    public static function GuardarMes($mesActual){
        $control_cambiossMes     = DB::Select("SELECT count(*) as total FROM mes_graficas_cambios WHERE nombre like '%$mesActual%'");
        $control_cambioss        = DB::Select("SELECT count(*) as total FROM control_cambios WHERE MONTH(creado)=MONTH(CURDATE())");
        $Alto           = DB::Select("SELECT count(*) as total FROM control_cambios WHERE MONTH(creado)=MONTH(CURDATE()) AND id_impacto = 1");
        $Medio          = DB::Select("SELECT count(*) as total FROM control_cambios WHERE MONTH(creado)=MONTH(CURDATE()) AND id_impacto = 2");
        $Bajo           = DB::Select("SELECT count(*) as total FROM control_cambios WHERE MONTH(creado)=MONTH(CURDATE()) AND id_impacto = 3");
        $validacion = true;
        foreach($control_cambiossMes as $value){
            $total = $value->total;
        }
        foreach($Alto as $value){
            $totalAlto = $value->total;
        }
        foreach($Bajo as $value){
            $totalBajo = $value->total;
        }
        foreach($Medio as $value){
            $totalMedio = $value->total;
        }
        foreach($control_cambioss as $value){
            $totalcontrol_cambios = $value->total;
        }

        if($total === 0){

            if($totalcontrol_cambios > 0){
                $guardarMes = DB::insert('INSERT INTO mes_graficas_cambios (nombre,alto,medio,bajo) VALUES (?,?,?,?)', [$mesActual,$totalAlto,$totalMedio,$totalBajo]);

                if($guardarMes){
                    $validacion = true;
                }
            }else{
                $validacion = false;
            }

        }else{
            $guardarMes = DB::Update("UPDATE mes_graficas_cambios SET alto = $totalAlto,medio = $totalMedio,bajo = $totalBajo where NOMBRE like '%$mesActual%'");
            if($guardarMes){
                $validacion = true;
            }
        }
        // dd($validacion);
        return $validacion;

    }

    public static function GuardarMesUsuario($mesActual,$id_user){
        $control_cambiossMes     = DB::Select("SELECT count(*) as total FROM mes_graficas_user_cambios WHERE nombre like '%$mesActual%' AND id_user = $id_user");
        $control_cambioss        = DB::Select("SELECT count(*) as total FROM control_cambios WHERE MONTH(creado)=MONTH(CURDATE()) AND asignado_a = $id_user");
        $Alto           = DB::Select("SELECT count(*) as total FROM control_cambios WHERE MONTH(creado)=MONTH(CURDATE()) AND id_impacto = 1 AND asignado_a = $id_user AND id_estado = 3");
        $Medio          = DB::Select("SELECT count(*) as total FROM control_cambios WHERE MONTH(creado)=MONTH(CURDATE()) AND id_impacto = 2 AND asignado_a = $id_user AND id_estado = 3");
        $Bajo           = DB::Select("SELECT count(*) as total FROM control_cambios WHERE MONTH(creado)=MONTH(CURDATE()) AND id_impacto = 3 AND asignado_a = $id_user AND id_estado = 3");

        foreach($control_cambiossMes as $value){
            $total = $value->total;
        }
        foreach($Alto as $value){
            $totalAlto = $value->total;
        }
        foreach($Bajo as $value){
            $totalBajo = $value->total;
        }
        foreach($Medio as $value){
            $totalMedio = $value->total;
        }
        foreach($control_cambioss as $value){
            $totalcontrol_cambioss = $value->total;
        }
        $validacion = true;
        if($total === 0){
            if($totalcontrol_cambioss > 0){
                $guardarMes = DB::insert('INSERT INTO mes_graficas_user_cambios (nombre,alto,medio,bajo,id_user) VALUES (?,?,?,?,?)', [$mesActual,$totalAlto,$totalMedio,$totalBajo,$id_user]);
                if($guardarMes){
                    $validacion = true;
                }
            }else{
                $validacion = false;
            }

        }else{
            $guardarMes = DB::Update("UPDATE mes_graficas_user_cambios SET alto = $totalAlto,medio = $totalMedio, bajo = $totalBajo where NOMBRE like '%$mesActual%' AND id_user = $id_user");
            if($guardarMes){
                $validacion = true;
            }
        }
        return $validacion;
    }

    public static function BuscarMes(){
        $control_cambiossMes = DB::Select("SELECT * FROM mes_graficas_cambios");
        return $control_cambiossMes;
    }
    public static function BuscarMesUsuario($id_user){
        $control_cambiossMes = DB::Select("SELECT * FROM mes_graficas_user_cambios WHERE id_user = $id_user");
        return $control_cambiossMes;
    }
    public static function buscarGestion(){
        $usuarios = DB::Select("SELECT * FROM user WHERE activo = 1 AND id_categoria NOT IN (7)");
        foreach($usuarios as $row){
            $id_user = $row->id;
            $nombre_user = $row->nombre;
            $control_cambiossDesarrollo  = DB::Select("SELECT * FROM control_cambios WHERE asignado_a = $id_user AND id_estado = 2 AND finalizado = 0;");
            $tDesarrollo        = count($control_cambiossDesarrollo);
            $control_cambiossPendientes  = DB::Select("SELECT * FROM control_cambios WHERE asignado_a = $id_user AND id_estado = 1 AND finalizado = 0;");
            $tPendientes        = count($control_cambiossPendientes);
            $control_cambiossTerminados  = DB::Select("SELECT * FROM control_cambios WHERE asignado_a = $id_user AND id_estado = 3 AND finalizado = 1;");
            $tTerminados        = count($control_cambiossTerminados);
            $control_cambiossCancelados  = DB::Select("SELECT * FROM control_cambios WHERE asignado_a = $id_user AND id_estado = 4 AND finalizado = 1;");
            $tCancelados        = count($control_cambiossCancelados);
            $buscarUsuario      = DB::Select("SELECT * FROM gestion_cambios WHERE id_user = $id_user");
            if($buscarUsuario){
                $actualizarGestion = DB::Update("UPDATE gestion_cambios SET desarrollo = $tDesarrollo,pendientes = $tPendientes,terminados = $tTerminados,cancelados = $tCancelados WHERE id_user = $id_user");
            }else{
                $ingresarGestion = DB::insert('INSERT INTO gestion_cambios (nombre_usuario,desarrollo,pendientes,terminados,cancelados,id_user)
                                                VALUES (?,?,?,?,?,?)', [$nombre_user,$tDesarrollo,$tPendientes,$tTerminados,$tCancelados,$id_user]);
            }

        }
        $gestion = DB::Select("SELECT * FROM gestion_cambios ORDER BY 2");
        return $gestion;
    }

    public static function buscarGestionTotal(){
        $gestion = DB::Select("SELECT count(*) as total FROM gestion_cambios");
        return $gestion;
    }
    public static function buscarGestionTotalUsuario($id_user){
        $gestion = DB::Select("SELECT count(*) as total FROM gestion_cambios WHERE id_user = $id_user");
        return $gestion;
    }

    public static function CrearSolicitud($idImpacto,$idPlataforma,$idAmbiente,$fPublicacion,$descripcion,
                                          $nombreSolicitante,$correoSolicitante,$telefonoSolicitante,$cargoSolicitante,$idCategoria,
                                          $idAsignado,$idEstado,$escalamiento,$creadoPor,$NombreJefe,$TelefonoJefe){

        date_default_timezone_set('America/Bogota');
        $fecha_sistema      = date('Y-m-d H:i');
        $fechaCreacion      = date('Y-m-d H:i', strtotime($fecha_sistema));
        if($fPublicacion){
            $fechaPublicacion   = date('Y-m-d H:i:s', strtotime($fPublicacion));
        }else{
            $fechaPublicacion   = '';
        }
        if(($idEstado === 3) || ($idEstado === 4) ){
            $finalizado = 1;
        }else{
            $finalizado = 0;
        }
        $crearSolicitud = DB::insert('INSERT INTO control_cambios (descripcion,creado,id_impacto,id_plataforma,id_ambiente,
                                        fecha_publicacion,nombre_solicitante,correo_solicitante,telefono_solicitante,cargo_solicitante,
                                        nombre_jefe,telefono_jefe,id_categoria,asignado_a,id_estado,escalamiento,creado_por,actualizado_por,finalizado,session_id)
                                      VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
                                      [$descripcion,$fechaCreacion,$idImpacto,$idPlataforma,$idAmbiente,$fechaPublicacion,
                                      $nombreSolicitante,$correoSolicitante,$telefonoSolicitante,$cargoSolicitante,$NombreJefe,$TelefonoJefe,$idCategoria,$idAsignado,
                                      $idEstado,$escalamiento,$creadoPor,$creadoPor,$finalizado,$creadoPor]);

        DB::Insert('INSERT INTO notificacion_cambio (creado_por, asignado_a,leido,fecha_notificacion)
                    VALUES (?,?,?,?)',
                    [$creadoPor,$idAsignado,0,$fechaCreacion]);

        return $crearSolicitud;

    }

    public static function ActualizarSolicitud($idImpacto,$idPlataforma,$idAmbiente,$fPublicacion,$descripcion,
                                          $nombreSolicitante,$correoSolicitante,$telefonoSolicitante,$cargoSolicitante,$idCategoria,
                                          $idAsignado,$idEstado,$escalamiento,$creadoPor,$comentario,$solicitud,$NombreJefe,$TelefonoJefe){

        date_default_timezone_set('America/Bogota');
        $fecha_sistema      = date('Y-m-d H:i');
        $fechaActualizacion = date('Y-m-d H:i', strtotime($fecha_sistema));
        if($fPublicacion){
            $fechaPublicacion   = date('Y-m-d H:i:s', strtotime($fPublicacion));
        }else{
            $fechaPublicacion   = '';
        }

        $actualizarSolicitud = DB::Update("UPDATE control_cambios set
                                        id_impacto = $idImpacto,
                                        descripcion = '$descripcion',
                                        actualizado = '$fechaActualizacion',
                                        id_plataforma = $idPlataforma,
                                        id_ambiente = $idAmbiente,
                                        fecha_publicacion = '$fechaPublicacion',
                                        nombre_solicitante = '$nombreSolicitante',
                                        telefono_solicitante = '$telefonoSolicitante',
                                        correo_solicitante = '$correoSolicitante',
                                        cargo_solicitante = '$cargoSolicitante',
                                        nombre_jefe = '$NombreJefe',
                                        telefono_jefe = '$TelefonoJefe',
                                        id_categoria = $idCategoria,
                                        asignado_a = $idAsignado,
                                        id_estado = $idEstado,
                                        escalamiento = '$escalamiento',
                                        actualizado_por = $creadoPor,
                                        session_id = $creadoPor
                                        where id = $solicitud");

        if($actualizarSolicitud){
            if(($idEstado === 3) || ($idEstado === 4)){
                $actualizarEstado = DB::Update("UPDATE control_cambios SET finalizado = 1 WHERE id = $solicitud");
            }
            $buscarUsuario = Usuarios::BuscarNombre($creadoPor);
            foreach($buscarUsuario as $row){
                $nombre_usuario = $row->nombre;
            }
            DB::insert('INSERT INTO historial_cambios (id_cambio,observacion,id_estado,id_user,nombre_usuario,creado)
                        VALUES (?,?,?,?,?,?)', [$solicitud,$comentario,$idEstado,$creadoPor,$nombre_usuario,$fechaActualizacion]);
        }

        return $actualizarSolicitud;

    }

    public static function Reporte($idImpacto,$idPlataforma,$idAmbiente,$idCategoria,$idUsuarioC,$idUsuarioA,$idEstado,$finicio,$ffin){
        $fechaInicio    = date('Y-m-d H:i', strtotime($finicio));
        $fechaFin       = date('Y-m-d H:i', strtotime($ffin));

        if (!empty($idImpacto)) {
            $impacto   = 'id_impacto';
            $vimpacto  = $idImpacto;
        }
        else{
            $impacto   = '1';
            $vimpacto  = '1';
        }
        if (!empty($idPlataforma)) {
            $plataforma   = 'id_plataforma';
            $vplataforma  = $idPlataforma;
        }
        else{
            $plataforma   = '1';
            $vplataforma  = '1';
        }
        if (!empty($idAmbiente)) {
            $ambiente   = 'id_ambiente';
            $vambiente  = $idAmbiente;
        }
        else{
            $ambiente   = '1';
            $vambiente  = '1';
        }
        if (!empty($idCategoria)) {
            $categoria   = 'id_categoria';
            $vcategoria  = $idCategoria;
        }
        else{
            $categoria   = '1';
            $vcategoria  = '1';
        }
        if (!empty($idUsuarioC)) {
            $usuarioC   = 'creado_por';
            $vusuarioC  = $idUsuarioC;
        }
        else{
            $usuarioC   = '1';
            $vusuarioC  = '1';
        }
        if (!empty($idUsuarioA)) {
            $usuarioA   = 'asignado_a';
            $vusuarioA  = $idUsuarioA;
        }
        else{
            $usuarioA   = '1';
            $vusuarioA  = '1';
        }

        if (!empty($idEstado)) {
            $estado   = 'id_estado';
            $vestado  = $idEstado;
        }
        else{
            $estado   = '1';
            $vestado  = '1';
        }

        $reporteTicket = DB::Select("SELECT * FROM control_cambios
                                WHERE creado BETWEEN '$fechaInicio' AND '$fechaFin'
                                AND $impacto = $vimpacto
                                AND $categoria = $vcategoria
                                AND $usuarioC = $vusuarioC
                                AND $usuarioA = $vusuarioA
                                AND $estado = $vestado
                                AND $plataforma = $vplataforma
                                AND $ambiente = $vambiente");

        return $reporteTicket;
    }

    public static function UpdateNotificacion($asignado_a){
        date_default_timezone_set('America/Bogota');
        $fecha_sistema  = date('Y-m-d H:i');
        $fechaActualizacion  = date('Y-m-d H:i', strtotime($fecha_sistema));
        DB::Update("UPDATE notificacion_cambio SET leido = 1, fecha_lectura = '$fechaActualizacion' WHERE asignado_a = $asignado_a");
    }

    public static function Notificaciones($asignado_a){
        $notificaciones = DB::Select("SELECT * FROM notificacion_cambio WHERE asignado_a = $asignado_a AND leido = 0");
        return $notificaciones;
    }

    public static function BuscarCalificacion($idTicket,$ip){
        $buscarCalificacion = DB::Select("SELECT * FROM calificacion_control WHERE id_control = $idTicket AND ip_cliente = '$ip'");
        return $buscarCalificacion;
    }

    public static function Calificar($idTicket,$ip,$UserName,$puntuacion){
        date_default_timezone_set('America/Bogota');
        $fecha_sistema  = date('Y-m-d H:i');
        $fechaCalificacion  = date('Y-m-d H:i', strtotime($fecha_sistema));
        $Calificar = DB::insert('INSERT INTO calificacion_control (id_control,puntuacion,ip_cliente,nombre_maquina,fecha_calificacion)
                                 VALUES (?,?,?,?,?)',
                                 [$idTicket,$puntuacion,$ip,$UserName,$fechaCalificacion]);
        return $Calificar;
    }

    public static function Evidencia($solicitud,$nombrearchivo){
        $Evidencia = DB::insert('INSERT INTO evidencia_cambios (nombre_evidencia,id_cambio) VALUES (?, ?)', [$nombrearchivo,$solicitud]);
        return $Evidencia;

    }

    public static function Apertura($idSolicitud,$idCategoria,$idUsuario,$idImpacto,$idEstado,$User,$desrcipcion){

        date_default_timezone_set('America/Bogota');
        $fecha_sistema  = date('Y-m-d H:i');
        $fechaActualizacion  = date('Y-m-d H:i', strtotime($fecha_sistema));
        $aperturaTicket = DB::Update("UPDATE control_cambios SET id_categoria = $idCategoria,
                                                                asignado_a = $idUsuario,
                                                                id_impacto = $idImpacto,
                                                                id_estado = $idEstado,
                                                                actualizado_por = $User,
                                                                actualizado = '$fechaActualizacion',
                                                                finalizado = 0
                                                            WHERE id = $idSolicitud");

        $buscarUsuario = Usuarios::BuscarNombre($User);
        foreach($buscarUsuario as $row){
            $nombre_usuario = $row->nombre;
        }

        if($aperturaTicket){
            DB::insert('INSERT INTO historial_cambios (id_cambio,observacion,id_estado,id_user,nombre_usuario,creado)
                    VALUES (?,?,?,?,?,?)', [$idSolicitud,$desrcipcion,$idEstado,$User,$nombre_usuario,$fechaActualizacion]);
        }

        return $aperturaTicket;
    }

}
