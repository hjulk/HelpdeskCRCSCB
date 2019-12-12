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
            $NombreActivo[$row->id] = $row->nombre;
        }

        foreach($Roles as $value){
            $RolIndex[$contR]['id'] = $value->id;
            $RolIndex[$contR]['nombre'] = $value->nombre;
            $idactivo = $value->activo;
            $RolIndex[$contR]['id_activo'] = $value->activo;
            $nombreActivoS = Usuarios::ActivoID($idactivo);
            foreach($nombreActivoS as $valor){
                $RolIndex[$contR]['activo'] = $valor->nombre;
            }
            $contR++;
        }
        foreach($Categoria as $value){
            $CategoriaIndex[$contC]['id'] = $value->id;
            $CategoriaIndex[$contC]['nombre'] = $value->nombre;
            $idactivo = $value->activo;
            $CategoriaIndex[$contC]['id_activo'] = $value->activo;
            $nombreActivoS = Usuarios::ActivoID($idactivo);
            foreach($nombreActivoS as $valor){
                $CategoriaIndex[$contC]['activo'] = $valor->nombre;
            }
            $contC++;
        }

        return view('admin.roles',['Roles' => $RolIndex, 'Categorias' => $CategoriaIndex,'Activo' => $NombreActivo,
                                    'RolName' => null,'CategoriaName' => null]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crearRol()
    {
        $data = Input::all();
        $reglas = array(
            'rol'    =>  'required'
        );
        $validador = Validator::make($data, $reglas);
        $messages = $validador->messages();
        foreach ($reglas as $key => $value){
            $verrors[$key] = $messages->first($key);
        }
        if($validador->passes()) {
            $nombreRol = Input::get('rol');
            $busquedaNombre = Roles::BuscarNombreRol($nombreRol);
            if($busquedaNombre){
                $verrors = array();
                array_push($verrors, 'El nombre de rol '.$nombreRol.', ya se encuentra en la base de datos');
                // return redirect('admin/roles')->withErrors(['errors' => $verrors]);
                return \Redirect::to('admin/roles')->withErrors(['errors' => $verrors])->withInput();
            }else{
                $crearRol = Roles::CrearRol($nombreRol);
                if($crearRol){
                    $verrors = 'Se creo con éxito el rol '.$nombreRol;
                    return redirect('admin/roles')->with('mensaje', $verrors);
                }else{
                    $verrors = array();
                    array_push($verrors, 'Hubo un problema al crear el rol');
                    // return redirect('admin/roles')->withErrors(['errors' => $verrors]);
                    return \Redirect::to('admin/roles')->withErrors(['errors' => $verrors])->withInput();
                }
            }
        }else{
            // return redirect('admin/roles')->withErrors(['errors' => $verrors]);
            return \Redirect::to('admin/roles')->withErrors(['errors' => $verrors])->withInput();
        }
    }

    public function actualizarRol()
    {
        $data = Input::all();
        $reglas = array(
            'rol'           =>  'required',
            'id_activo'    =>  'required'
        );
        $validador = Validator::make($data, $reglas);
        $messages = $validador->messages();
        foreach ($reglas as $key => $value){
            $verrors[$key] = $messages->first($key);
        }
        if($validador->passes()) {
            $id         = Input::get('idR');
            $nombreRol  = Input::get('rol');
            $idactivo   = Input::get('id_activo');
            $ActualizarRol = Roles::ActualizarRol($id,$nombreRol,$idactivo);
            if($ActualizarRol){
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
            'categoria'    =>  'required'
        );
        $validador = Validator::make($data, $reglas);
        $messages = $validador->messages();
        foreach ($reglas as $key => $value){
            $verrors[$key] = $messages->first($key);
        }
        if($validador->passes()) {
            $nombreCategoria = Input::get('categoria');
            $busquedaNombre = Roles::BuscarNombreCategoria($nombreCategoria);
            if($busquedaNombre){
                $verrors = array();
                array_push($verrors, 'El nombre de la categoria '.$nombreCategoria.', ya se encuentra en la base de datos');
                // return redirect('admin/roles')->withErrors(['errors' => $verrors]);
                return \Redirect::to('admin/roles')->withErrors(['errors' => $verrors])->withInput();
            }else{
                $crearCategoria = Roles::CrearCategoria($nombreCategoria);
                if($crearCategoria){
                    $verrors = 'Se creo con éxito el rol '.$nombreCategoria;
                    return redirect('admin/roles')->with('mensaje', $verrors);
                }else{
                    $verrors = array();
                    array_push($verrors, 'Hubo un problema al crear la categoria');
                    // return redirect('admin/roles')->withErrors(['errors' => $verrors]);
                    return \Redirect::to('admin/roles')->withErrors(['errors' => $verrors])->withInput();
                }
            }
        }else{
            // return redirect('admin/roles')->withErrors(['errors' => $verrors]);
            return \Redirect::to('admin/roles')->withErrors(['errors' => $verrors])->withInput();
        }
    }

    public function actualizarCategoria()
    {
        $data = Input::all();
        $reglas = array(
            'categoria'    =>  'required',
            'id_activo'    =>  'required'
        );
        $validador = Validator::make($data, $reglas);
        $messages = $validador->messages();
        foreach ($reglas as $key => $value){
            $verrors[$key] = $messages->first($key);
        }
        if($validador->passes()) {
            $id                 = Input::get('idC');
            $nombreCategoria    = Input::get('categoria');
            $idactivo           = Input::get('id_activo');
            $ActualizarCategoria = Roles::ActualizarCategoria($id,$nombreCategoria,$idactivo);
            if($ActualizarCategoria){
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function show(Roles $roles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function edit(Roles $roles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Roles $roles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function destroy(Roles $roles)
    {
        //
    }
}
