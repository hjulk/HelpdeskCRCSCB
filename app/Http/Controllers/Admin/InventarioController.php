<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
Use App\Models\User\Inventario;
Use App\Models\Admin\Sedes;
use Illuminate\Support\Facades\Input;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mobile()
    {
        $ListarEquiposMoviles = Inventario::ListarEquiposMoviles();
        $EquiposMoviles = array();
        $contEM = 0;
        foreach($ListarEquiposMoviles as $value){
            $EquiposMoviles[$contEM]['id']              = $value->id;
            $EquiposMoviles[$contEM]['linea']           = $value->linea;
            $EquiposMoviles[$contEM]['operador']        = $value->operador;
            $EquiposMoviles[$contEM]['empresa']         = $value->empresa;
            $EquiposMoviles[$contEM]['plan']            = $value->plan;
            $EquiposMoviles[$contEM]['datos']           = $value->datos;
            $EquiposMoviles[$contEM]['minutos_claro']   = $value->minutos_claro;
            $EquiposMoviles[$contEM]['minutos_otro']    = $value->minutos_otro;
            $EquiposMoviles[$contEM]['sms_claro']       = $value->sms_claro;
            $EquiposMoviles[$contEM]['sms_otro']        = $value->sms_otro;
            $EquiposMoviles[$contEM]['fecha_corte']     = $value->fecha_corte;
            $EquiposMoviles[$contEM]['cargo_fijo']      = $value->cargo_fijo;
            $EquiposMoviles[$contEM]['equipo1']         = $value->equipo1;
            $EquiposMoviles[$contEM]['imei1']           = $value->imei1;
            $EquiposMoviles[$contEM]['equipo2']         = $value->equipo2;
            $EquiposMoviles[$contEM]['imei2']           = $value->imei2;
            $EquiposMoviles[$contEM]['equipo3']         = $value->equipo3;
            $EquiposMoviles[$contEM]['imei3']           = $value->imei3;
            $EquiposMoviles[$contEM]['servicio']        = $value->servicio;
            $EquiposMoviles[$contEM]['cuenta']          = $value->cuenta;
            $EquiposMoviles[$contEM]['idUsuarioInv']    = $value->usuario_inventario;
            $usuario_inventario = $value->usuario_inventario;
            $UsuarioInventario  = Inventario::UsuarioInventario($usuario_inventario);
            foreach($UsuarioInventario as $row){
                $EquiposMoviles[$contEM]['nombre_usuario']  = $row->nombre_usuario;
                $EquiposMoviles[$contEM]['cedula']  = $row->cedula;
                $EquiposMoviles[$contEM]['cargo']   = $row->cargo;
                $EquiposMoviles[$contEM]['area']    = $row->area;
                $EquiposMoviles[$contEM]['centro_costos']   = $row->centro_costos;
                $id_area = (int)$row->area;
                $BuscarArea = Inventario::BuscarArea($id_area);
                foreach($BuscarArea as $row1){
                    $EquiposMoviles[$contEM]['nombre_area']    = strtoupper($row1->nombre);
                }
                $EquiposMoviles[$contEM]['sede']    = $row->sede;
                $id_sede = (int)$row->sede;
                $BuscarSede = Inventario::BuscarSede($id_sede);
                foreach($BuscarSede as $row1){
                    $EquiposMoviles[$contEM]['nombre_sede']    = strtoupper($row1->nombre);
                }
            }

            $EquiposMoviles[$contEM]['estado']          = $value->estado;
            $estado = (int)$value->estado;
            switch($estado){
                Case 1  :   $EquiposMoviles[$contEM]['nombre_estado'] = 'ACTIVO';
                            break;
                Case 2  :   $EquiposMoviles[$contEM]['nombre_estado'] = 'DE BAJA';
                            break;
                Case 3  :   $EquiposMoviles[$contEM]['nombre_estado'] = 'OBSOLETO';
                            break;
                Case 4  :   $EquiposMoviles[$contEM]['nombre_estado'] = 'EN REPOSICIÓN';
                            break;
            }
            $EquiposMoviles[$contEM]['botones'] = "<a href='detalleNovedadM?linea=".$value->linea."' onclick=\"window.open(this.href, this.target, ' width=1100, height=660,menubar=no,scrollbars=1');return false;\" class='btn btn-success'>Ver Novedades</a>
                                                    <a href='detalleResponsableM?linea=".$value->linea."' onclick=\"window.open(this.href, this.target, ' width=1200, height=660,menubar=no,scrollbars=1');return false;\" class='btn btn-primary'>Ver Responsables</a>";
            $contEM++;
        }

        $ListarSedes = Sedes::Sedes();
        $Sedes  = array();
        $Sedes[''] = 'Seleccione: ';
        foreach ($ListarSedes as $row){
            $Sedes[$row->id] = $row->nombre;
        }
        $ListarAreas = Sedes::AreasInventario();
        $Areas  = array();
        $Areas[''] = 'Seleccione: ';
        foreach ($ListarAreas as $row){
            $Areas[$row->id] = $row->nombre;
        }

        $SearchYear = Inventario::ListarYear();
        $YearNovedad = array();
        $YearNovedad[''] = 'Seleccione: ';
        foreach($SearchYear as $row){
            $YearNovedad[$row->id] = $row->year;
        }

        $SearchMonth = Inventario::ListarMonth();
        $MesNovedad = array();
        $MesNovedad[''] = 'Seleccione: ';
        foreach($SearchMonth as $row){
            $MesNovedad[$row->id] = $row->month;
        }

        return view('Inventario.Mobile',['EquiposMoviles' => $EquiposMoviles,'NumLinea' => null,'Operador' => null,'Empresa' => null,
                                        'Plan' => null,'Datos' => null,'MinutosClaro' => null,'MinutosOtros' => null,'SmsClaro' => null,
                                        'SmsOtros' => null,'FechaCorte' => null,'CargoFijo' => null,'Servicio' => null,'Cuenta' => null,
                                        'IMEI1' => null,'IMEI2' => null,'IMEI3' => null,'Equipo1' => null,'Equipo2' => null,'Equipo3' => null,
                                        'Nombre' => null,'Cedula' => null,'Cargo' => null,'Sedes' => $Sedes,'Areas' => $Areas,'CentroCostos' => null,
                                        'YearNovedad' => $YearNovedad,'MesNovedad' => $MesNovedad,'Novedad' => null,'ValorMes' => null]);
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

    public function detalleResponsableM(){

        $Linea = Input::get('linea');

        $BuscarInfoNumLinea = Inventario::BuscarInfoNumLinea($Linea);
        foreach($BuscarInfoNumLinea as $value){
            $IdLinea = $value->id;
        }

        $BuscarResponsableMobile = Inventario::BuscarResponsableMobile($IdLinea);

        $ListarSedes = Sedes::Sedes();
        $Sedes  = array();
        $Sedes[''] = 'Seleccione: ';
        foreach ($ListarSedes as $row){
            $Sedes[$row->id] = $row->nombre;
        }
        $ListarAreas = Sedes::AreasInventario();
        $Areas  = array();
        $Areas[''] = 'Seleccione: ';
        foreach ($ListarAreas as $row){
            $Areas[$row->id] = $row->nombre;
        }

        $ListarEstado = Inventario::ListarEstado();
        $Activo  = array();
        $Activo[''] = 'Seleccione: ';
        foreach ($ListarEstado as $row){
            $Activo[$row->id] = $row->nombre;
        }

        $Responsables = array();
        $contRM = 0;

        foreach($BuscarResponsableMobile as $row){
            $Responsables[$contRM]['id']                = (int)$row->id;
            $Responsables[$contRM]['id_responsable']    = (int)$row->id_responsable;
            $IdResponsable = $row->id_responsable;
            $buscarResponsable = Inventario::UsuarioInventario($IdResponsable);
            foreach($buscarResponsable as $valor){
                $Responsables[$contRM]['nombre_responsable']    = $valor->nombre_usuario;
                $Responsables[$contRM]['cedula_responsable']    = $valor->cedula;
                $Responsables[$contRM]['cargo_responsable']     = $valor->cargo;
                $Responsables[$contRM]['area_responsable']      = (int)$valor->area;
                $Responsables[$contRM]['sede_responsable']      = (int)$valor->sede;
                $Responsables[$contRM]['centroC_responsable']   = $valor->centro_costos;
                $id_area = (int)$valor->area;
                $BuscarArea = Inventario::BuscarArea($id_area);
                foreach($BuscarArea as $row1){
                    $Responsables[$contRM]['area1_responsable']    = strtoupper($row1->nombre);
                }
                $id_sede = (int)$valor->sede;
                $BuscarSede = Inventario::BuscarSede($id_sede);
                foreach($BuscarSede as $row1){
                    $Responsables[$contRM]['sede1_responsable']    = strtoupper($row1->nombre);
                }
            }

            $Responsables[$contRM]['id_mobile']         = (int)$row->id_mobile;
            $Responsables[$contRM]['estado']            = (int)$row->estado;

            $Estado = (int)$row->estado;
            switch($Estado){
                Case 1: $Responsables[$contRM]['nombre_estado'] = 'ACTIVO';
                        break;

                Case 2: $Responsables[$contRM]['nombre_estado'] = 'INACTIVO';
                        break;
            }

            $contRM++;
        }

        return view('Inventario.DetalleResponsableM',['Linea' => $Linea,'Nombre' => null,'Cedula' => null,'Cargo' => null,'IdLinea' => $IdLinea,
                                                        'Sedes' => $Sedes,'Areas' => $Areas,'CentroCostos' => null,'Responsables' => $Responsables,
                                                        'Estado' => $Activo]);
    }

}
