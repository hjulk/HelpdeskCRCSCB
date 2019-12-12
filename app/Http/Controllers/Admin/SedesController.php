<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\Admin\Sedes;
use App\Http\Requests\Validaciones;
use Validator;
use Monolog\Handler\ZendMonitorHandler;
use App\Http\Middleware\VerifyCsrfToken;
use App\Models\Admin\Activo;

class SedesController extends Controller
{

    public function sedes()
    {
        $Zonas = Sedes::Zonas();
        $Sedes = Sedes::Sedes();
        $Areas = Sedes::Areas();
        $ZonasIndex = array();
        $SedesIndex = array();
        $AreasIndex = array();
        $contS = 0;
        $contA = 0;
        $contZ = 0;
        foreach($Sedes as $value){
            $SedesIndex[$contS]['id'] = $value->id;
            $SedesIndex[$contS]['nombre'] = $value->nombre;
            $SedesIndex[$contS]['direccion'] = $value->direccion;
            $idzona = $value->id_zona;
            $nombreZonaS = Sedes::BuscarZonaID($idzona);
            foreach($nombreZonaS as $valor){
                $SedesIndex[$contS]['zona'] = $valor->nombre;
            }
            if($value->activa === 1){
                $SedesIndex[$contS]['activa'] = 'Sí';
            }else{
                $SedesIndex[$contS]['activa'] = 'No';
            }
            $SedesIndex[$contS]['id_zona'] = $value->id_zona;
            $SedesIndex[$contS]['id_activa'] = $value->activa;
            $contS++;
        }
        foreach($Zonas as $value){
            $ZonasIndex[$contZ]['id'] = $value->id;
            $ZonasIndex[$contZ]['nombre'] = $value->nombre;
            if($value->activa === 1){
                $ZonasIndex[$contZ]['activa'] = 'Sí';
            }else{
                $ZonasIndex[$contZ]['activa'] = 'No';
            }
            $ZonasIndex[$contZ]['id_activa'] = $value->activa;
            $ZonasIndex[$contZ]['editar'] = $value->id;
            $contZ++;
        }
        foreach($Areas as $value){
            $AreasIndex[$contA]['id'] = $value->id;
            $AreasIndex[$contA]['nombre'] = $value->nombre;

            if($value->activa === 1){
                $AreasIndex[$contA]['activa'] = 'Sí';
            }else{
                $AreasIndex[$contA]['activa'] = 'No';
            }

            $AreasIndex[$contA]['id_activa'] = $value->activa;
            $contA++;
        }
        // dd($AreasIndex);
        $NombreZona = array();
        $NombreZona[''] = 'Seleccione: ';
        foreach ($Zonas as $row){
            $NombreZona[$row->id] = $row->nombre;
        }



        $Activo = Activo::activo();
        $NombreActivo = array();
        $NombreActivo[''] = 'Seleccione: ';
        foreach ($Activo as $row){
            $NombreActivo[$row->id] = $row->nombre;
        }

        $NombreSede = array();
        $NombreSede[''] = 'Seleccione: ';

        return view('admin.sedes',['Zonas' => $ZonasIndex,'Sedes' => $SedesIndex,'Areas' => $AreasIndex,'NombreZona' => $NombreZona,'NombreSede' => $NombreSede,
                                    'activo' => $NombreActivo,'Zona' => null, 'Sede' => null, 'Area' => null]);
    }

    public function crearZona(){
        $data = Input::all();
        $reglas = array(
            'zona' => 'required'
        );
        $validador = Validator::make($data, $reglas);
        $messages = $validador->messages();
        foreach ($reglas as $key => $value){
            $verrors[$key] = $messages->first($key);
        }
        if($validador->passes()) {
            $Zona    = Input::get('zona');
            $consultarZona = Sedes::BuscarZona($Zona);

            if($consultarZona){
                $verrors = array();
                array_push($verrors, 'Nombre de zona ya se encuentra creada');
                // return redirect('admin/sedes')->withErrors(['errors' => $verrors]);
                return \Redirect::to('admin/sedes')->withErrors(['errors' => $verrors])->withInput();
            }else{

                $InsertarZona = Sedes::CrearZona($Zona);
                if($InsertarZona){
                    $verrors = 'Se creo con éxito la zona '.$Zona;
                    return redirect('admin/sedes')->with('mensaje', $verrors);
                }else{
                    $verrors = array();
                    array_push($verrors, 'Hubo un problema al crear la zona');
                    // return redirect('admin/sedes')->withErrors(['errors' => $verrors]);
                    return \Redirect::to('admin/sedes')->withErrors(['errors' => $verrors])->withInput();

                }
            }
        }else{

            // return redirect('admin/sedes')->withErrors(['errors' => $verrors]);
            return \Redirect::to('admin/sedes')->withErrors(['errors' => $verrors])->withInput();
        }
    }

    public function crearSede(){
        $data = Input::all();
        $reglas = array(
            'sede'      =>  'required',
            'tipoZona'  =>  'required',
            'direccionSede' =>  'required'
        );
        $validador = Validator::make($data, $reglas);
        $messages = $validador->messages();
        foreach ($reglas as $key => $value){
            $verrors[$key] = $messages->first($key);
        }
        if($validador->passes()) {
            $Sede       = Input::get('sede');
            $Direccion  = Input::get('direccionSede');
            $Zona       = Input::get('tipoZona');
            $consultarSede = Sedes::BuscarSede($Sede);

            if($consultarSede){
                $verrors = array();
                array_push($verrors, 'Nombre de la sede ya se encuentra creada');
                // return redirect('admin/sedes')->withErrors(['errors' => $verrors]);
                return \Redirect::to('admin/sedes')->withErrors(['errors' => $verrors])->withInput();
            }else{

                $InsertarSede = Sedes::CrearSede($Sede,$Direccion,$Zona);
                if($InsertarSede){
                    $verrors = 'Se creo con éxito la sede '.$Sede;
                    return redirect('admin/sedes')->with('mensaje', $verrors);
                }else{
                    $verrors = array();
                    array_push($verrors, 'Hubo un problema al crear la sede');
                    // return redirect('admin/sedes')->withErrors(['errors' => $verrors]);
                    return \Redirect::to('admin/sedes')->withErrors(['errors' => $verrors])->withInput();
                }
            }
        }else{
            // return redirect('admin/sedes')->withErrors(['errors' => $verrors]);
            return \Redirect::to('admin/sedes')->withErrors(['errors' => $verrors])->withInput();
        }
    }

    public function crearArea(){
        $data = Input::all();
        $reglas = array(
            'area'          =>  'required'

        );
        $validador = Validator::make($data, $reglas);
        $messages = $validador->messages();
        foreach ($reglas as $key => $value){
            $verrors[$key] = $messages->first($key);
        }
        if($validador->passes()) {
            $Area    = Input::get('area');
            $Zona    = Input::get('tipoZonaArea');
            $Sede    = (int)Input::get('id_sede');
            $consultarZona = Sedes::BuscarZonaID($Zona);
            foreach($consultarZona as $valor){
                $nombreZona = $valor->nombre;
            }
            $consultarArea = Sedes::BuscarArea($Area);

            $consultarSede = Sedes::BuscarSedeID($Sede);
            foreach($consultarSede as $valor){
                $nombreSede = $valor->nombre;
            }
            if($consultarArea){
                $verrors = array();
                array_push($verrors, 'Nombre de Area ya se encuentra creada');
                // return redirect('admin/sedes')->withErrors(['errors' => $verrors]);
                return \Redirect::to('admin/sedes')->withErrors(['errors' => $verrors])->withInput();
            }else{

                $InsertarArea = Sedes::CrearArea($Area);
                if($InsertarArea){
                    $verrors = 'Se creo con éxito el área '.$Area;
                    return redirect('admin/sedes')->with('mensaje', $verrors);
                }else{
                    $verrors = array();
                    array_push($verrors, 'Hubo un problema al crear el area');
                    // return redirect('admin/sedes')->withErrors(['errors' => $verrors]);
                    return \Redirect::to('admin/sedes')->withErrors(['errors' => $verrors])->withInput();
                }
            }

        }else{
            // return redirect('admin/sedes')->withErrors(['errors' => $verrors]);
            return \Redirect::to('admin/sedes')->withErrors(['errors' => $verrors])->withInput();
        }
    }

    public function actualizarZona(){

        $data = Input::all();
        $reglas = array(
            'zona'      => 'required',
            'id_activa' => 'required'
        );
        $validador = Validator::make($data, $reglas);
        $messages = $validador->messages();
        foreach ($reglas as $key => $value){
            $verrors[$key] = $messages->first($key);
        }
        if($validador->passes()) {
            $id     = (int)Input::get('idZ');
            $nombre = Input::get('zona');
            $activo = (int)Input::get('id_activa');
            $actualizarZona = Sedes::ActualizarZona($id,$nombre,$activo);
            if($actualizarZona){
                $verrors = 'Se actualizo con éxito la zona '.$nombre;
                return redirect('admin/sedes')->with('mensaje', $verrors);
            }else{
                $verrors = array();
                array_push($verrors, 'Hubo un problema al actualizar la zona');
                return redirect('admin/sedes')->withErrors(['errors' => $verrors]);
            }
        }else{
            return redirect('admin/sedes')->withErrors(['errors' => $verrors]);
        }

    }

    public function actualizarSede(){

        $data = Input::all();
        $reglas = array(
            'sede'          =>  'required',
            'id_zona'       =>  'required',
            'direccionSede' =>  'required',
            'id_activa'     => 'required'
        );
        $validador = Validator::make($data, $reglas);
        $messages = $validador->messages();
        foreach ($reglas as $key => $value){
            $verrors[$key] = $messages->first($key);
        }
        if($validador->passes()) {
            $id         = (int)Input::get('idS');
            $nombre     = Input::get('sede');
            $direccion  = Input::get('direccionSede');
            $activo     = (int)Input::get('id_activa');
            $actualizarSede = Sedes::ActualizarSede($id,$nombre,$direccion,$activo);
            if($actualizarSede){
                $verrors = 'Se actualizo con éxito la sede '.$nombre;
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

    public function actualizarArea(){
        $data = Input::all();
        $reglas = array(
            'area'          =>  'required'
        );
        $validador = Validator::make($data, $reglas);
        $messages = $validador->messages();
        foreach ($reglas as $key => $value){
            $verrors[$key] = $messages->first($key);
        }
        if($validador->passes()) {
            $id     = (int)Input::get('idA');
            $nombre = Input::get('area');

            $activo = (int)Input::get('id_activa');

                $actualizarSede = Sedes::ActualizarArea($id,$nombre,$activo);
                if($actualizarSede){
                    $verrors = 'Se actualizo con éxito el área '.$nombre;
                    return redirect('admin/sedes')->with('mensaje', $verrors);
                }else{
                    $verrors = array();
                    array_push($verrors, 'Hubo un problema al actualizar el aéra');
                    return redirect('admin/sedes')->withErrors(['errors' => $verrors]);
                }


        }else{
            return redirect('admin/sedes')->withErrors(['errors' => $verrors]);
        }
    }



}
