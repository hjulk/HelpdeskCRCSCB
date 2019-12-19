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
            $EquiposMoviles[$contEM]['id']              = $value->id;
            $EquiposMoviles[$contEM]['tipo_equipo']     = $value->tipo_equipo;
            $EquiposMoviles[$contEM]['fecha_ingreso']   = date('d/m/Y h:i A', strtotime($value->fecha_ingreso));
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
            $NroLinea       = Inventario::BuscarNroLinea($IdLinea);
            foreach($NroLinea as $row){
                $EquiposMoviles[$contEM]['nro_linea']  = $row->nro_linea;
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
                    $EquiposMoviles[$contEM]['evidencia'] .= "<a href='../assets/dist/img/evidencias_inventario/".$row->nombre."' target='_blank'>Anexo Ticket  $IdEquipoMovil No.".$contE."</a><p>";
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
        $LineaMLineaMovilUpdovil[''] = 'Seleccione: ';
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

    public function detalleNovedadM(){

        $Linea = Input::get('linea');

        $BuscarInfoNumLinea = Inventario::BuscarInfoNumLinea($Linea);
        foreach($BuscarInfoNumLinea as $value){
            $IdLinea = $value->id;
        }

        $ListarNovedadMobile = Inventario::ListarNovedadMobileId($IdLinea);

        $Novedades = array();
        $contNM = 0;

        foreach($ListarNovedadMobile as $row){
            $Novedades[$contNM]['id_novedad']   = $row->id_novedad;
            $Novedades[$contNM]['year']         = $row->year;
            $Novedades[$contNM]['mes']          = $row->mes;
            $Novedades[$contNM]['valor_mes']    = $row->valor_mes;
            $Novedades[$contNM]['valormes']     = '$'.$row->valor_mes;
            $Novedades[$contNM]['novedad_mes']  = $row->novedad_mes;
            $Novedades[$contNM]['linea']        = $Linea;
            $yearNovedad = $row->year;
            $monthNovedad = $row->mes;
            $buscarYear = Inventario::ListarYearId($yearNovedad);
            foreach($buscarYear as $values){
                $Novedades[$contNM]['yearName'] = $values->year;
            }
            $buscarMonth = Inventario::ListarMonthId($monthNovedad);
            foreach($buscarMonth as $values){
                $Novedades[$contNM]['mesName'] = $values->month;
            }
            $contNM++;
        }

        $SearchYear = Inventario::ListarYear();
        $ListYear = array();
        $ListYear[''] = 'Seleccione: ';
        foreach($SearchYear as $row){
            $ListYear[$row->id] = $row->year;
        }
        $SearchMonth = Inventario::ListarMonth();
        $ListMonth = array();
        $ListMonth[''] = 'Seleccione: ';
        foreach($SearchMonth as $row){
            $ListMonth[$row->id] = $row->month;
        }

        return view('Inventario.DetalleNovedadM',['Novedades' => $Novedades,'ListYear' => $ListYear,'ListMonth' => $ListMonth,
                                                    'Linea' => $Linea,'Valor' => null,'Novedad' => null,'IdLinea' => $IdLinea]);
    }



}
