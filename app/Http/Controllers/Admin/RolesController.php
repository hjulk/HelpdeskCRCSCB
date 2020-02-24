<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Roles;
use App\Models\Admin\Usuarios;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Http\Requests\Validaciones;
use Validator;
use Monolog\Handler\ZendMonitorHandler;
use App\Http\Middleware\VerifyCsrfToken;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function roles()
    {
        $Roles      = Roles::ListarRoles();
        $Categoria  = Roles::ListarCategorias();
        $RolIndex = array();
        $CategoriaIndex = array();
        $contR = 0;
        $contC = 0;
        $Activo     = Usuarios::Activo();
        $NombreActivo = array();
        $NombreActivo[''] = 'Seleccione: ';
        foreach ($Activo as $row){
            $NombreActivo[$row->id] = $row->name;
        }

        foreach($Roles as $value){
            $RolIndex[$contR]['id'] = $value->rol_id;
            $RolIndex[$contR]['name'] = $value->name;
            $RolIndex[$contR]['activoR'] = $value->activo;
            $idactivo = $value->activo;
            $nombreActivoS = Usuarios::ActivoID($idactivo);
            foreach($nombreActivoS as $valor){
                $RolIndex[$contR]['activo'] = $valor->name;
            }
            $contR++;
        }
        foreach($Categoria as $value){
            $CategoriaIndex[$contC]['id'] = $value->id;
            $CategoriaIndex[$contC]['name'] = $value->name;
            $CategoriaIndex[$contC]['activoC'] = $value->activo;
            $idactivo = $value->activo;
            $nombreActivoS = Usuarios::ActivoID($idactivo);
            foreach($nombreActivoS as $valor){
                $CategoriaIndex[$contC]['activo'] = $valor->name;
            }
            $contC++;
        }

        return view('admin.roles',['Roles' => $RolIndex, 'Categorias' => $CategoriaIndex,'Activo' => $NombreActivo,
                                    'RolName' => null,'CategoriaName' => null]);
    }

    public function crearRol()
    {
        $data = Input::all();
        $reglas = array(
            'nombre_rol'    =>  'required'
        );
        $validador = Validator::make($data, $reglas);
        $messages = $validador->messages();
        foreach ($reglas as $key => $value){
            $verrors[$key] = $messages->first($key);
        }
        if($validador->passes()) {
            $nombreRol = Input::get('nombre_rol');
            $busquedaNombre = Roles::BuscarNombreRol($nombreRol);
            if($busquedaNombre){
                $verrors = array();
                array_push($verrors, 'El nombre de rol '.$nombreRol.', ya se encuentra en la base de datos');
                // return redirect('admin/roles')->withErrors(['errors' => $verrors]);
                return Redirect::to('admin/roles')->withErrors(['errors' => $verrors])->withInput();
            }else{
                $crearRol = Roles::CrearRol($nombreRol);
                if($crearRol){
                    $verrors = 'Se creo con éxito el rol '.$nombreRol;
                    return redirect('admin/roles')->with('mensaje', $verrors);
                }else{
                    $verrors = array();
                    array_push($verrors, 'Hubo un problema al crear el rol');
                    // return redirect('admin/roles')->withErrors(['errors' => $verrors]);
                    return Redirect::to('admin/roles')->withErrors(['errors' => $verrors])->withInput();
                }
            }
        }else{
            // return redirect('admin/roles')->withErrors(['errors' => $verrors]);
            return Redirect::to('admin/roles')->withErrors(['errors' => $verrors])->withInput();
        }
    }

    public function actualizarRol()
    {
        $data = Input::all();
        $reglas = array(
            'nombre_rol_upd'    =>  'required',
            'id_activoR'        =>  'required'
        );
        $validador = Validator::make($data, $reglas);
        $messages = $validador->messages();
        foreach ($reglas as $key => $value){
            $verrors[$key] = $messages->first($key);
        }
        if($validador->passes()) {
            $id         = Input::get('idR');
            $nombreRol  = Input::get('nombre_rol_upd');
            $idactivo   = Input::get('id_activoR');
            $ActualizarRol = Roles::ActualizarRol($id,$nombreRol,$idactivo);
            if($ActualizarRol >= 0){
                $verrors = 'Se actualizo con éxito el rol '.$nombreRol;
                return redirect('admin/roles')->with('mensaje', $verrors);
            }else{
                $verrors = array();
                array_push($verrors, 'Hubo un problema al actualizar el rol');
                return redirect('admin/roles')->withErrors(['errors' => $verrors]);
            }

        }else{
            return redirect('admin/roles')->withErrors(['errors' => $verrors]);
        }
    }

    public function crearCategoria()
    {
        $data = Input::all();
        $reglas = array(
            'nombre_categoria'    =>  'required'
        );
        $validador = Validator::make($data, $reglas);
        $messages = $validador->messages();
        foreach ($reglas as $key => $value){
            $verrors[$key] = $messages->first($key);
        }
        if($validador->passes()) {
            $nombreCategoria = Input::get('nombre_categoria');
            $busquedaNombre = Roles::BuscarNombreCategoria($nombreCategoria);
            if($busquedaNombre){
                $verrors = array();
                array_push($verrors, 'El nombre de la categoria '.$nombreCategoria.', ya se encuentra en la base de datos');
                // return redirect('admin/roles')->withErrors(['errors' => $verrors]);
                return Redirect::to('admin/roles')->withErrors(['errors' => $verrors])->withInput();
            }else{
                $crearCategoria = Roles::CrearCategoria($nombreCategoria);
                if($crearCategoria){
                    $verrors = 'Se creo con éxito el rol '.$nombreCategoria;
                    return redirect('admin/roles')->with('mensaje', $verrors);
                }else{
                    $verrors = array();
                    array_push($verrors, 'Hubo un problema al crear la categoria');
                    // return redirect('admin/roles')->withErrors(['errors' => $verrors]);
                    return Redirect::to('admin/roles')->withErrors(['errors' => $verrors])->withInput();
                }
            }
        }else{
            // return redirect('admin/roles')->withErrors(['errors' => $verrors]);
            return Redirect::to('admin/roles')->withErrors(['errors' => $verrors])->withInput();
        }
    }

    public function actualizarCategoria()
    {
        $data = Input::all();
        $reglas = array(
            'nombre_categoria_upd'    =>  'required',
            'id_activoC'        =>  'required'
        );
        $validador = Validator::make($data, $reglas);
        $messages = $validador->messages();
        foreach ($reglas as $key => $value){
            $verrors[$key] = $messages->first($key);
        }
        if($validador->passes()) {
            $id                 = Input::get('idC');
            $nombreCategoria    = Input::get('nombre_categoria_upd');
            $idactivo           = Input::get('id_activoC');
            $ActualizarCategoria = Roles::ActualizarCategoria($id,$nombreCategoria,$idactivo);
            if($ActualizarCategoria >= 0){
                $verrors = 'Se actualizo con éxito la categoria '.$nombreCategoria;
                return redirect('admin/roles')->with('mensaje', $verrors);
            }else{
                $verrors = array();
                array_push($verrors, 'Hubo un problema al actualizar el rol');
                return redirect('admin/roles')->withErrors(['errors' => $verrors]);
            }

        }else{
            return redirect('admin/roles')->withErrors(['errors' => $verrors]);
        }
    }


}
