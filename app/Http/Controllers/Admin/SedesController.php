<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\Admin\Sedes;
use App\Http\Requests\Validaciones;
use Validator;
use App\Models\Admin\Usuarios;
use Monolog\Handler\ZendMonitorHandler;
use App\Http\Middleware\VerifyCsrfToken;
use App\Models\Admin\Activo;
use Illuminate\Support\Facades\Redirect;

class SedesController extends Controller
{

    public function sedes()
    {
        $Sedes      = Sedes::Sedes();
        $SedesA     = Sedes::SedesA();
        $SedesIndex = array();
        $contS = 0;
        foreach($Sedes as $value){
            $SedesIndex[$contS]['id'] = $value->id;
            $SedesIndex[$contS]['name'] = $value->name;
            $SedesIndex[$contS]['description'] = $value->description;
            $SedesIndex[$contS]['activo'] = $value->activo;
            $idactivo = $value->activo;
            $nombreActivoS = Usuarios::ActivoID($idactivo);
            foreach($nombreActivoS as $valor){
                $SedesIndex[$contS]['name_activo'] = $valor->name;
            }
            $contS++;
        }

        $Areas = Sedes::Areas();
        $AreasIndex = array();
        $contA = 0;
        foreach($Areas as $value){
            $AreasIndex[$contA]['id']           = (int)$value->id;
            $AreasIndex[$contA]['nombre']       = $value->name;
            $AreasIndex[$contA]['project_id']   = (int)$value->project_id;
            $AreasIndex[$contA]['activo']       = (int)$value->activo;
            $idactivo                           = (int)$value->activo;
            $nombreActivoS = Usuarios::ActivoID($idactivo);
            foreach($nombreActivoS as $rowA){
                $AreasIndex[$contA]['name_activo'] = $rowA->name;
            }
            $idsede                             = (int)$value->project_id;
            $Sede           = Sedes::BuscarSedeID($idsede);
            foreach($Sede as $rowS){
                $AreasIndex[$contA]['sede'] = $rowS->name;
            }
            $contA++;
        }

        $Activo     = Usuarios::Activo();
        $NombreActivo = array();
        $NombreActivo[''] = 'Seleccione: ';
        foreach ($Activo as $row){
            $NombreActivo[$row->id] = $row->name;
        }

        $NombreSede = array();
        $NombreSede[''] = 'Seleccione: ';
        foreach($Sedes as $row){
            $NombreSede[$row->id] = $row->name;
        }

        return view('admin.sedes',['Sedes' => $SedesIndex,'NombreSede' => $NombreSede,'Sede' => null,
                                    'Descripcion' => null,'Activo' => $NombreActivo,'Areas' => $AreasIndex]);
    }

    public function crearSede(){
        $data = Input::all();
        $reglas = array(
            'nombre'        =>  'required',
            'descripcion'   =>  'required'
        );
        $validador = Validator::make($data, $reglas);
        $messages = $validador->messages();
        foreach ($reglas as $key => $value){
            $verrors[$key] = $messages->first($key);
        }
        if($validador->passes()) {
            $Sede           = Input::get('nombre');
            $Descripcion    = Input::get('descripcion');
            $consultarSede  = Sedes::BuscarSede($Sede);

            if($consultarSede){
                $verrors = array();
                array_push($verrors, 'Nombre de la sede ya se encuentra creada');
                return Redirect::to('admin/sedes')->withErrors(['errors' => $verrors])->withInput();
            }else{

                $InsertarSede = Sedes::CrearSede($Sede,$Descripcion);
                if($InsertarSede){
                    $verrors = 'Se creo con éxito la sede '.$Sede;
                    return redirect('admin/sedes')->with('mensaje', $verrors);
                }else{
                    $verrors = array();
                    array_push($verrors, 'Hubo un problema al crear la sede');
                    // return redirect('admin/sedes')->withErrors(['errors' => $verrors]);
                    return Redirect::to('admin/sedes')->withErrors(['errors' => $verrors])->withInput();
                }
            }
        }else{
            // return redirect('admin/sedes')->withErrors(['errors' => $verrors]);
            return Redirect::to('admin/sedes')->withErrors(['errors' => $verrors])->withInput();
        }
    }

    public function actualizarSede(){

        $data = Input::all();
        $reglas = array(
            'nombre_upd'        =>  'required',
            'descripcion_upd'   =>  'required',
            'activo'            =>  'required'
        );
        $validador = Validator::make($data, $reglas);
        $messages = $validador->messages();
        foreach ($reglas as $key => $value){
            $verrors[$key] = $messages->first($key);
        }
        if($validador->passes()) {
            $id             = (int)Input::get('idS');
            $Sede           = Input::get('nombre_upd');
            $Descripcion    = Input::get('descripcion_upd');
            $idActivo       = Input::get('activo');
            $actualizarSede = Sedes::ActualizarSede($id,$Sede,$Descripcion,$idActivo);
            if($actualizarSede >= 0){
                $verrors = 'Se actualizo con éxito la sede '.$Sede;
                return redirect('admin/sedes')->with('mensaje', $verrors);
            }else{
                $verrors = array();
                array_push($verrors, 'Hubo un problema al actualizar la sede');
                return redirect('admin/sedes')->withErrors(['errors' => $verrors]);
            }
        }else{
            return redirect('admin/sedes')->withErrors(['errors' => $verrors]);
        }

    }

    public function crearArea(){
        $data = Input::all();
        $reglas = array(
            'nombre_area'   =>  'required',
            'sede'          =>  'required'
        );
        $validador = Validator::make($data, $reglas);
        $messages = $validador->messages();
        foreach ($reglas as $key => $value){
            $verrors[$key] = $messages->first($key);
        }
        if($validador->passes()) {
            $Area           = Input::get('nombre_area');
            $Sede           = (int)Input::get('sede');
            $consultarArea  = Sedes::BuscarArea($Area);

            if($consultarArea){
                $verrors = array();
                array_push($verrors, 'Nombre del área ya se encuentra creada');
                return Redirect::to('admin/sedes')->withErrors(['errors' => $verrors])->withInput();
            }else{

                $InsertarArea = Sedes::CrearArea($Area,$Sede);
                if($InsertarArea){
                    $verrors = 'Se creo con éxito el(la) área '.$Area;
                    return redirect('admin/sedes')->with('mensaje', $verrors);
                }else{
                    $verrors = array();
                    array_push($verrors, 'Hubo un problema al crear el(la) área');
                    // return redirect('admin/sedes')->withErrors(['errors' => $verrors]);
                    return Redirect::to('admin/sedes')->withErrors(['errors' => $verrors])->withInput();
                }
            }
        }else{
            // return redirect('admin/sedes')->withErrors(['errors' => $verrors]);
            return Redirect::to('admin/sedes')->withErrors(['errors' => $verrors])->withInput();
        }
    }

    public function actualizarArea(){
        $data = Input::all();
        $reglas = array(
            'nombre_area_upd'   =>  'required',
            'sede_upd'          =>  'required',
            'activo_area'       =>  'required'
        );
        $validador = Validator::make($data, $reglas);
        $messages = $validador->messages();
        foreach ($reglas as $key => $value){
            $verrors[$key] = $messages->first($key);
        }
        if($validador->passes()) {
            $id             = (int)Input::get('idA');
            $Area           = Input::get('nombre_area_upd');
            $Sede           = (int)Input::get('sede_upd');
            $idActivo       = (int)Input::get('activo_area');
            $ActualizarArea = Sedes::ActualizarArea($id,$Area,$Sede,$idActivo);
            if($ActualizarArea >= 0){
                $verrors = 'Se actualizo con éxito el(la) área '.$Area;
                return redirect('admin/sedes')->with('mensaje', $verrors);
            }else{
                $verrors = array();
                array_push($verrors, 'Hubo un problema al actualizar el(la) área');
                return redirect('admin/sedes')->withErrors(['errors' => $verrors]);
            }
        }else{
            return redirect('admin/sedes')->withErrors(['errors' => $verrors]);
        }
    }

}
