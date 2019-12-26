<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
Use App\Models\HelpDesk\Inventario;
Use App\Models\Admin\Sedes;
use Illuminate\Support\Facades\Input;

class InventarioController extends Controller
{
    public function mobile(){

        $EquiposStock = Inventario::MobileStock();
        foreach($EquiposStock as $row){
            $TotalStock = (int)$row->total;
        }
        $EquiposAsignados = Inventario::MobileAsigned();
        foreach($EquiposAsignados as $row){
            $TotalAsignados = (int)$row->total;
        }
        $EquiposMantenimiento = Inventario::MobileMaintenance();
        foreach($EquiposMantenimiento as $row){
            $TotalMantenimiento = (int)$row->total;
        }
        $EquiposObsoletos = Inventario::MobileObsolete();
        foreach($EquiposObsoletos as $row){
            $TotalObsoletos = (int)$row->total;
        }
        $ListarEquiposMoviles = Inventario::ListarEquiposMoviles();
        $EquiposMoviles = array();
        $contEM = 0;
        foreach($ListarEquiposMoviles as $value){
            $IdEquipoMovil                              = (int)$value->id;
            $EquiposMoviles[$contEM]['id']              = (int)$value->id;
            $EquiposMoviles[$contEM]['tipo_equipo']     = $value->tipo_equipo;
            $EquiposMoviles[$contEM]['fecha_ingreso']   = date('d/m/Y', strtotime($value->fecha_ingreso));
            $EquiposMoviles[$contEM]['serial']          = $value->serial;
            $EquiposMoviles[$contEM]['marca']           = $value->marca;
            $EquiposMoviles[$contEM]['modelo']          = $value->modelo;
            $EquiposMoviles[$contEM]['IMEI']            = $value->IMEI;
            $EquiposMoviles[$contEM]['capacidad']       = $value->capacidad;
            $EquiposMoviles[$contEM]['usuario']         = $value->usuario;
            $EquiposMoviles[$contEM]['area']            = $value->area;
            $EquiposMoviles[$contEM]['linea']           = $value->linea;
            $EquiposMoviles[$contEM]['estado_equipo']   = $value->estado_equipo;
            $EquiposMoviles[$contEM]['created_at']      = date('d/m/Y h:i A', strtotime($value->created_at));
            $EquiposMoviles[$contEM]['user_id']         = $value->user_id;

            $IdTipoEquipo   = (int)$value->tipo_equipo;
            $TipoEquipo     = Inventario::BuscarEquipoId($IdTipoEquipo);
            foreach($TipoEquipo as $row){
                $EquiposMoviles[$contEM]['tipoEquipo']  = $row->name;
            }

            $IdLinea        = (int)$value->linea;
            if($IdLinea){
                $NroLinea       = Inventario::BuscarNroLinea($IdLinea);
                foreach($NroLinea as $row){
                    $EquiposMoviles[$contEM]['nro_linea']  = $row->nro_linea;
                }
            }else{
                $EquiposMoviles[$contEM]['nro_linea']  = 'SIN Nro. LINEA';
            }

            $IdEstadoEquipo = (int)$value->estado_equipo;
            $EstadoEquipo   = Inventario::EstadoEquipoId($IdEstadoEquipo);
            foreach($EstadoEquipo as $row){
                switch($IdEstadoEquipo){
                    Case 1  :   $EquiposMoviles[$contEM]['estado']  = $row->name;
                                $EquiposMoviles[$contEM]['label']   = 'label label-primary';
                                break;
                    Case 2  :   $EquiposMoviles[$contEM]['estado']  = $row->name;
                                $EquiposMoviles[$contEM]['label']   = 'label label-success';
                                break;
                    Case 3  :   $EquiposMoviles[$contEM]['estado']  = $row->name;
                                $EquiposMoviles[$contEM]['label']   = 'label label-danger';
                                break;
                    Case 4  :   $EquiposMoviles[$contEM]['estado']  = $row->name;
                                $EquiposMoviles[$contEM]['label']   = 'label label-warning';
                                break;
                }
            }

            $EquiposMoviles[$contEM]['evidencia']    = null;
            $evidenciaTicket = Inventario::EvidenciaEquipoM($IdEquipoMovil);
            $contadorEvidencia = count($evidenciaTicket);
            if($contadorEvidencia > 0){
                $contE = 1;
                foreach($evidenciaTicket as $row){
                    $EquiposMoviles[$contEM]['evidencia'] .= "<p><a href='../assets/dist/img/evidencias_inventario/".$row->nombre."' target='_blank' class='btn btn-info'><i class='fa fa-file-archive-o'></i>&nbsp; Anexo Equipo Movil  $IdEquipoMovil Nro. ".$contE."</a></p>";
                    $contE++;
                }
            }else{
                $EquiposMoviles[$contEM]['evidencia'] = null;
            }

            $contEM++;
        }

        $ListaTipoEquipo = Inventario::ListadoTipoEquipoMovil();
        $TipoEquipo  = array();
        $TipoEquipo[''] = 'Seleccione: ';
        foreach ($ListaTipoEquipo as $row){
            $TipoEquipo[$row->id] = $row->name;
        }

        $ListaLineaMovil = Inventario::ListadoLineaMovil();
        $LineaMovil  = array();
        $LineaMovil[''] = 'Seleccione: ';
        foreach ($ListaLineaMovil as $row){
            $LineaMovil[$row->id] = $row->nro_linea;
        }

        $ListadoLineaMovilUpd = Inventario::ListadoLineaMovilUpd();
        $LineaMovilUpd  = array();
        $LineaMovilUpd[''] = 'Seleccione: ';
        foreach ($ListadoLineaMovilUpd as $row){
            $LineaMovilUpd[$row->id] = $row->nro_linea;
        }

        $ListarEstadoEquipos = Inventario::ListarEstadoEquipos();
        $EstadoEquipo  = array();
        $EstadoEquipo[''] = 'Seleccione: ';
        foreach ($ListarEstadoEquipos as $row){
            $EstadoEquipo[$row->id] = $row->name;
        }

        return view('Inventario.Mobile',['Stock' => $TotalStock,'Asignados' => $TotalAsignados,'Mantenimiento' => $TotalMantenimiento,'Obsoletos' => $TotalObsoletos,
                                        'EquiposMoviles' => $EquiposMoviles,'TipoEquipo' => $TipoEquipo,'LineaMovil' => $LineaMovil,'EstadoEquipo' => $EstadoEquipo,
                                        'FechaAdquisicion' => null,'Serial' => null,'Marca' => null,'Modelo' => null,'IMEI' => null,'Capacidad' => null,'Area' => null,
                                        'NombreAsignado' => null,'LineaMovilUpd' => $LineaMovilUpd]);
    }

    public function lineMobile(){
        $LineasStock = Inventario::LineMobileStock();
        foreach($LineasStock as $row){
            $TotalStock = (int)$row->total;
        }
        $LineasAsignados = Inventario::LineMobileAsigned();
        foreach($LineasAsignados as $row){
            $TotalAsignados = (int)$row->total;
        }
        $LineasMantenimiento = Inventario::LineMobileMaintenance();
        foreach($LineasMantenimiento as $row){
            $TotalMantenimiento = (int)$row->total;
        }
        $LineasObsoletos = Inventario::LineMobileObsolete();
        foreach($LineasObsoletos as $row){
            $TotalObsoletos = (int)$row->total;
        }

        $ListarLineasMoviles = Inventario::ListarLineasMoviles();
        $LineasMoviles = array();
        $contLM = 0;
        foreach($ListarLineasMoviles as $value){
            $IdLineaMovil                               = (int)$value->id;
            $LineasMoviles[$contLM]['id']               = (int)$value->id;
            $LineasMoviles[$contLM]['nro_linea']        = $value->nro_linea;
            $LineasMoviles[$contLM]['activo']           = (int)$value->activo;
            $LineasMoviles[$contLM]['proveedor']        = $value->proveedor;
            $LineasMoviles[$contLM]['plan']             = $value->plan;
            $LineasMoviles[$contLM]['serial']           = $value->serial;
            $LineasMoviles[$contLM]['fecha_ingreso']    = date('d/m/Y', strtotime($value->fecha_ingreso));
            $LineasMoviles[$contLM]['pto_cargo']        = $value->pto_cargo;
            $LineasMoviles[$contLM]['cc']               = $value->cc;
            $LineasMoviles[$contLM]['area']             = $value->area;
            $LineasMoviles[$contLM]['personal']         = $value->personal;
            $LineasMoviles[$contLM]['estado_equipo']    = $value->estado_equipo;
            $LineasMoviles[$contLM]['created_at']       = date('d/m/Y h:i A', strtotime($value->created_at));
            $LineasMoviles[$contLM]['user_id']          = $value->user_id;

            $IdActivo = (int)$value->activo;
            if($IdActivo === 1){
                $LineasMoviles[$contLM]['estado_activo']= 'Sí';
            }else{
                $LineasMoviles[$contLM]['estado_activo']= 'No';
            }

            $IdEstadoEquipo = (int)$value->estado_equipo;
            $EstadoEquipo   = Inventario::EstadoEquipoId($IdEstadoEquipo);
            foreach($EstadoEquipo as $row){
                switch($IdEstadoEquipo){
                    Case 1  :   $LineasMoviles[$contLM]['estado']  = $row->name;
                                $LineasMoviles[$contLM]['label']   = 'label label-primary';
                                break;
                    Case 2  :   $LineasMoviles[$contLM]['estado']  = $row->name;
                                $LineasMoviles[$contLM]['label']   = 'label label-success';
                                break;
                    Case 3  :   $LineasMoviles[$contLM]['estado']  = $row->name;
                                $LineasMoviles[$contLM]['label']   = 'label label-danger';
                                break;
                    Case 4  :   $LineasMoviles[$contLM]['estado']  = $row->name;
                                $LineasMoviles[$contLM]['label']   = 'label label-warning';
                                break;
                }
            }

            $LineasMoviles[$contLM]['evidencia']    = null;
            $evidenciaTicket = Inventario::EvidenciaLineaM($IdLineaMovil);
            $contadorEvidencia = count($evidenciaTicket);
            if($contadorEvidencia > 0){
                $contE = 1;
                foreach($evidenciaTicket as $row){
                    $LineasMoviles[$contLM]['evidencia'] .= "<p><a href='../assets/dist/img/evidencias_inventario/".$row->nombre."' target='_blank' class='btn btn-info'><i class='fa fa-file-archive-o'></i>&nbsp; Anexo Linea Movil  $IdLineaMovil Nro. ".$contE."</a></p>";
                    $contE++;
                }
            }else{
                $LineasMoviles[$contLM]['evidencia'] = null;
            }

            $contLM++;
        }

        $Activo     = array();
        $Activo[''] = 'Seleccione: ';
        $Activo[1]  = 'Si';
        $Activo[0]  = 'No';

        $ListarProveedores = Inventario::ProveedorLM();
        $Proveedores  = array();
        $Proveedores[''] = 'Seleccione: ';
        foreach ($ListarProveedores as $row){
            $Proveedores[$row->id] = $row->name;
        }

        $ListarEstadoLinea = Inventario::ListarEstadoEquipos();
        $EstadoLinea  = array();
        $EstadoLinea[''] = 'Seleccione: ';
        foreach ($ListarEstadoLinea as $row){
            $EstadoLinea[$row->id] = $row->name;
        }


        return view('Inventario.LineMobile',['Stock' => $TotalStock,'Asignados' => $TotalAsignados,'Mantenimiento' => $TotalMantenimiento,'Obsoletos' => $TotalObsoletos,
                                            'LineasMoviles' => $LineasMoviles,'Activo' => $Activo,'Proveedores' => $Proveedores,'EstadoLinea' => $EstadoLinea,
                                            'FechaAdquisicion' => null,'Serial' => null,'NroLinea' => null,'Plan' => null,'PtoCargo' => null,'CC' => null,'Area' => null,
                                            'Personal' => null]);
    }

    public function desktops(){

        $LineasStock = Inventario::EquipoStock();
        foreach($LineasStock as $row){
            $TotalStock = (int)$row->total;
        }
        $LineasAsignados = Inventario::EquipoAsigned();
        foreach($LineasAsignados as $row){
            $TotalAsignados = (int)$row->total;
        }
        $LineasMantenimiento = Inventario::EquipoMaintenance();
        foreach($LineasMantenimiento as $row){
            $TotalMantenimiento = (int)$row->total;
        }
        $LineasObsoletos = Inventario::EquipoObsolete();
        foreach($LineasObsoletos as $row){
            $TotalObsoletos = (int)$row->total;
        }

        $ListarEquipos = Inventario::ListarEquipos();
        $Equipos = array();
        $contD = 0;
        foreach($ListarEquipos as $value){
            $IdEquipo                           = (int)$value->id;
            $Equipos[$contD]['id']              = (int)$value->id;

            $Equipos[$contD]['tipo_equipo']     = (int)$value->tipo_equipo;
            $IdTipoEquipo                       = (int)$value->tipo_equipo;
            $TipoEquipo                         = Inventario::BuscarEquipoId($IdTipoEquipo);
            foreach($TipoEquipo as $row){
                $Equipos[$contD]['tipoEquipo']  = $row->name;
            }

            $Equipos[$contD]['tipo_ingreso']    = (int)$value->tipo_ingreso;
            $IdTipoIngreso                      = (int)$value->tipo_ingreso;
            $TipoIngreso                        = Inventario::BuscarTipoIngresoId($IdTipoIngreso);
            foreach($TipoIngreso as $row){
                $Equipos[$contD]['tipoIngreso'] = $row->name;
            }

            $Equipos[$contD]['emp_renting']     = strtoupper($value->emp_renting);
            $Equipos[$contD]['fecha_ingreso']   = date('d/m/Y', strtotime($value->fecha_ingreso));
            $Equipos[$contD]['serial']          = $value->serial;
            $Equipos[$contD]['marca']           = strtoupper($value->marca);
            $Equipos[$contD]['procesador']      = $value->procesador;
            $Equipos[$contD]['vel_procesador']  = $value->vel_procesador;
            $Equipos[$contD]['disco_duro']      = $value->disco_duro;
            $Equipos[$contD]['memoria_ram']     = $value->memoria_ram;

            $Equipos[$contD]['estado_equipo']   = (int)$value->estado_equipo;
            $IdEstadoEquipo = (int)$value->estado_equipo;
            $EstadoEquipo   = Inventario::EstadoEquipoId($IdEstadoEquipo);
            foreach($EstadoEquipo as $row){
                switch($IdEstadoEquipo){
                    Case 1  :   $Equipos[$contD]['estado']  = $row->name;
                                $Equipos[$contD]['label']   = 'label label-primary';
                                break;
                    Case 2  :   $Equipos[$contD]['estado']  = $row->name;
                                $Equipos[$contD]['label']   = 'label label-success';
                                break;
                    Case 3  :   $Equipos[$contD]['estado']  = $row->name;
                                $Equipos[$contD]['label']   = 'label label-danger';
                                break;
                    Case 4  :   $Equipos[$contD]['estado']  = $row->name;
                                $Equipos[$contD]['label']   = 'label label-warning';
                                break;
                }
            }

            $Equipos[$contD]['evidencia']    = null;
            $evidenciaTicket = Inventario::EvidenciaEquipo($IdEquipo);
            $contadorEvidencia = count($evidenciaTicket);
            if($contadorEvidencia > 0){
                $contE = 1;
                foreach($evidenciaTicket as $row){
                    $Equipos[$contD]['evidencia'] .= "<p><a href='../assets/dist/img/evidencias_inventario/".$row->nombre."' target='_blank' class='btn btn-info'><i class='fa fa-file-archive-o'></i>&nbsp; Anexo Linea Movil  $IdEquipo Nro. ".$contE."</a></p>";
                    $contE++;
                }
            }else{
                $Equipos[$contD]['evidencia'] = null;
            }

            $contD++;
        }

        $ListaTipoEquipo = Inventario::ListarEquipoUsuarioC();
        $TipoEquipo  = array();
        $TipoEquipo[''] = 'Seleccione: ';
        foreach ($ListaTipoEquipo as $row){
            $TipoEquipo[$row->id] = $row->name;
        }

        $ListaTipoIngreso = Inventario::ListarTipoIngreso();
        $TipoIngreso  = array();
        $TipoIngreso[''] = 'Seleccione: ';
        foreach ($ListaTipoIngreso as $row){
            $TipoIngreso[$row->id] = $row->name;
        }

        $ListarEstado = Inventario::ListarEstadoEquipos();
        $EstadoEquipo  = array();
        $EstadoEquipo[''] = 'Seleccione: ';
        foreach ($ListarEstado as $row){
            $EstadoEquipo[$row->id] = $row->name;
        }

        return view('Inventario.Desktops',['Stock' => $TotalStock,'Asignados' => $TotalAsignados,'Mantenimiento' => $TotalMantenimiento,'Obsoletos' => $TotalObsoletos,
                                            'Equipos' => $Equipos,'TipoEquipo' => $TipoEquipo,'TipoIngreso' => $TipoIngreso,'EstadoEquipo' =>$EstadoEquipo,
                                            'Renting' => null,'FechaAdquisicion' => null,'Serial' => null,'Procesador' => null,'Marca' => null,'VelProcesador' => null,
                                            'DiscoDuro' => null,'MemoriaRam' => null]);
    }



}
