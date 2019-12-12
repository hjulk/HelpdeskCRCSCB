<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HelpDesk\Tickets;
use App\Models\HelpDesk\ControlCambios;
use App\Models\Admin\Sedes;
use App\Models\Admin\Usuarios;
use Illuminate\Support\Facades\Session;

class AdministracionController extends Controller
{

    public function index()
    {
        return view('admin.index');
    }

    public function inicio()
    {
        return view('user.index');
    }

    public function dashboard()
    {
        setlocale(LC_ALL, 'es_CO');
        $EnDesarrollo   = Tickets::EnDesarrollo();
        foreach($EnDesarrollo as $valor){
            $desarrolloT = $valor->total;
        }

        $Pendientes     = Tickets::Pendientes();
        foreach($Pendientes as $valor){
            $pendientesT = $valor->total;
        }

        $Cancelados     = Tickets::Cancelados();
        foreach($Cancelados as $valor){
            $canceladosT = $valor->total;
        }

        $Terminados     = Tickets::Terminados();
        foreach($Terminados as $valor){
            $terminadosT = $valor->total;
        }

        $Infraestructura     = Tickets::Infraestructura();
        foreach($Infraestructura as $valor){
            $InfraestructuraT = $valor->total;
        }

        $Redes     = Tickets::Redes();
        foreach($Redes as $valor){
            $RedesT = $valor->total;
        }

        $Aplicaciones     = Tickets::Aplicaciones();
        foreach($Aplicaciones as $valor){
            $AplicacionesT = $valor->total;
        }

        $Soporte     = Tickets::Soporte();
        foreach($Soporte as $valor){
            $SoporteT = $valor->total;
        }

        setlocale(LC_ALL, 'es_ES');
        $fechaActual = date('M - Y');
        // $mesActual  = date('M - y', strtotime($fechaActual));
        $mesCreacion = date('M', strtotime($fechaActual));
        $anio = date('y', strtotime($fechaActual));
        $meses_ES = array("Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic");
        $meses_EN = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
        $nombreMes = str_replace($meses_EN, $meses_ES, $mesCreacion);

        $mesActual              = $nombreMes.' - '.$anio;
        $guardarMes             = Tickets::GuardarMes($mesActual);

        $buscarGestion          = Tickets::buscarGestion();
        $buscarGestionTotal     = Tickets::buscarGestionTotal();

        foreach($buscarGestionTotal as $row){
            $totalGestion = (int)$row->total;
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

                    if($contG >= ($contadorGestion-1)){
                        $resultado_gestion[$contG]['separador']= '';
                    }else{
                        $resultado_gestion[$contG]['separador']= ',';
                    }
                    $contG++;
            }
        }else{
            $resultado_gestion = null;
        }
        $buscarMes = Tickets::BuscarMes();
        if($guardarMes === false){
            $resultado_consulta = null;
        }else{
            // $buscarMes = Tickets::BuscarMes();
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

        return view('admin.index',['EnDesarrollo' => $desarrolloT,'Pendientes' => $pendientesT,
                                   'Terminados' => $terminadosT,'Cancelados' => $canceladosT,
                                   'MesGraficas' => $resultado_consulta,'Infraestructura' => $InfraestructuraT,
                                   'Redes' => $RedesT,'Aplicaciones' => $AplicacionesT,
                                   'Soporte' => $SoporteT,'Gestion' => $resultado_gestion]);

    }


    public function tickets()
    {
        $buscarTickets = Tickets::Tickets();
        $creadoPor = (int)Session::get('IdUsuario');
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
        // dd($tickets);
        $Categoria  = Tickets::ListarCategoria();
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
        $NombreArea[''] = 'Seleccione: ';
        foreach ($Areas as $row){
            $NombreArea[$row->id] = $row->nombre;
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

        $EstadoA  = Tickets::ListarEstadoA();
        $NombreEstadoA = array();
        $NombreEstadoA[0] = 'Seleccione: ';
        foreach ($EstadoA as $row){
            $NombreEstadoA[$row->id] = $row->name;
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
        Session::put('Notificacion',$valorNull);
        return view('tickets.tickets',['Tickets' => $tickets,'NombreTipo' => $NombreTipo,'NombreCategoria' => $NombreCategoria,
                                    'NombreUsuario' => $NombreUsuario,'NombrePrioridad' => $NombrePrioridad,'NombreEstado' => $NombreEstado,'NombreEstadoUpd' => $NombreEstadoUpd,
                                    'NombreZona' => $NombreZona,'NombreSede' => $NombreSede,'NombreArea' => $NombreArea,'CorreoUsuario' => null,
                                    'Usuario' => null,'Descripcion' => null,'TelefonoUsuario' => null,'Evidencia' => null,'Asunto' => null,'Comentario' => null,
                                    'NombreSedes' => $NombreSedes,'NombreAreas' => $NombreAreas,'NombreEstadoA' => $NombreEstadoA,'NombreCargo' => null,
                                    'NombreJefe' => null,'TelefonoJefe' => null]);
    }



}
