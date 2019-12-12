<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\Admin\Sedes;
use App\Models\User\Tickets;
use App\Models\User\ControlCambios;
use Validator;
use App\Models\Admin\Usuarios;
use Illuminate\Support\Facades\Mail;
USE Illuminate\Support\Facades\Session;

class ControlCambiosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function reporteCambios(){
        $Categoria  = Usuarios::Categoria();
        $NombreCategoria = array();
        $NombreCategoria[''] = 'Seleccione: ';
        foreach ($Categoria as $row){
            $NombreCategoria[$row->id] = $row->nombre;
        }
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

        $NombreUsuario = array();
        $NombreUsuario[''] = 'Seleccione: ';
        $Usuarios = Usuarios::ListarUsuarios();
        foreach ($Usuarios as $row){
            $NombreUsuario[$row->id] = $row->nombre;
        }


        $Estado  = Tickets::ListarEstadoUpd();
        $NombreEstado = array();
        $NombreEstado[0] = 'Seleccione: ';
        foreach ($Estado as $row){
            $NombreEstado[$row->id] = $row->name;
        }


        return view('controlcambios.reporte',['NombreImpacto' => $NombreImpacto,'NombreAmbiente' => $NombreAmbiente,
                                              'NombrePlataforma' => $NombrePlataforma,'Estado' => $NombreEstado,'Categoria' => $NombreCategoria,
                                              'Usuario' => $NombreUsuario,'FechaInicio' => null,'FechaFin' => null]);
    }

    public function consultarCambios(){
        $data = Input::all();
        $reglas = array(
            'fechaInicio'   =>  'required',
            'fechaFin'      =>  'required'
        );
        $validador = Validator::make($data, $reglas);
        $messages = $validador->messages();
        foreach ($reglas as $key => $value){
            $verrors[$key] = $messages->first($key);
        }
        if($validador->passes()){
            $idImpacto      = Input::get('id_impacto');
            $idPlataforma   = Input::get('id_plataforma');
            $idAmbiente     = Input::get('id_ambiente');
            $idCategoria    = Input::get('id_categoria');
            $idUsuarioC     = Input::get('id_creador');
            $idUsuarioA     = Input::get('id_asignado');
            $idEstado       = Input::get('id_estado');
            $finicio        = Input::get('fechaInicio');
            $ffin           = Input::get('fechaFin');
            $consultaReporte = ControlCambios::Reporte($idImpacto,$idPlataforma,$idAmbiente,$idCategoria,$idUsuarioC,$idUsuarioA,$idEstado,$finicio,$ffin);

            $resultado = json_decode(json_encode($consultaReporte), true);
            foreach($resultado as &$value) {
                $value['creado'] = date('d/m/Y h:i A', strtotime($value['creado']));
                if($value['actualizado']){
                    $value['actualizado'] = date('d/m/Y h:i A', strtotime($value['actualizado']));
                }else{
                    $value['actualizado'] = 'SIN ACTUALIZACIÓN';
                }
                if($value['fecha_publicacion']){
                    $value['fecha_publicacion'] = date('d/m/Y h:i A', strtotime($value['fecha_publicacion']));
                }else{
                    $value['fecha_publicacion'] = 'SIN FECHA PUBLICACIÓN';
                }
                $id_impacto = $value['id_impacto'];
                $Impacto = ControlCambios::IdImpacto($id_impacto);
                foreach ($Impacto as $valor){
                    switch($id_impacto){
                        Case 1: $value['id_impacto'] = "<span class='label label-danger' style='font-size:13px;'><b></b>".$valor->nombre."</span>";
                                break;
                        Case 2: $value['id_impacto'] = "<span class='label label-warning' style='font-size:13px;'><b></b>".$valor->nombre."</span>";
                                break;
                        Case 3: $value['id_impacto'] = "<span class='label label-success' style='font-size:13px;'><b></b>".$valor->nombre."</span>";
                                break;
                    }
                }
                $id_categoria = $value['id_categoria'];
                $nombreCategoria = Tickets::Categoria($id_categoria);
                foreach($nombreCategoria as $valor){
                    $value['id_categoria'] = $valor->nombre;
                }
                $id_plataforma = $value['id_plataforma'];
                $nombreZonaS = ControlCambios::IdPlataforma($id_plataforma);
                foreach($nombreZonaS as $valor){
                    $value['id_plataforma'] = $valor->nombre;
                }
                $id_ambiente = $value['id_ambiente'];
                $nombreSedeS = ControlCambios::IdAmbiente($id_ambiente);
                foreach($nombreSedeS as $valor){
                    $value['id_ambiente'] = $valor->nombre;
                }

                $id_estado = $value['id_estado'];
                $nombreEstado = Tickets::Estado($id_estado);
                foreach($nombreEstado as $valor){
                    $value['id_estado'] = $valor->name;
                }
                $creado = $value['creado_por'];
                $buscarUsuario = Usuarios::BuscarNombre($creado);
                foreach($buscarUsuario as $valor){
                    $value['creado_por'] = $valor->nombre;
                }
                $asignado = $value['asignado_a'];
                $buscarUsuario = Usuarios::BuscarNombre($asignado);
                foreach($buscarUsuario as $valor){
                    $value['asignado_a'] = $valor->nombre;
                }
                $actualizado = $value['actualizado_por'];
                $buscarUsuario = Usuarios::BuscarNombre($actualizado);
                foreach($buscarUsuario as $valor){
                    $value['actualizado_por'] = $valor->nombre;
                }
                $value['nombre_solicitante'] = strtoupper($value['nombre_solicitante']);
                $id_solicitud = $value['id'];
                $value['historial'] = null;
                $historialTicket = ControlCambios::HistorialCambio($id_solicitud);
                $contadorHistorial = count($historialTicket);
                if($contadorHistorial > 0){
                    foreach($historialTicket as $row){
                        $value['historial'] .= "- ".$row->observacion." (".$row->nombre_usuario." - ".date('d/m/Y h:i a', strtotime($row->creado)).")\n";
                    }
                }else{
                    $value['historial'] = null;
                }
                $escalamiento = $value['escalamiento'];
                switch($escalamiento){
                    Case 0: $value['escalamiento'] = "SIN ESCALAMIENTO";
                            break;
                    Case 1: $value['escalamiento'] = "Sí";
                            break;
                    Case 2: $value['escalamiento'] = "No";
                            break;
                }
            }

            $aResultado = json_encode($resultado);
            \Session::put('results', $aResultado);
            if(empty($consultaReporte)){
                $verrors = array();
                array_push($verrors, 'No hay datos que mostrar');
                return \Response::json(['valido'=>'false','errors'=>$verrors]);
            }else if(!empty($aResultado)){
                return \Response::json(['valido'=>'true','results'=>$aResultado]);
            }else{
                $verrors = array();
                array_push($verrors, 'No hay datos que mostrar');
                return \Response::json(['valido'=>'false','errors'=>$verrors]);
            }

        }else{
            return \Response::json(['valido'=>'false','errors'=>$verrors]);
        }
    }

    public function reabrirsolicitud(){
        $data = Input::all();
        $reglas = array(
            'id_solicitud'          =>  'required',
            'descripcion_solicitudCC' =>  'required',
            'id_categoriaCC'        => 'required',
            'id_usuarioCC'          => 'required',
            'id_impactoCC'          => 'required',
            'id_estadoCC'           => 'required'
        );
        $validador = Validator::make($data, $reglas);
        $messages = $validador->messages();
        foreach ($reglas as $key => $value){
            $verrors[$key] = $messages->first($key);
        }
        if($validador->passes()) {
            $idSolicitud = Input::get('id_solicitud');
            $busqueda = ControlCambios::BuscarSolicitud($idSolicitud);
            if($busqueda){

                $desrcipcion = Input::get('descripcion_solicitudCC');
                $idCategoria = Input::get('id_categoriaCC');
                $idUsuario = Input::get('id_usuarioCC');
                $idImpacto = Input::get('id_impactoCC');
                $idEstado = Input::get('id_estadoCC');
                $User = Session::get('IdUsuario');

                $aperturaTicket = ControlCambios::Apertura($idSolicitud,$idCategoria,$idUsuario,$idImpacto,$idEstado,$User,$desrcipcion);

                if($aperturaTicket){
                    $verrors = 'Se actualizo con éxito la solicitud '.$idSolicitud;
                    return redirect('admin/controlCambios')->with('mensaje', $verrors);
                }else{
                    $verrors = array();
                    array_push($verrors, 'Hubo un problema al reabrir la solicitud');
                    return \Redirect::to('admin/controlCambios')->withErrors(['errors' => $verrors])->withInput();
                }

            }else{

                $verrors = array();
                array_push($verrors, 'No se encontro información de la solicitud '.$idSolicitud);
                return \Redirect::to('admin/controlCambios')->withErrors(['errors' => $verrors])->withInput();

            }

        }else{
            return \Redirect::to('admin/controlCambios')->withErrors(['errors' => $verrors])->withInput();
        }
    }
}
