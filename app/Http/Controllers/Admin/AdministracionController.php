<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HelpDesk\Tickets;
use App\Models\Admin\Sedes;
use App\Models\Admin\Usuarios;
use App\Models\Admin\Roles;
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

        $Servinte     = Tickets::Servinte();
        foreach($Servinte as $valor){
            $ServinteT = $valor->total;
        }

        $BuscarMInsatisfecho     = Tickets::BuscarMInsatisfecho();
        foreach($BuscarMInsatisfecho as $valor){
            $MuyInsatisfecho = $valor->total;
        }
        $BuscarInsatisfecho     = Tickets::BuscarInsatisfecho();
        foreach($BuscarInsatisfecho as $valor){
            $Insatisfecho = $valor->total;
        }
        $BuscarNeutral     = Tickets::BuscarNeutral();
        foreach($BuscarNeutral as $valor){
            $Neutral = $valor->total;
        }
        $BuscarSatisfecho     = Tickets::BuscarSatisfecho();
        foreach($BuscarSatisfecho as $valor){
            $Satisfecho = $valor->total;
        }
        $BuscarMSatisfecho     = Tickets::BuscarMSatisfecho();
        foreach($BuscarMSatisfecho as $valor){
            $MuySatisfecho = $valor->total;
        }
        $PorcentajeMInsatisfecho     = Tickets::PorcentajeMInsatisfecho();
        foreach($PorcentajeMInsatisfecho as $valor){
            $PMuyInsatisfecho = $valor->porcentaje;
        }
        $PorcentajeInsatisfecho     = Tickets::PorcentajeInsatisfecho();
        foreach($PorcentajeInsatisfecho as $valor){
            $PInsatisfecho = $valor->porcentaje;
        }
        $PorcentajeNeutral     = Tickets::PorcentajeNeutral();
        foreach($PorcentajeNeutral as $valor){
            $PNeutral = $valor->porcentaje;
        }
        $PorcentajeSatisfecho     = Tickets::PorcentajeSatisfecho();
        foreach($PorcentajeSatisfecho as $valor){
            $PSatisfecho = $valor->porcentaje;
        }
        $PorcentajeMSatisfecho     = Tickets::PorcentajeMSatisfecho();
        foreach($PorcentajeMSatisfecho as $valor){
            $PMuySatisfecho = $valor->porcentaje;
        }

        setlocale(LC_ALL, 'es_ES');
        $fechaActual = date('M - Y');
        // $mesActual  = date('M - y', strtotime($fechaActual));
        $mesCreacion = date('M', strtotime($fechaActual));
        $anio = date('y', strtotime($fechaActual));
        $year = date('Y', strtotime($fechaActual));
        $meses_ES = array("Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic");
        $meses_EN = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
        $nombreMes = str_replace($meses_EN, $meses_ES, $mesCreacion);

        $mesActual              = $nombreMes;
        $YearActual             = (int)$anio;
        $guardarMes             = Tickets::GuardarMes($mesActual,$anio);

        $buscarGestion                  = Tickets::buscarGestion();
        $buscarGestionTotal             = Tickets::buscarGestionTotal();
        $buscarGestionSede              = Tickets::buscarGestionSede();
        $buscarGestionTotalSede         = Tickets::buscarGestionTotalSede();
        $buscarGestionCalificacion      = Tickets::buscarGestionCalificacion();
        $buscarGestionTotalCalificacion = Tickets::buscarGestionTotalCalificacion();

        foreach($buscarGestionTotal as $row){
            $totalGestion = (int)$row->total;
        }
        foreach($buscarGestionTotalSede as $row){
            $totalGestionSede = (int)$row->total;
        }
        foreach($buscarGestionTotalCalificacion as $row){
            $totalGestionCalificacion = (int)$row->total;
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
        if($totalGestionSede > 0){
            $resultado_gestionS = array();
            $contadorGestionS = count($buscarGestionSede);
            $contGS = 0;
            foreach($buscarGestionSede as $consulta){
                    $resultado_gestionS[$contGS]['nombre']= $consulta->nombre_sede;
                    $resultado_gestionS[$contGS]['incidentes']= $consulta->incidentes;
                    $resultado_gestionS[$contGS]['requerimientos']= $consulta->requerimientos;

                    if($contGS >= ($contadorGestionS-1)){
                        $resultado_gestionS[$contGS]['separador']= '';
                    }else{
                        $resultado_gestionS[$contGS]['separador']= ',';
                    }
                    $contGS++;
            }
        }else{
            $resultado_gestionS = null;
        }
        if($totalGestionCalificacion > 0){
            $resultado_gestionC = array();
            $contadorGestionC = count($buscarGestionCalificacion);
            $contGC = 0;
            foreach($buscarGestionCalificacion as $consulta){
                    $resultado_gestionC[$contGC]['nombre']      = $consulta->nombre;
                    $resultado_gestionC[$contGC]['total']       = $consulta->total;
                    $resultado_gestionC[$contGC]['porcentaje']  = $consulta->porcentaje;
                    $resultado_gestionC[$contGC]['color']       = $consulta->color;
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
        $buscarMes = Tickets::BuscarMes($anio);
        if($guardarMes === false){
            $resultado_consulta = null;
        }else{
            // $buscarMes = Tickets::BuscarMes();
            $contadorMes = count($buscarMes);

            foreach($buscarMes as $consulta){
                    $resultado_consulta[$cont]['nombre']            = $consulta->mes.' - '.$consulta->year;
                    $resultado_consulta[$cont]['incidentes']        = $consulta->incidentes;
                    $resultado_consulta[$cont]['requerimientos']    = $consulta->requerimientos;

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
                                   'Redes' => $RedesT,'Aplicaciones' => $AplicacionesT,'ServinteT' => $ServinteT,
                                   'Soporte' => $SoporteT,'Gestion' => $resultado_gestion,'GestionS' => $resultado_gestionS,
                                   'GestionC' => $resultado_gestionC,'MuyInsatisfecho' => $MuyInsatisfecho,'Insatisfecho' => $Insatisfecho,
                                   'Neutral' => $Neutral,'Satisfecho' => $Satisfecho,'MuySatisfecho' => $MuySatisfecho,
                                   'PMuyInsatisfecho' => $PMuyInsatisfecho,'PInsatisfecho' => $PInsatisfecho,
                                   'PNeutral' => $PNeutral,'PSatisfecho' => $PSatisfecho,'PMuySatisfecho' => $PMuySatisfecho]);

    }


    public function tickets()
    {
        $buscarTickets = Tickets::Tickets();
        $creadoPor = (int)Session::get('IdUsuario');
        $tickets = array();
        $cont = 0;
        date_default_timezone_set('America/Bogota');
        foreach($buscarTickets as $value){
            $id_ticket                      = (int)$value->id;
            $tickets[$cont]['id']           = (int)$value->id;
            $tickets[$cont]['title']        = $value->title;
            $tickets[$cont]['description']  = $value->description;
            $tickets[$cont]['created_at']   = date('d/m/Y h:i A', strtotime($value->created_at));
            if($value->updated_at){
                $tickets[$cont]['updated_at']   = date('d/m/Y h:i A', strtotime($value->updated_at));
            }else{
                $tickets[$cont]['updated_at']   = "SIN FECHA DE ACTUALIZACIÓN";
            }


            $tickets[$cont]['kind_id']       = (int)$value->kind_id;
            $idTipoTicket = (int)$value->kind_id;
            $TipoTicket = Tickets::Tipo($idTipoTicket);
            foreach($TipoTicket as $row){
                $tickets[$cont]['tipo_ticket'] = $row->name;
            }

            $tickets[$cont]['user_id']      = (int)$value->user_id;
            $tickets[$cont]['asigned_id']   = (int)$value->asigned_id;
            $tickets[$cont]['session_id']   = (int)$value->session_id;
            $idAsignador    =  (int)$value->user_id;
            $idAsignado     =  (int)$value->asigned_id;

            $Asignador  = Usuarios::BuscarNombre($idAsignador);
            $Asignado   = Usuarios::BuscarNombre($idAsignado);
            if($Asignador){
                foreach($Asignador as $row){
                    $tickets[$cont]['asignado_por'] = strtoupper($row->name);
                }
            }else{
                $tickets[$cont]['asignado_por'] = 'SIN NOMBRE';
            }
            if($Asignado){
                foreach($Asignado as $row){
                    $tickets[$cont]['asignado_a'] = strtoupper($row->name);
                }
            }else{
                $tickets[$cont]['asignado_a'] = 'SIN NOMBRE';
            }


            $tickets[$cont]['project_id']   = (int)$value->project_id;
            $idSede = (int)$value->project_id;
            $BuscarSede = Sedes::BuscarSedeID($idSede);
            foreach($BuscarSede as $row){
                $tickets[$cont]['sede'] = strtoupper($row->name);
            }

            $tickets[$cont]['dependencia']   = (int)$value->dependencia;
            $dependencia = $value->dependencia;
            if($dependencia === null){
                $tickets[$cont]['area'] = "SIN ÁREA/DEPENDENCIA";
            }else{
                $tickets[$cont]['area'] = strtoupper($dependencia);
            }

            $tickets[$cont]['category_id']   = (int)$value->category_id;
            $IdCategoria    = (int)$value->category_id;
            $Categoria      =  Roles::BuscarCategoriaID($IdCategoria);
            foreach($Categoria as $row){
                $tickets[$cont]['categoria'] = strtoupper($row->name);
            }


            $tickets[$cont]['priority_id']   = (int)$value->priority_id;
            $IdPrioridad   = (int)$value->priority_id;
            $Prioridad     =  Tickets::BuscarPrioridadID($IdPrioridad);
            foreach($Prioridad as $row){
                $NombrePrioridad = strtoupper($row->name);
            }

            if($IdPrioridad === 1){
                $tickets[$cont]['prioridad']    = $NombrePrioridad;
                $tickets[$cont]['label']        = 'label label-danger';
            }else if($IdPrioridad === 2){
                $tickets[$cont]['prioridad']    = $NombrePrioridad;
                $tickets[$cont]['label']        = 'label label-warning';
            }else if($IdPrioridad === 3){
                $tickets[$cont]['prioridad']    = $NombrePrioridad;
                $tickets[$cont]['label']        = 'label label-success';
            }else{
                $NombrePrioridad = 'SIN PRIORIDAD';
            }

            $tickets[$cont]['status_id']   = (int)$value->status_id;
            $IdEstado   = (int)$value->priority_id;
            $Estado     =  Tickets::Estado($IdEstado);
            foreach($Estado as $row){
                $tickets[$cont]['estado'] = strtoupper($row->name);
            }

            $tickets[$cont]['name_user']    = strtoupper($value->name_user);
            $tickets[$cont]['tel_user']     = $value->tel_user;
            $tickets[$cont]['user_email']   = $value->user_email;

            if($value->evidencia != 'null'){
                $tickets[$cont]['evidencia'] = "<a href='../assets/dis/img/evidencias/".$value->evidencia."' target='_blank'>Anexo Inicial</a>";
            }else{
                $tickets[$cont]['evidencia'] = "";
            }

            $historialTicket = Tickets::HistorialTicket($id_ticket);
            $contadorHistorial = count($historialTicket);
            $tickets[$cont]['historial'] = null;
            if($contadorHistorial > 0){
                foreach($historialTicket as $row){
                    $tickets[$cont]['historial'] .= "- ".$row->observacion." (".$row->user_id." - ".date('d/m/Y h:i a', strtotime($row->created)).")\n";
                }
            }else{
                $tickets[$cont]['historial'] = null;
            }
            $tickets[$cont]['id_create_user']   = (int)$value->id_create_user;
            $tickets[$cont]['h_asigned_id']     = (int)$value->h_asigned_id;
            $idAsignadoh = (int)$value->h_asigned_id;
            $AsignadoH   = Usuarios::BuscarNombre($idAsignadoh);
            foreach($AsignadoH as $row){
                $tickets[$cont]['asignado_h'] = strtoupper($row->name);
            }

            $cont++;
        }

        $Categoria  = Roles::ListarCategorias();
        $NombreCategoria = array();
        $NombreCategoria[''] = 'Seleccione: ';
        foreach ($Categoria as $row){
            $NombreCategoria[$row->id] = $row->name;
        }

        $Prioridad  = Tickets::ListarPrioridad();
        $NombrePrioridad = array();
        $NombrePrioridad[''] = 'Seleccione: ';
        foreach ($Prioridad as $row){
            $NombrePrioridad[$row->id] = $row->name;
        }

        $NombreUsuario = array();
        $NombreUsuario[''] = 'Seleccione: ';

        $NombreSede = array();
        $NombreSede[''] = 'Seleccione: ';

        $Sedes  = Sedes::Sedes();

        foreach ($Sedes as $row){
            $NombreSede[$row->id] = $row->name;
        }

        $Tipo  = Tickets::ListarTipo();
        $NombreTipo = array();
        $NombreTipo[0] = 'Seleccione: ';
        foreach ($Tipo as $row){
            $NombreTipo[$row->id] = $row->name;
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

        Tickets::UpdateNotificacion($creadoPor);
        $valorCero = 0;
        $valorNull = null;
        Session::put('Notificaciones',$valorCero);
        Session::put('Notificacion',$valorNull);
        return view('tickets.tickets',['Tickets' => $tickets,'NombreCategoria' => $NombreCategoria,
                                    'NombreUsuario' => $NombreUsuario,'NombrePrioridad' => $NombrePrioridad,'NombreEstado' => $NombreEstado,'NombreEstadoUpd' => $NombreEstadoUpd,
                                    'NombreSede' => $NombreSede,'CorreoUsuario' => null,'NombreTipo' => $NombreTipo,
                                    'Usuario' => null,'Descripcion' => null,'TelefonoUsuario' => null,'Evidencia' => null,'Asunto' => null,'Comentario' => null,
                                    'NombreEstadoA' => $NombreEstadoA,'NombreCargo' => null,
                                    'Dependencia' => null]);
    }



}
