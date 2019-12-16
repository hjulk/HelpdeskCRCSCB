<?php

namespace App\Models\HelpDesk;

use App\Models\Admin\Usuarios;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    protected $table = "ticket";
    public $timestamps = false;

    public static function Tickets(){
        $tickets = DB::Select("SELECT * FROM ticket WHERE status_id IN (1,2)");
        return $tickets;
    }

    public static function TicketsUsuario($id_user,$IdRolUSer){
        $categoria = DB::SELECT("SELECT * FROM USER WHERE ID = $id_user");
        foreach($categoria as $valor){
            $category_id = $valor->category_id;
        }
        if($IdRolUSer === 2){
            if(($category_id === 1) || ($category_id === 2)){
                $tickets = DB::Select("SELECT * FROM ticket WHERE status_id IN (1,2) AND finalizado = 0 AND category_id IN (1,2,5)");
            }else{
                $tickets = DB::Select("SELECT * FROM ticket WHERE status_id IN (1,2) AND finalizado = 0 AND asigned_id = $id_user");
            }
        }else{
            $tickets = DB::Select("SELECT * FROM ticket WHERE status_id IN (1,2) AND finalizado = 0 AND asigned_id = $id_user");
        }


        return $tickets;
    }

    public static function Tipo($id_tipo){
        $tickets = DB::Select("SELECT name FROM kind where id = $id_tipo");
        return $tickets;
    }

    public static function ListarTipo(){
        $tickets = DB::Select("SELECT * FROM kind");
        return $tickets;
    }

    public static function BuscarPrioridadID($IdPrioridad){
        $tickets = DB::Select("SELECT * FROM priority WHERE id = $IdPrioridad");
        return $tickets;
    }

    public static function ListarPrioridad(){
        $tickets = DB::Select("SELECT * FROM priority");
        return $tickets;
    }

    public static function Estado($status_id){
        $tickets = DB::Select("SELECT * FROM status where id = $status_id");
        return $tickets;
    }

    public static function ListarEstado(){
        $tickets = DB::Select("SELECT * FROM status");
        return $tickets;
    }

    public static function ListarCargo(){
        $tickets = DB::Select("SELECT * FROM cargo_usuario WHERE activo = 1");
        return $tickets;
    }

    public static function ListarEstadoA(){
        $tickets = DB::Select("SELECT * FROM status WHERE id not in (3,4)");
        return $tickets;
    }

    public static function ListarEstadoUpd(){
        $tickets = DB::Select("SELECT * FROM status");
        return $tickets;
    }

    public static function EnDesarrollo(){
        $desarrollo = DB::Select("SELECT count(*) as total FROM ticket WHERE status_id = 2");
        return $desarrollo;
    }
    public static function EnDesarrolloUsuario($id_user){
        $desarrollo = DB::Select("SELECT count(*) as total FROM ticket WHERE status_id = 2 AND asignado_id = $id_user");
        return $desarrollo;
    }

    public static function Pendientes(){
        $pendientes = DB::Select("SELECT count(*) as total FROM ticket WHERE status_id = 1");
        return $pendientes;
    }
    public static function PendientesUsuario($id_user){
        $pendientes = DB::Select("SELECT count(*) as total FROM ticket WHERE status_id = 1 AND asignado_id = $id_user");
        return $pendientes;
    }

    public static function Terminados(){
        $terminados = DB::Select("SELECT count(*) as total FROM ticket WHERE status_id = 3");
        return $terminados;
    }
    public static function TerminadosUsuario($id_user){
        $terminados = DB::Select("SELECT count(*) as total FROM ticket WHERE status_id = 3 AND asignado_id = $id_user");
        return $terminados;
    }

    public static function Cancelados(){
        $cancelados = DB::Select("SELECT count(*) as total FROM ticket WHERE status_id = 4");
        return $cancelados;
    }
    public static function CanceladosUsuario($id_user){
        $cancelados = DB::Select("SELECT count(*) as total FROM ticket WHERE status_id = 4 AND asignado_id = $id_user");
        return $cancelados;
    }

    public static function TicketsXMes(){
        $ticketsMes = DB::Select("SELECT count(*) as total FROM ticket WHERE MONTH(created_at) = MONTH(CURDATE())");
        return $ticketsMes;
    }

    public static function GuardarMes($mesActual,$ActualYear){
        // $ticketsMes     = DB::Select("SELECT count(*) as total FROM mes_graficas WHERE mes LIKE '%Nov' AND year = $ActualYear");
        // $Tickets        = DB::Select("SELECT count(*) as total FROM ticket WHERE MONTH(created_at)=MONTH('2019-11-01') AND YEAR(created_at)=YEAR(CURDATE())");
        // $Incidentes     = DB::Select("SELECT count(*) as total FROM ticket WHERE MONTH(created_at)=MONTH('2019-11-01') AND YEAR(created_at)=YEAR(CURDATE()) AND kind_id = 1");
        // $Requerimientos = DB::Select("SELECT count(*) as total FROM ticket WHERE MONTH(created_at)=MONTH('2019-11-01') AND YEAR(created_at)=YEAR(CURDATE()) AND kind_id = 2");
        $ticketsMes     = DB::Select("SELECT count(*) as total FROM mes_graficas WHERE mes LIKE '%$mesActual%' AND year = $ActualYear");
        $Tickets        = DB::Select("SELECT count(*) as total FROM ticket WHERE MONTH(created_at)=MONTH(CURDATE()) AND YEAR(created_at)=YEAR(CURDATE())");
        $Incidentes     = DB::Select("SELECT count(*) as total FROM ticket WHERE MONTH(created_at)=MONTH(CURDATE()) AND YEAR(created_at)=YEAR(CURDATE()) AND kind_id = 1");
        $Requerimientos = DB::Select("SELECT count(*) as total FROM ticket WHERE MONTH(created_at)=MONTH(CURDATE()) AND YEAR(created_at)=YEAR(CURDATE()) AND kind_id = 2");

        foreach($ticketsMes as $value){
            $total = $value->total;
        }
        foreach($Incidentes as $value){
            $totalIncidentes = $value->total;
        }
        foreach($Tickets as $value){
            $totalTickets = $value->total;
        }
        foreach($Requerimientos as $value){
            $totalRequerimientos = $value->total;
        }

        if($total === 0){
            if($totalTickets > 0){
                $guardarMes = DB::insert('INSERT INTO mes_graficas (mes,year,incidentes,requerimientos) VALUES (?,?,?,?)', [$mesActual,$ActualYear,$totalIncidentes,$totalRequerimientos]);
                if($guardarMes){
                    return true;
                }
            }else{
                return false;
            }

        }else{
            $guardarMes = DB::Update("UPDATE mes_graficas SET incidentes = $totalIncidentes,requerimientos = $totalRequerimientos WHERE mes LIKE '%$mesActual%' AND year = $ActualYear");
            if($guardarMes){
                return true;
            }
        }

    }

    public static function GuardarMesUsuario($mesActual,$id_user){
        $ticketsMes     = DB::Select("SELECT count(*) as total FROM mes_graficas_user WHERE nombre like '%$mesActual%' AND id_user = $id_user");
        $Tickets        = DB::Select("SELECT count(*) as total FROM ticket WHERE MONTH(created_at)=MONTH(CURDATE()) AND asigned_id = $id_user");
        $Incidentes     = DB::Select("SELECT count(*) as total FROM ticket WHERE MONTH(created_at)=MONTH(CURDATE()) AND kind_id = 1 AND asigned_id = $id_user AND status_id = 3");
        $Requerimientos = DB::Select("SELECT count(*) as total FROM ticket WHERE MONTH(created_at)=MONTH(CURDATE()) AND kind_id = 2 AND asigned_id = $id_user AND status_id = 3");

        foreach($ticketsMes as $value){
            $total = $value->total;
        }
        foreach($Incidentes as $value){
            $totalIncidentes = $value->total;
        }
        foreach($Tickets as $value){
            $totalTickets = $value->total;
        }
        foreach($Requerimientos as $value){
            $totalRequerimientos = $value->total;
        }

        if($total === 0){
            if($totalTickets > 0){
                $guardarMes = DB::insert('INSERT INTO mes_graficas_user (nombre,incidentes,requerimientos,id_user) VALUES (?,?,?,?)', [$mesActual,$totalIncidentes,$totalRequerimientos,$id_user]);
                if($guardarMes){
                    return true;
                }
            }else{
                return false;
            }

        }else{
            $guardarMes = DB::Update("UPDATE mes_graficas_user SET incidentes = $totalIncidentes,requerimientos = $totalRequerimientos where NOMBRE like '%$mesActual%' AND id_user = $id_user");
            if($guardarMes){
                return true;
            }
        }

    }

    public static function BuscarMes($ActualYear){
        $ticketsMes = DB::Select("SELECT * FROM mes_graficas WHERE year = $ActualYear");
        return $ticketsMes;
    }
    public static function BuscarMesUsuario($id_user){
        $ticketsMes = DB::Select("SELECT * FROM mes_graficas_user WHERE id_user = $id_user");
        return $ticketsMes;
    }

    public static function Infraestructura(){
        $infraestructura = DB::Select("SELECT count(*) as total FROM ticket WHERE category_id = 2 AND status_id = 3");
        return $infraestructura;
    }

    public static function Redes(){
        $redes = DB::Select("SELECT count(*) as total FROM ticket WHERE category_id = 3 AND status_id = 3");
        return $redes;
    }

    public static function Aplicaciones(){
        $aplicaciones = DB::Select("SELECT count(*) as total FROM ticket WHERE category_id = 1 AND status_id = 3");
        return $aplicaciones;
    }

    public static function Soporte(){
        $soporte = DB::Select("SELECT count(*) as total FROM ticket WHERE category_id = 4 AND status_id = 3");
        return $soporte;
    }

    public static function Servinte(){
        $soporte = DB::Select("SELECT count(*) as total FROM ticket WHERE category_id = 6 AND status_id = 3");
        return $soporte;
    }

    public static function CrearTicket($idTipo,$Asunto,$Descripcion,$NombreUsuario,$TelefonoUsuario,$CorreUsuario,
    $IdSede,$Area,$Prioridad,$Categoria,$AsignadoA,$Estado,$creadoPor){

        date_default_timezone_set('America/Bogota');
        $fecha_sistema  = date('Y-m-d H:i');
        $fechaCreacion  = date('Y-m-d H:i', strtotime($fecha_sistema));
        $crearTicket = DB::insert('INSERT INTO ticket (title,description,created_at,kind_id,user_id,asigned_id,project_id,dependencia,
                                                    category_id,priority_id,status_id,name_user,tel_user,user_email,session_id,tipo,h_asigned_id)
                                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
                                    [$Asunto,$Descripcion,$fechaCreacion,$idTipo,$creadoPor,$AsignadoA,$IdSede,$Area,$Categoria,$Prioridad,
                                    $Estado,$NombreUsuario,$TelefonoUsuario,$CorreUsuario,$creadoPor,0,$AsignadoA]);
        DB::Insert('INSERT INTO notificaciones (usuario1,usuario2,leido,fecha)
                    VALUES (?,?,?,?)',
                    [$creadoPor,$AsignadoA,0,$fechaCreacion]);
        return $crearTicket;
    }

    public static function ActualizarTicket($idTicket,$idTipo,$Asunto,$Descripcion,$NombreUsuario,$TelefonoUsuario,$CorreUsuario,$CargoUsuario,
                                            $IdZona,$IdSede,$IdArea,$Prioridad,$Categoria,$AsignadoA,$Estado,$creadoPor,$comentario,$NombreJefe,$TelefonoJefe){

        date_default_timezone_set('America/Bogota');
        $fecha_sistema  = date('Y-m-d H:i');
        $fechaActualizacion  = date('Y-m-d H:i', strtotime($fecha_sistema));

        $actualizarTicket = DB::Update("UPDATE ticket SET
                                        titulo = '$Asunto',
                                        descripcion = '$Descripcion',
                                        updated_at = '$fechaActualizacion',
                                        id_tipo = $idTipo,
                                        creado_por = $creadoPor,
                                        asigned_id = $AsignadoA,
                                        category_id = $Categoria,
                                        id_zona = $IdZona,
                                        id_sede = $IdSede,
                                        id_area = $IdArea,
                                        nombre_usuario = '$NombreUsuario',
                                        telefono_usuario = '$TelefonoUsuario',
                                        email_usuario = '$CorreUsuario',
                                        cargo_usuario = '$CargoUsuario',
                                        nombre_jefe = '$NombreJefe',
                                        telefono_jefe = '$TelefonoJefe',
                                        id_prioridad = $Prioridad,
                                        status_id = $Estado,
                                        session_id = $creadoPor,
                                        actualizado_por = $creadoPor
                                        WHERE id = $idTicket");

        if($actualizarTicket){
            // if(($Estado === 3) || ($Estado === 4)){
            //     $actualizarEstado = DB::Update("UPDATE ticket SET finalizado = 1 WHERE id = $idTicket");
            // }
            $buscarUsuario = Usuarios::BuscarNombre($creadoPor);
            foreach($buscarUsuario as $row){
                $nombre_usuario = $row->nombre;
            }
            DB::insert('INSERT INTO historial_ticket (id_ticket,observacion,status_id,id_user,nombre_usuario,creado)
                        VALUES (?,?,?,?,?,?)', [$idTicket,$comentario,$Estado,$creadoPor,$nombre_usuario,$fechaActualizacion]);
        }

        return $actualizarTicket;
    }

    public static function BuscarLastTicket($idUser){
        $buscarUltimo = DB::Select("SELECT max(id) as id FROM ticket WHERE user_id = $idUser");
        return $buscarUltimo;
    }

    public static function Evidencia($idticket,$nombrearchivo){
        $Evidencia = DB::insert('INSERT INTO evidencia_tickets (nombre_evidencia,id_ticket) VALUES (?, ?)', [$nombrearchivo,$idticket]);
        return $Evidencia;

    }

    public static function buscarGestion(){
        $usuarios = DB::Select("SELECT * FROM user WHERE is_active = 1 AND rol_id NOT IN (6) ORDER BY category_id");
        foreach($usuarios as $row){
            $id_user = $row->id;
            $nombre_user = $row->name;
            $ticketsDesarrollo  = DB::Select("SELECT * FROM ticket WHERE asigned_id = $id_user AND status_id = 2");
            $tDesarrollo        = count($ticketsDesarrollo);
            $ticketsPendientes  = DB::Select("SELECT * FROM ticket WHERE asigned_id = $id_user AND status_id = 1");
            $tPendientes        = count($ticketsPendientes);
            $ticketsTerminados  = DB::Select("SELECT * FROM ticket WHERE asigned_id = $id_user AND status_id = 3");
            $tTerminados        = count($ticketsTerminados);
            $ticketsCancelados  = DB::Select("SELECT * FROM ticket WHERE asigned_id = $id_user AND status_id = 4");
            $tCancelados        = count($ticketsCancelados);
            $buscarUsuario      = DB::Select("SELECT * FROM gestion WHERE id_user = $id_user");
            if($buscarUsuario){
                $actualizarGestion = DB::Update("UPDATE gestion SET desarrollo = $tDesarrollo,pendientes = $tPendientes,terminados = $tTerminados,cancelados = $tCancelados WHERE id_user = $id_user");
            }else{
                $ingresarGestion = DB::insert('INSERT INTO gestion (nombre_usuario,desarrollo,pendientes,terminados,cancelados,id_user)
                                                VALUES (?,?,?,?,?,?)', [$nombre_user,$tDesarrollo,$tPendientes,$tTerminados,$tCancelados,$id_user]);
            }

        }
        $gestion = DB::Select("SELECT * FROM gestion");
        return $gestion;
    }

    public static function buscarGestionSede(){
        $sedes = DB::Select("SELECT * FROM project");
        foreach($sedes as $row){
            $id_sede = $row->id;
            $nombre_user = $row->name;
            $ticketsIncidentes      = DB::Select("SELECT * FROM ticket WHERE project_id = $id_sede AND kind_id = 1");
            $tIncidentes            = count($ticketsIncidentes);
            $ticketsRequerimientos  = DB::Select("SELECT * FROM ticket WHERE project_id = $id_sede AND kind_id = 1");
            $tRequerimientos        = count($ticketsRequerimientos);

            $buscarUsuario      = DB::Select("SELECT * FROM gestionSede WHERE id_sede = $id_sede");
            if($buscarUsuario){
                $actualizarGestion = DB::Update("UPDATE gestionSede SET incidentes = $tIncidentes,requerimientos = $tRequerimientos WHERE id_sede = $id_sede");
            }else{
                $ingresarGestion = DB::insert('INSERT INTO gestionSede (nombre_sede,incidentes,requerimientos,id_sede)
                                                VALUES (?,?,?,?)', [$nombre_user,$tIncidentes,$tRequerimientos,$id_sede]);
            }

        }
        $gestion = DB::Select("SELECT * FROM gestionSede");
        return $gestion;
    }

    public static function buscarGestionCalificacion(){
        $calificacion           = DB::Select("SELECT * FROM tipo_calificacion");
        $totalCalificaciones    = DB::Select("SELECT * FROM calificacion");
        $tCalificaciones        = (int)count($totalCalificaciones);
        foreach($calificacion as $row){
            $id_calificacion = (int)$row->id;
            switch($id_calificacion){
                Case 1  :   $color = '#dd4b39';
                            break;
                Case 2  :   $color = '#ffbc75';
                            break;
                Case 3  :   $color = 'grey';
                            break;
                Case 4  :   $color = '#90ed7d';
                            break;
                Case 5  :   $color = 'green';
                            break;

            }
            $nombre_user = $row->name;
            $totalCalificacion  = DB::Select("SELECT * FROM calificacion WHERE puntuacion = $id_calificacion");
            $tCalificacion      = (int)count($totalCalificacion);
            $tPorcentaje        = round($tCalificacion/$tCalificaciones*100);
            $buscarUsuario      = DB::Select("SELECT * FROM gestioncalificacion WHERE id_calificacion = $id_calificacion");
            if($buscarUsuario){
                $actualizarGestion = DB::Update("UPDATE gestioncalificacion SET total = $tCalificacion,porcentaje = $tPorcentaje WHERE id_calificacion = $id_calificacion");
            }else{
                $ingresarGestion = DB::insert('INSERT INTO gestioncalificacion (nombre,total,porcentaje,id_calificacion,color)
                                                VALUES (?,?,?,?,?)', [$nombre_user,$tCalificacion,$tPorcentaje,$id_calificacion,$color]);
            }

        }
        $gestion = DB::Select("SELECT * FROM gestioncalificacion");
        return $gestion;
    }

    public static function buscarGestionTotal(){
        $gestion = DB::Select("SELECT count(*) as total FROM gestion");
        return $gestion;
    }
    public static function buscarGestionTotalSede(){
        $gestion = DB::Select("SELECT count(*) as total FROM gestionSede");
        return $gestion;
    }
    public static function buscarGestionTotalCalificacion(){
        $gestion = DB::Select("SELECT count(*) as total FROM gestioncalificacion");
        return $gestion;
    }
    public static function buscarGestionTotalUsuario($id_user){
        $gestion = DB::Select("SELECT count(*) as total FROM gestion WHERE id_user = $id_user");
        return $gestion;
    }

    public static function EvidenciaTicket($id_ticket){
        $evidencia = DB::Select("SELECT * FROM evidencia_tickets WHERE id_ticket = $id_ticket");
        return $evidencia;
    }

    public static function HistorialTicket($id_ticket){
        $historial = DB::Select("SELECT * FROM historial WHERE id_ticket = $id_ticket");
        return $historial;
    }

    public static function Reporte($idTipo,$idCategoria,$idUsuarioC,$idUsuarioA,$idPrioridad,$idEstado,$idZona,$idSede,$idArea,$finicio,$ffin){
        $fechaInicio    = date('Y-m-d H:i', strtotime($finicio));
        $fechaFin       = date('Y-m-d H:i', strtotime($ffin));
        // dd($fechaInicio);
        if (!empty($idTipo)) {
            $tipo   = 'id_tipo';
            $vtipo  = $idTipo;
        }
        else{
            $tipo   = '1';
            $vtipo  = '1';
        }
        if (!empty($idCategoria)) {
            $categoria   = 'category_id';
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
            $usuarioA   = 'asigned_id';
            $vusuarioA  = $idUsuarioA;
        }
        else{
            $usuarioA   = '1';
            $vusuarioA  = '1';
        }
        if (!empty($idPrioridad)) {
            $prioridad   = 'id_prioridad';
            $vprioridad  = $idPrioridad;
        }
        else{
            $prioridad   = '1';
            $vprioridad  = '1';
        }
        if (!empty($idEstado)) {
            $estado   = 'status_id';
            $vestado  = $idEstado;
        }
        else{
            $estado   = '1';
            $vestado  = '1';
        }
        if (!empty($idZona)) {
            $zona   = 'id_zona';
            $vzona  = $idZona;
        }
        else{
            $zona   = '1';
            $vzona  = '1';
        }
        if (!empty($idSede)) {
            $sede   = 'id_sede';
            $vsede  = $idSede;
        }
        else{
            $sede   = '1';
            $vsede  = '1';
        }
        if (!empty($idArea)) {
            $area   = 'id_area';
            $varea  = $idArea;
        }
        else{
            $area   = '1';
            $varea  = '1';
        }
        $reporteTicket = DB::Select("SELECT * FROM ticket
                                WHERE created_at BETWEEN '$fechaInicio' AND '$fechaFin'
                                AND $tipo = $vtipo
                                AND $categoria = $vcategoria
                                AND $usuarioC = $vusuarioC
                                AND $usuarioA = $vusuarioA
                                AND $prioridad = $vprioridad
                                AND $estado = $vestado
                                AND $zona = $vzona
                                AND $sede = $vsede
                                AND $area = $varea");

        return $reporteTicket;
    }

    public static function Apertura($idTicket,$idCategoria,$idUsuario,$idPrioridad,$idEstado,$User,$desrcipcion){

        date_default_timezone_set('America/Bogota');
        $fecha_sistema  = date('Y-m-d H:i');
        $fechaActualizacion  = date('Y-m-d H:i', strtotime($fecha_sistema));
        $aperturaTicket = DB::Update("UPDATE ticket SET category_id = $idCategoria,
                                                        asigned_id = $idUsuario,
                                                        id_prioridad = $idPrioridad,
                                                        status_id = $idEstado,
                                                        actualizado_por = $User,
                                                        updated_at = '$fechaActualizacion',
                                                        finalizado = 0
                                                    WHERE id = $idTicket");

        $buscarUsuario = Usuarios::BuscarNombre($User);
        foreach($buscarUsuario as $row){
            $nombre_usuario = $row->nombre;
        }

        if($aperturaTicket){
            DB::insert('INSERT INTO historial_ticket (id_ticket,observacion,status_id,id_user,nombre_usuario,creado)
                    VALUES (?,?,?,?,?,?)', [$idTicket,$desrcipcion,$idEstado,$User,$nombre_usuario,$fechaActualizacion]);
        }

        return $aperturaTicket;
    }

    public static function BuscarTicket($idTicket){
        $busqueda = DB::Select("SELECT * FROM ticket WHERE id = $idTicket");
        return $busqueda;
    }

    public static function UpdateNotificacion($asigned_id){
        date_default_timezone_set('America/Bogota');
        $fecha_sistema  = date('Y-m-d H:i');
        $fechaActualizacion  = date('Y-m-d H:i', strtotime($fecha_sistema));
        DB::Update("UPDATE notificaciones SET leido = 1, fecha = '$fechaActualizacion' WHERE usuario2 = $asigned_id");
    }

    public static function Notificaciones($asigned_id){
        $notificaciones = DB::Select("SELECT * FROM notificaciones WHERE usuario2 = $asigned_id AND leido = 0");
        return $notificaciones;
    }

    public static function BuscarCalificacion($idTicket,$ip){
        $buscarCalificacion = DB::Select("SELECT * FROM calificacion_ticket WHERE id_ticket = $idTicket AND ip_cliente = '$ip'");
        return $buscarCalificacion;
    }

    public static function Calificar($idTicket,$ip,$UserName,$puntuacion){
        date_default_timezone_set('America/Bogota');
        $fecha_sistema  = date('Y-m-d H:i');
        $fechaCalificacion  = date('Y-m-d H:i', strtotime($fecha_sistema));
        $Calificar = DB::insert('INSERT INTO calificacion_ticket (id_ticket,puntuacion,ip_cliente,nombre_maquina,fecha_calificacion)
                                 VALUES (?,?,?,?,?)',
                                 [$idTicket,$puntuacion,$ip,$UserName,$fechaCalificacion]);
        return $Calificar;
    }

    public static function BuscarMInsatisfecho(){
        $BuscarMInsatisfecho = DB::Select("SELECT count(*) as total FROM calificacion WHERE puntuacion = 1");
        return $BuscarMInsatisfecho;
    }
    public static function BuscarInsatisfecho(){
        $BuscarInsatisfecho = DB::Select("SELECT count(*) as total FROM calificacion WHERE puntuacion = 2");
        return $BuscarInsatisfecho;
    }
    public static function BuscarNeutral(){
        $BuscarNeutral = DB::Select("SELECT count(*) as total FROM calificacion WHERE puntuacion = 3");
        return $BuscarNeutral;
    }
    public static function BuscarSatisfecho(){
        $BuscarSatisfecho = DB::Select("SELECT count(*) as total FROM calificacion WHERE puntuacion = 4");
        return $BuscarSatisfecho;
    }
    public static function BuscarMSatisfecho(){
        $BuscarMSatisfecho = DB::Select("SELECT count(*) as total FROM calificacion WHERE puntuacion = 5");
        return $BuscarMSatisfecho;
    }
    public static function PorcentajeMInsatisfecho(){
        $PorcentajeMInsatisfecho = DB::Select("SELECT porcentaje FROM gestioncalificacion WHERE id_calificacion = 1");
        return $PorcentajeMInsatisfecho;
    }
    public static function PorcentajeInsatisfecho(){
        $PorcentajeInsatisfecho = DB::Select("SELECT porcentaje FROM gestioncalificacion WHERE id_calificacion = 2");
        return $PorcentajeInsatisfecho;
    }
    public static function PorcentajeNeutral(){
        $PorcentajeNeutral = DB::Select("SELECT porcentaje FROM gestioncalificacion WHERE id_calificacion = 3");
        return $PorcentajeNeutral;
    }
    public static function PorcentajeSatisfecho(){
        $PorcentajeSatisfecho = DB::Select("SELECT porcentaje FROM gestioncalificacion WHERE id_calificacion = 4");
        return $PorcentajeSatisfecho;
    }
    public static function PorcentajeMSatisfecho(){
        $PorcentajeMSatisfecho = DB::Select("SELECT porcentaje FROM gestioncalificacion WHERE id_calificacion = 5");
        return $PorcentajeMSatisfecho;
    }

    public static function Categoria($Categoria){
        $BuscarCategoria = DB::Select("SELECT * FROM category WHERE id = $Categoria");
        return $BuscarCategoria;
    }

    public static function Prioridad($Prioridad){
        $BuscarPrioridad = DB::Select("SELECT * FROM priority WHERE id = $Prioridad");
        return $BuscarPrioridad;
    }
}
