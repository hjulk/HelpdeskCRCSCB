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
        $Sedes = Sedes::Sedes();
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
        $Activo     = Usuarios::Activo();
        $NombreActivo = array();
        $NombreActivo[''] = 'Seleccione: ';
        foreach ($Activo as $row){
            $NombreActivo[$row->id] = $row->name;
        }

        $NombreSede = array();
        $NombreSede[''] = 'Seleccione: ';

        return view('admin.sedes',['Sedes' => $SedesIndex,'NombreSede' => $NombreSede,'Sede' => null,
                                    'Descripcion' => null,'Activo' => $NombreActivo]);
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
            if($actualizarSede){
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

}
