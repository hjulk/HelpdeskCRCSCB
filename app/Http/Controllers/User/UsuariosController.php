<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Models\User\Tickets;
use App\Models\Admin\Sedes;
use App\Models\Admin\Usuarios;
use App\Models\User\ControlCambios;
use App\Http\Requests\Validaciones;
use Validator;
use Monolog\Handler\ZendMonitorHandler;
use App\Http\Middleware\VerifyCsrfToken;
use App\Models\Admin\Activo;

class UsuariosController extends Controller
{

    public function inicio()
    {
        $creadoPor     = (int)Session::get('IdUsuario');
        setlocale(LC_ALL, 'es_CO');
        $EnDesarrollo   = Tickets::EnDesarrolloUsuario($creadoPor);
        foreach($EnDesarrollo as $valor){
            $desarrolloT = $valor->total;
        }
        $EnDesarrolloCC   = ControlCambios::EnDesarrolloUsuario($creadoPor);
        foreach($EnDesarrolloCC as $valor){
            $desarrolloC = $valor->total;
        }
        $Pendientes     = Tickets::PendientesUsuario($creadoPor);
        foreach($Pendientes as $valor){
            $pendientesT = $valor->total;
        }
        $PendientesCC     = ControlCambios::PendientesUsuario($creadoPor);
        foreach($PendientesCC as $valor){
            $pendientesC = $valor->total;
        }
        $Cancelados     = Tickets::CanceladosUsuario($creadoPor);
        foreach($Cancelados as $valor){
            $canceladosT = $valor->total;
        }
        $CanceladosCC     = ControlCambios::CanceladosUsuario($creadoPor);
        foreach($CanceladosCC as $valor){
            $canceladosC = $valor->total;
        }
        $Terminados     = Tickets::TerminadosUsuario($creadoPor);
        foreach($Terminados as $valor){
            $terminadosT = $valor->total;
        }
        $TerminadosCC     = ControlCambios::TerminadosUsuario($creadoPor);
        foreach($TerminadosCC as $valor){
            $terminadosC = $valor->total;
        }
        $Infraestructura     = Tickets::Infraestructura();
        foreach($Infraestructura as $valor){
            $InfraestructuraT = $valor->total;
        }
        $InfraestructuraCC     = ControlCambios::Infraestructura();
        foreach($InfraestructuraCC as $valor){
            $InfraestructuraC = $valor->total;
        }
        $Redes     = Tickets::Redes();
        foreach($Redes as $valor){
            $RedesT = $valor->total;
        }
        $RedesCC     = ControlCambios::Redes();
        foreach($RedesCC as $valor){
            $RedesC = $valor->total;
        }
        $Aplicaciones     = Tickets::Aplicaciones();
        foreach($Aplicaciones as $valor){
            $AplicacionesT = $valor->total;
        }
        $AplicacionesCC     = ControlCambios::Aplicaciones();
        foreach($AplicacionesCC as $valor){
            $AplicacionesC = $valor->total;
        }
        $Desarrollo     = Tickets::Desarrollo();
        foreach($Desarrollo as $valor){
            $DesarrolloT = $valor->total;
        }
        $DesarrolloCC     = ControlCambios::Desarrollo();
        foreach($DesarrolloCC as $valor){
            $DesarrolloC = $valor->total;
        }
        $Soporte     = Tickets::Soporte();
        foreach($Soporte as $valor){
            $SoporteT = $valor->total;
        }
        $SoporteCC     = ControlCambios::Soporte();
        foreach($SoporteCC as $valor){
            $SoporteC = $valor->total;
        }
        setlocale(LC_ALL, 'es_ES');
        $fechaActual = date('M - Y');
        // $mesActual  = date('M - y', strtotime($fechaActual));
        $mesCreacion = date('M', strtotime($fechaActual));
        $anio = date('y', strtotime($fechaActual));
        $meses_ES = array("Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic");
        $meses_EN = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
        $nombreMes = str_replace($meses_EN, $meses_ES, $mesCreacion);

        $mesActual = $nombreMes.' - '.$anio;
        $guardarMes = Tickets::GuardarMesUsuario($mesActual,$creadoPor);
        $buscarGestion  = Tickets::buscarGestion();
        $buscarGestionTotal  = Tickets::buscarGestionTotalUsuario($creadoPor);
        $buscarGestionCC        = ControlCambios::buscarGestion();
        $buscarGestionTotalCC   = ControlCambios::buscarGestionTotalUsuario($creadoPor);
        foreach($buscarGestionTotal as $row){
            $totalGestion = (int)$row->total;
        }
        foreach($buscarGestionTotalCC as $row){
            $totalGestionC = (int)$row->total;
        }
        $resultado_consulta = array();
        $cont = 0;
        if($totalGestion > 0){
            $resultado_gestion = array();
            $contadorGestion = count($buscarGestion);
            $contG = 0;
            foreach($buscarGestion as $consulta){
                    $resultado_gestion[$contG]['nombre']= $consulta->nombre_usuario;
                    $resultado_gestion[$contG]['desarrollo']= $consulta->desarrollo;
                    $resultado_gestion[$contG]['pendientes']= $consulta->pendientes;
                    $resultado_gestion[$contG]['terminados']= $consulta->terminados;
                    $resultado_gestion[$contG]['cancelados']= $consulta->cancelados;

                    if($cont >= ($contadorGestion-1)){
                        $resultado_gestion[$contG]['separador']= '';
                    }else{
                        $resultado_gestion[$contG]['separador']= ',';
                    }
                    $contG++;
            }
        }else{
            $resultado_gestion = null;
        }

        if($totalGestionC > 0){
            $resultado_gestionC = array();
            $contadorGestionC = count($buscarGestionCC);
            $contGC = 0;
            foreach($buscarGestionCC as $consulta){
                    $resultado_gestionC[$contGC]['nombre']= $consulta->nombre_usuario;
                    $resultado_gestionC[$contGC]['desarrollo']= $consulta->desarrollo;
                    $resultado_gestionC[$contGC]['pendientes']= $consulta->pendientes;
                    $resultado_gestionC[$contGC]['terminados']= $consulta->terminados;
                    $resultado_gestionC[$contGC]['cancelados']= $consulta->cancelados;

                    if($contGC >= ($contadorGestionC-1)){
                        $resultado_gestionC[$contGC]['separador']= '';
                    }else{
                        $resultado_gestionC[$contGC]['separador']= ',';
                    }
                    $contGC++;
            }
        }else{
            $resultado_gestionC = null;
        }

        if($guardarMes === false){
            $resultado_consulta = null;
        }else{
            $buscarMes = Tickets::BuscarMesUsuario($creadoPor);
            $contadorMes = count($buscarMes);

            foreach($buscarMes as $consulta){
                    $resultado_consulta[$cont]['nombre']= $consulta->nombre;
                    $resultado_consulta[$cont]['incidentes']= $consulta->incidentes;
                    $resultado_consulta[$cont]['requerimientos']= $consulta->requerimientos;

                    if($cont >= ($contadorMes-1)){
                        $resultado_consulta[$cont]['separador']= '';
                    }else{
                        $resultado_consulta[$cont]['separador']= ',';
                    }
                    $cont++;
            }

        }
        $resultado_consultaC = array();
        $contC = 0;
        $guardarMesCC           = ControlCambios::GuardarMesUsuario($mesActual,$creadoPor);

        if($guardarMesCC === false){
            $resultado_consultaC = null;
        }else{
            $buscarMesC = ControlCambios::BuscarMesUsuario($creadoPor);
            $contadorMesC = count($buscarMesC);

            foreach($buscarMesC as $consulta){
                    $resultado_consultaC[$contC]['nombre']= $consulta->nombre;
                    $resultado_consultaC[$contC]['alto']= $consulta->alto;
                    $resultado_consultaC[$contC]['medio']= $consulta->medio;
                    $resultado_consultaC[$contC]['bajo']= $consulta->bajo;

                    if($contC >= ($contadorMesC-1)){
                        $resultado_consultaC[$contC]['separador']= '';
                    }else{
                        $resultado_consultaC[$contC]['separador']= ',';
                    }
                    $contC++;
            }
            //  dd($resultado_consultaC);
        }

        return view('user.index',['EnDesarrollo' => $desarrolloT,'EnDesarrolloC' => $desarrolloC,'Pendientes' => $pendientesT,'PendientesC' => $pendientesC,
                                   'Terminados' => $terminadosT,'TerminadosC' => $terminadosC,'Cancelados' => $canceladosT,'CanceladosC' => $canceladosC,
                                   'MesGraficas' => $resultado_consulta,'MesGraficasC' => $resultado_consultaC,'Infraestructura' => $InfraestructuraT,
                                   'InfraestructuraC' => $InfraestructuraC,'Redes' => $RedesT,'RedesC' => $RedesC,'Aplicaciones' => $AplicacionesT,'AplicacionesC' => $AplicacionesC,
                                   'Desarrollo' => $DesarrolloT,'DesarrolloC' => $DesarrolloC,'Soporte' => $SoporteT,'SoporteC' => $SoporteC,
                                   'Gestion' => $resultado_gestion,'GestionC' => $resultado_gestionC]);
    }



    public function tickets()
    {
        $creadoPor     = (int)Session::get('IdUsuario');
        $IdRolUSer     = (int)Session::get('Rol');
        $buscarTickets = Tickets::TicketsUsuario($creadoPor,$IdRolUSer);
        $tickets = array();
        $cont = 0;
        date_default_timezone_set('America/Bogota');
        foreach($buscarTickets as $value){
            $id_ticket = $value->id;
            $tickets[$cont]['id'] = $value->id;
            $tickets[$cont]['id_tipo'] = $value->id_tipo;
            $tickets[$cont]['id_categoria'] = $value->id_categoria;
            $tickets[$cont]['id_zona'] = $value->id_zona;
            $tickets[$cont]['id_sede'] = $value->id_sede;
            $tickets[$cont]['id_area'] = $value->id_area;
            $tickets[$cont]['id_prioridad'] = $value->id_prioridad;
            $tickets[$cont]['id_estado'] = $value->id_estado;
            $tickets[$cont]['titulo'] = $value->titulo;
            $tickets[$cont]['descripcion'] = $value->descripcion;
            $tickets[$cont]['fecha_creacion'] = date('d/m/Y h:i A', strtotime($value->created_at));
            if($value->updated_at){
                $tickets[$cont]['fecha_actualizacion'] = date('d/m/Y h:i A', strtotime($value->updated_at));
            }else{
                $tickets[$cont]['fecha_actualizacion'] = 'SIN ACTUALIZACIÓN';
            }
            $id_tipo = $value->id_tipo;
            $nombreTipo = Tickets::Tipo($id_tipo);
            foreach($nombreTipo as $valor){
                $tickets[$cont]['tipo'] = $valor->nombre;
            }
            $tickets[$cont]['id_creador'] = $value->creado_por;
            $id_userc = $value->creado_por;
            $buscarUsuario = Usuarios::BuscarNombre($id_userc);
            foreach($buscarUsuario as $valor){
                $tickets[$cont]['creado_por'] = $valor->nombre;
            }
            $tickets[$cont]['id_usuario'] = $value->asignado_a;
            $id_usera = $value->asignado_a;
            $buscarUsuario = Usuarios::BuscarNombre($id_usera);
            foreach($buscarUsuario as $valor){
                $tickets[$cont]['asignado_a'] = $valor->nombre;
            }
            $id_categoria = $value->id_categoria;
            $nombreCategoria = Tickets::Categoria($id_categoria);
            foreach($nombreCategoria as $valor){
                $tickets[$cont]['categoria'] = $valor->nombre;
            }
            $idzona = $value->id_zona;
            $nombreZonaS = Sedes::BuscarZonaID($idzona);
            foreach($nombreZonaS as $valor){
                $tickets[$cont]['zona'] = $valor->nombre;
            }
            $idsede = $value->id_sede;
            $nombreSedeS = Sedes::BuscarSedeID($idsede);
            $contadorSede = count($nombreSedeS);
            if($contadorSede >0){
                foreach($nombreSedeS as $valor){
                    $tickets[$cont]['sede'] = $valor->nombre;
                }
            }else{
                $tickets[$cont]['sede'] = 'SIN SEDE';
            }

            $idarea = $value->id_area;
            $nombreAreaS = Sedes::BuscarAreaID($idarea);
            $contadorArea = count($nombreAreaS);
            if($contadorArea >0){
                foreach($nombreAreaS as $valor){
                    $tickets[$cont]['area'] = $valor->nombre;
                }
            }else{
                $tickets[$cont]['area'] = 'SIN AREA';
            }
            $tickets[$cont]['usuario'] = $value->nombre_usuario;
            $prioridad = (int)$value->id_prioridad;
            switch($prioridad){
                Case 1: $tickets[$cont]['label'] = 'label label-danger';
                        break;
                Case 2: $tickets[$cont]['label'] = 'label label-warning';
                        break;
                Case 3: $tickets[$cont]['label'] = 'label label-success';
                        break;
            }
            $idprioridad = $value->id_prioridad;
            $nombrePrioridad = Tickets::Prioridad($idprioridad);
            foreach($nombrePrioridad as $valor){
                $tickets[$cont]['prioridad'] = $valor->nombre;
            }
            $idestado = $value->id_estado;
            $nombreEstado = Tickets::Estado($idestado);
            foreach($nombreEstado as $valor){
                $tickets[$cont]['estado'] = $valor->name;
            }
            $tickets[$cont]['evidencias'] = null;
            $tickets[$cont]['historial'] = null;
            $evidenciaTicket = Tickets::EvidenciaTicket($id_ticket);
            $historialTicket = Tickets::HistorialTicket($id_ticket);
            $contadorHistorial = count($historialTicket);
            $contadorEvidencia = count($evidenciaTicket);
            if($contadorEvidencia > 0){
                $contE = 1;
                foreach($evidenciaTicket as $row){
                    $tickets[$cont]['evidencias'] .= "<a href='../aplicativo/evidencias/".$row->nombre_evidencia."' target='_blank'>Anexo Ticket  $id_ticket No.".$contE."</a><p>";
                    $contE++;
                }
            }else{
                $tickets[$cont]['evidencias'] = null;
            }
            if($contadorHistorial > 0){
                foreach($historialTicket as $row){
                    $tickets[$cont]['historial'] .= "- ".$row->observacion." (".$row->nombre_usuario." - ".date('d/m/Y h:i a', strtotime($row->creado)).")\n";
                }
            }else{
                $tickets[$cont]['historial'] = null;
            }

            $tickets[$cont]['nombre_usuario'] = $value->nombre_usuario;
            $tickets[$cont]['correo_usuario'] = $value->email_usuario;
            $tickets[$cont]['telefono_usuario'] = $value->telefono_usuario;
            $tickets[$cont]['cargo_usuario'] = $value->cargo_usuario;
            $tickets[$cont]['nombre_jefe'] = $value->nombre_jefe;
            $tickets[$cont]['telefono_jefe'] = $value->telefono_jefe;
            $cont++;
        }

        $Categoria  = Usuarios::Categoria();
        $NombreCategoria = array();
        $NombreCategoria[''] = 'Seleccione: ';
        foreach ($Categoria as $row){
            $NombreCategoria[$row->id] = $row->nombre;
        }
        $Tipo  = Tickets::ListarTipo();
        $NombreTipo = array();
        $NombreTipo[''] = 'Seleccione: ';
        foreach ($Tipo as $row){
            $NombreTipo[$row->id] = $row->nombre;
        }
        $Prioridad  = Tickets::ListarPrioridad();
        $NombrePrioridad = array();
        $NombrePrioridad[''] = 'Seleccione: ';
        foreach ($Prioridad as $row){
            $NombrePrioridad[$row->id] = $row->nombre;
        }
        $Zonas  = Sedes::Zonas();
        $NombreZona = array();
        $NombreZona[''] = 'Seleccione: ';
        foreach ($Zonas as $row){
            $NombreZona[$row->id] = $row->nombre;
        }


        $NombreUsuario = array();
        $NombreUsuario[''] = 'Seleccione: ';
        $NombreSede = array();
        $NombreSede[''] = 'Seleccione: ';
        $Sedes  = Sedes::Sedes();
        $NombreSedes = array();
        $NombreSedes[''] = 'Seleccione: ';
        foreach ($Sedes as $row){
            $NombreSedes[$row->id] = $row->nombre;
        }
        $NombreArea = array();
        $NombreArea[''] = 'Seleccione: ';
        $Areas  = Sedes::Areas();
        $NombreAreas = array();
        $NombreAreas[''] = 'Seleccione: ';
        foreach ($Areas as $row){
            $NombreAreas[$row->id] = $row->nombre;
        }

        $Estado  = Tickets::ListarEstado();
        $NombreEstado = array();
        $NombreEstado[0] = 'Seleccione: ';
        foreach ($Estado as $row){
            $NombreEstado[$row->id] = $row->name;
        }

        $EstadoUpd  = Tickets::ListarEstadoUpd();
        $NombreEstadoUpd = array();
        $NombreEstadoUpd[0] = 'Seleccione: ';
        foreach ($EstadoUpd as $row){
            $NombreEstadoUpd[$row->id] = $row->name;
        }
        $Zonas = Sedes::Zonas();
        $NombreZona = array();
        $NombreZona[''] = 'Seleccione: ';
        foreach ($Zonas as $row){
            $NombreZona[$row->id] = $row->nombre;
        }
        $Cargo  = Tickets::ListarCargo();
        $NombreCargo = array();
        $NombreCargo[0] = 'Seleccione: ';
        foreach ($Cargo as $row){
            $NombreCargo[$row->id] = $row->nombre;
        }

        Tickets::UpdateNotificacion($creadoPor);
        $valorCero = 0;
        $valorNull = null;
        Session::put('Notificaciones',$valorCero);
        Session::put('NOtificacion',$valorNull);
        return view('tickets.tickets',['Tickets' => $tickets,'NombreTipo' => $NombreTipo,'NombreCategoria' => $NombreCategoria,
                                    'NombreUsuario' => $NombreUsuario,'NombrePrioridad' => $NombrePrioridad,'NombreEstado' => $NombreEstado,'NombreEstadoUpd' => $NombreEstadoUpd,
                                    'NombreZona' => $NombreZona,'NombreSede' => $NombreSede,'NombreArea' => $NombreArea,'CorreoUsuario' => null,'NombreEstadoA' => $NombreEstadoUpd,
                                    'Usuario' => null,'Descripcion' => null,'TelefonoUsuario' => null,'Evidencia' => null,'Asunto' => null,'Comentario' => null,
                                    'NombreSedes' => $NombreSedes,'NombreAreas' => $NombreAreas,'NombreCargo' => null,'NombreJefe' => null,'TelefonoJefe' => null]);
    }

    public function profile(){
        return view('user.profile',['Contrasena' => null,'RContrasena' => null]);
    }

    public function actualizarUsuario(){
        $data       = Input::all();
        $Contrasena = Input::get('password');
        $RPassword  = Input::get('repeat_password');
        $idUsuario  = Session::get('IdUsuario');

        $infoUsario = Usuarios::BuscarNombre($idUsuario);
        foreach($infoUsario as $valor){
            $nombreUsuario = $valor->nombre;
            $nombrefoto    = $valor->profile_pic;
            $userName      = $valor->username;
        }

        if($Contrasena === $RPassword){
            $destinationPath = null;
            $filename        = null;
            if (Input::hasFile('profile_pic')) {
                $file            = Input::file('profile_pic');
                $destinationPath = public_path().'/aplicativo/profile_pics';
                $extension       = $file->getClientOriginalExtension();
                $nombrearchivo   = str_replace(".", "_", $userName);
                $filename        = $nombrearchivo.'.'.$extension;
                $uploadSuccess   = $file->move($destinationPath, $filename);
                $archivofoto    = file_get_contents($uploadSuccess);
            }else{
                $filename = $nombrefoto;
            }
            $NombreFoto     = $filename;
            $Password     = hash('sha512', $Contrasena);

            $updateProfile = Usuarios::ActualizarProfile($Password,$idUsuario,$NombreFoto);

            if($updateProfile){
                $verrors = 'Se actualizo con exito la contraseña';
                return redirect('user/profile')->with('mensaje', $verrors);
            }else{
                $verrors = array();
                array_push($verrors, 'Hubo un problema al actualizar la contraseña');
                return \Redirect::to('user/profile')->withErrors(['errors' => $verrors])->withInput();
            }

        }else{
            $verrors = array();
            array_push($verrors, 'Las contraseñas no coinciden');
            return \Redirect::to('user/profile')->withErrors(['errors' => $verrors])->withInput();
        }


    }

    public function controlCambios()
    {
        $id_user  = Session::get('IdUsuario');
        $Impacto = ControlCambios::ListarImpacto();
        $NombreImpacto = array();
        $NombreImpacto[''] = 'Seleccione: ';
        foreach ($Impacto as $row){
            $NombreImpacto[$row->id] = $row->nombre;
        }

        $Ambiente = ControlCambios::ListarAmbiente();
        $NombreAmbiente = array();
        $NombreAmbiente[''] = 'Seleccione: ';
        foreach ($Ambiente as $row){
            $NombreAmbiente[$row->id] = $row->nombre;
        }

        $Plataforma = ControlCambios::ListarPlataforma();
        $NombrePlataforma = array();
        $NombrePlataforma[''] = 'Seleccione: ';
        foreach ($Plataforma as $row){
            $NombrePlataforma[$row->id] = $row->nombre;
        }

        $Estado  = Tickets::ListarEstado();
        $NombreEstado = array();
        $NombreEstado[0] = 'Seleccione: ';
        foreach ($Estado as $row){
            $NombreEstado[$row->id] = $row->name;
        }

        $EstadoUPD  = Tickets::ListarEstadoUpd();
        $NombreEstadoUpd = array();
        $NombreEstadoUpd[0] = 'Seleccione: ';
        foreach ($EstadoUPD as $row){
            $NombreEstadoUpd[$row->id] = $row->name;
        }
        $NombreEscalamiento = array();
        $NombreEscalamiento[0] = 'Seleccione: ';
        $NombreEscalamiento[1] = 'Sí';
        $NombreEscalamiento[2] = 'No';

        $Usuario = array();
        $Usuario[''] = 'Seleccione: ';

        $Categoria  = Usuarios::Categoria();
        $NombreCategoria = array();
        $NombreCategoria[''] = 'Seleccione: ';
        foreach ($Categoria as $row){
            $NombreCategoria[$row->id] = $row->nombre;
        }

        $buscarCambios = ControlCambios::ListarSolicitudesUser($id_user);
        $Solicitudes = array();
        $cont = 0;
        foreach($buscarCambios as $value){
            $id_solicitud = $value->id;
            $Solicitudes[$cont]['id'] = $value->id;
            $Solicitudes[$cont]['id_impacto'] = $value->id_impacto;
            $Solicitudes[$cont]['id_plataforma'] = $value->id_plataforma;
            $Solicitudes[$cont]['id_ambiente'] = $value->id_ambiente;
            $Solicitudes[$cont]['id_categoria'] = $value->id_categoria;
            $Solicitudes[$cont]['id_estado'] = $value->id_estado;
            $Solicitudes[$cont]['asignado_a'] = $value->asignado_a;
            $Solicitudes[$cont]['creado_por'] = $value->creado_por;
            $Solicitudes[$cont]['actualizado_por'] = $value->actualizado_por;
            $Solicitudes[$cont]['descripcion'] = $value->descripcion;
            $Solicitudes[$cont]['escalamiento'] = $value->escalamiento;
            $Solicitudes[$cont]['creado'] = date('d/m/Y h:i A', strtotime($value->creado));
            if($value->actualizado){
                $Solicitudes[$cont]['actualizado'] = date('d/m/Y h:i A', strtotime($value->actualizado));
            }else{
                $Solicitudes[$cont]['actualizado'] = 'SIN ACTUALIZACIÓN';
            }
            $Solicitudes[$cont]['nombre_solicitante'] = $value->nombre_solicitante;
            $Solicitudes[$cont]['correo_solicitante'] = $value->correo_solicitante;
            $Solicitudes[$cont]['telefono_solicitante'] = $value->telefono_solicitante;
            $id_impacto = (int)$value->id_impacto;
            $nombreImpacto = ControlCambios::IdImpacto($id_impacto);
            foreach($nombreImpacto as $valor){
                $Solicitudes[$cont]['impacto'] = $valor->nombre;
            }
            switch($id_impacto){
                Case 1: $Solicitudes[$cont]['label'] = 'label label-danger';
                        break;
                Case 2: $Solicitudes[$cont]['label'] = 'label label-warning';
                        break;
                Case 3: $Solicitudes[$cont]['label'] = 'label label-success';
                        break;
            }
            $id_plataforma = $value->id_plataforma;
            $nombrePlataforma = ControlCambios::IdPlataforma($id_plataforma);
            foreach($nombrePlataforma as $valor){
                $Solicitudes[$cont]['plataforma'] = $valor->nombre;
            }
            $id_ambiente = $value->id_ambiente;
            $nombreAmbiente = ControlCambios::IdAmbiente($id_ambiente);
            foreach($nombreAmbiente as $valor){
                $Solicitudes[$cont]['ambiente'] = $valor->nombre;
            }
            if($value->fecha_publicacion){
                $Solicitudes[$cont]['fecha_publicacion'] = date('Y-m-d H:i', strtotime($value->fecha_publicacion));
                $Solicitudes[$cont]['publicacion'] = date('d/m/Y h:i A', strtotime($value->fecha_publicacion));
            }else{
                $Solicitudes[$cont]['fecha_publicacion'] = '';
                $Solicitudes[$cont]['publicacion'] = 'SIN FECHA ESTIMADA';
            }
            $Solicitudes[$cont]['creado_por'] = $value->creado_por;
            $id_userc = $value->creado_por;
            $buscarUsuario = Usuarios::BuscarNombre($id_userc);
            foreach($buscarUsuario as $valor){
                $Solicitudes[$cont]['creado_por'] = $valor->nombre;
            }
            $Solicitudes[$cont]['asignado_a'] = $value->asignado_a;
            $id_usera = $value->asignado_a;
            $buscarUsuario = Usuarios::BuscarNombre($id_usera);
            foreach($buscarUsuario as $valor){
                $Solicitudes[$cont]['asignado_a'] = $valor->nombre;
            }
            $id_categoria = $value->id_categoria;
            $nombreCategoria = Tickets::Categoria($id_categoria);
            foreach($nombreCategoria as $valor){
                $Solicitudes[$cont]['categoria'] = $valor->nombre;
            }
            $idestado = $value->id_estado;
            $nombreEstado = Tickets::Estado($idestado);
            foreach($nombreEstado as $valor){
                $Solicitudes[$cont]['estado'] = $valor->name;
            }
            $Solicitudes[$cont]['evidencias_cambio'] = null;
            $Solicitudes[$cont]['historial'] = null;
            $evidenciaCambio = ControlCambios::EvidenciaCambio($id_solicitud);
            $historialCambio = ControlCambios::HistorialCambio($id_solicitud);
            $contadorHistorial = count($historialCambio);
            $contadorEvidencia = count($evidenciaCambio);
            if($contadorEvidencia > 0){
                $contE = 1;
                foreach($evidenciaCambio as $row){
                    $Solicitudes[$cont]['evidencias_cambio'] .= "<a href='../aplicativo/evidencias_ControlC/".$row->nombre_evidencia."' target='_blank'>Anexo Control de Cambios  $id_solicitud No.".$contE."</a><p>";
                    $contE++;
                }
            }else{
                $Solicitudes[$cont]['evidencias_cambio'] = null;
            }
            if($contadorHistorial > 0){
                foreach($historialCambio as $row){
                    $Solicitudes[$cont]['historial'] .= "- ".$row->observacion." (".$row->nombre_usuario." - ".date('d/m/Y h:i a', strtotime($row->creado)).")\n";
                }
            }else{
                $Solicitudes[$cont]['historial'] = null;
            }
            $Solicitudes[$cont]['escalamiento'] = $value->escalamiento;
            $Solicitudes[$cont]['cargo_solicitante'] = $value->cargo_solicitante;
            $Solicitudes[$cont]['nombre_jefe'] = $value->nombre_jefe;
            $Solicitudes[$cont]['telefono_jefe'] = $value->telefono_jefe;
            $cont++;
        }
        $Cargo  = Tickets::ListarCargo();
        $NombreCargo = array();
        $NombreCargo[0] = 'Seleccione: ';
        foreach ($Cargo as $row){
            $NombreCargo[$row->id] = $row->nombre;
        }
        $creadoPor = (int)Session::get('IdUsuario');
        Tickets::UpdateNotificacion($creadoPor);
        $valorCero = 0;
        $valorNull = null;
        Session::put('Cambios',$valorCero);
        Session::put('Cambio',$valorNull);

        return view('controlcambios.cambios',['NombreImpacto' => $NombreImpacto,'NombreAmbiente' => $NombreAmbiente,'NombrePlataforma' => $NombrePlataforma,
                                              'FechaPublicacion' => null,'Descripcion' => null,'NombreUsuario' => null,'TelefonoUsuario' => null,
                                              'CorreoUsuario' => null,'NombreCategoria' => $NombreCategoria,'Usuario' => $Usuario,'NombreEstado' => $NombreEstado,'NombreEstadoUpd' => $NombreEstadoUpd,
                                              'Solicitudes' => $Solicitudes,'Comentario' => null,'NombreEscalamiento'=>$NombreEscalamiento,'NombreCargo' => null,
                                              'NombreJefe' => null,'TelefonoJefe' => null]);
    }


}
