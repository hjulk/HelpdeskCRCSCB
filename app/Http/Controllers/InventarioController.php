<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\Admin\Sedes;
use App\Models\Helpdesk\Tickets;
use Illuminate\Support\Facades\Validator;
use App\Models\HelpDesk\Inventario;
use App\Models\Admin\Usuarios;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Illuminate\Support\Facades\Redirect;

class InventarioController extends Controller
{

    public function BuscarURL($Administrador){
        if($Administrador === 1){
            return 'admin';
        }else{
            return 'user';
        }
    }

    public function asignacionEquipoMovil(){
        $data = Input::all();
        $creadoPor          = (int)Session::get('IdUsuario');
        $buscarUsuario = Usuarios::BuscarNombre($creadoPor);
        foreach($buscarUsuario as $value){
            $Administrador = (int)$value->rol_id;
        }
        $url = InventarioController::BuscarURL($Administrador);
        $reglas = array(
            'tipo_equipo'       =>  'required',
            'fecha_adquision'   =>  'required',
            'serial'            =>  'required',
            'marca'             =>  'required',
            'modelo'            =>  'required',
            'imei'              =>  'required',
            'capacidad'         =>  'required',
            'linea_movil'       =>  'required',
            'area'              =>  'required',
            'nombre_asignado'   =>  'required',
            'estado'            =>  'required'
        );
        $validador = Validator::make($data, $reglas);
        $messages = $validador->messages();
        foreach ($reglas as $key => $value){
            $verrors[$key] = $messages->first($key);
        }
        if($validador->passes()) {
            $TipoEquipo         = Input::get('tipo_equipo');
            $FechaAdquisicion   = date('Y-m-d H:i:s', strtotime(Input::get('fecha_adquision')));
            $Serial             = Input::get('serial');
            $Marca              = Input::get('marca');
            $Modelo             = Input::get('modelo');
            $IMEI               = Input::get('imei');
            $Capacidad          = Input::get('capacidad');
            $LineaMovil         = Input::get('linea_movil');
            $Area               = Input::get('area');
            $NombreAsignado     = Input::get('nombre_asignado');
            $EstadoEquipo       = Input::get('estado');

            $RegistrarEquipo    = Inventario::RegistrarEquipoMovil($TipoEquipo,$FechaAdquisicion,$Serial,$Marca,$Modelo,$IMEI,
                                                                    $Capacidad,$LineaMovil,$Area,$NombreAsignado,$EstadoEquipo,$creadoPor);
            if($RegistrarEquipo){
                $BuscarUltimo = Inventario::BuscarLastEquipoMovil($creadoPor);
                foreach($BuscarUltimo as $row){
                    $idEquipoMovil = $row->id;
                }
                Inventario::RegistrarAsignadoEM($TipoEquipo,$idEquipoMovil,$Area,$NombreAsignado,$EstadoEquipo,$creadoPor);
                $destinationPath = null;
                $filename        = null;
                if (Input::hasFile('evidencia')) {
                    $files = Input::file('evidencia');
                    foreach($files as $file){
                        $destinationPath    = public_path().'/assets/dist/img/evidencias_inventario';
                        $extension          = $file->getClientOriginalExtension();
                        $name               = $file->getClientOriginalName();
                        $nombrearchivo      = pathinfo($name, PATHINFO_FILENAME);
                        $nombrearchivo      = TicketsController::eliminar_tildes($nombrearchivo);
                        $filename           = $nombrearchivo.'_Equipo Movil_'.$idEquipoMovil.'.'.$extension;
                        $uploadSuccess      = $file->move($destinationPath, $filename);
                        $archivofoto        = file_get_contents($uploadSuccess);
                        $NombreFoto         = $filename;
                        $actualizarEvidencia = Inventario::EvidenciaEM($idEquipoMovil,$NombreFoto);
                    }
                }
                $verrors = 'Se registro con éxito el equipo '.$Marca.'- '.$Modelo;
                return redirect($url.'/mobile')->with('mensaje', $verrors);
            }else{
                $verrors = array();
                array_push($verrors, 'Hubo un problema al registrar el equipo');
                return Redirect::to($url.'/mobile')->withErrors(['errors' => $verrors])->withInput();
            }
        }else{
            return Redirect::to($url.'/mobile')->withErrors(['errors' => $verrors])->withInput();
        }
    }

    public function actualizacionEquipoMovil(){
        dd('hola');
    }
}
