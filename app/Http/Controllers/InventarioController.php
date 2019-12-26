<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Models\HelpDesk\Inventario;
use App\Models\Admin\Usuarios;
use Illuminate\Support\Facades\Session;
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
        $EstadoEquipo       = (int)Input::get('estado');
        if($EstadoEquipo === 2){
            $reglas = array(
                'tipo_equipo'       =>  'required',
                'fecha_adquision'   =>  'required',
                'serial'            =>  'required',
                'marca'             =>  'required',
                'modelo'            =>  'required',
                'imei'              =>  'required',
                'capacidad'         =>  'required',
                'estado'            =>  'required',
                'area'              =>  'required',
                'nombre_asignado'   =>  'required'
            );
        }else{
            $reglas = array(
                'tipo_equipo'       =>  'required',
                'fecha_adquision'   =>  'required',
                'serial'            =>  'required',
                'marca'             =>  'required',
                'modelo'            =>  'required',
                'imei'              =>  'required',
                'capacidad'         =>  'required',
                'estado'            =>  'required'
            );
        }

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
            $BuscarInfoEquipo   = Inventario::BuscarInfoEquipoMovil($Serial);
            $TicketsBusqueda    = (int)count($BuscarInfoEquipo);
            foreach($BuscarInfoEquipo as $row){
                $NombreResponsable = $row->usuario;
            }
            if($TicketsBusqueda > 0){
                $verrors = array();
                array_push($verrors, 'El equipo con serial '.$Serial.' ya se ecuentra asignado a '.$NombreResponsable);
                return Redirect::to($url.'/mobile')->withErrors(['errors' => $verrors])->withInput();
            }else{
                $RegistrarEquipo    = Inventario::RegistrarEquipoMovil($TipoEquipo,$FechaAdquisicion,$Serial,$Marca,$Modelo,$IMEI,
                                                                        $Capacidad,$LineaMovil,$Area,$NombreAsignado,$EstadoEquipo,$creadoPor);
                if($RegistrarEquipo){
                    $BuscarUltimo = Inventario::BuscarLastEquipoMovil($creadoPor);
                    foreach($BuscarUltimo as $row){
                        $idEquipoMovil = $row->id;
                    }
                    if($NombreAsignado){
                        Inventario::RegistrarAsignadoEM($TipoEquipo,$idEquipoMovil,$Area,$NombreAsignado,$EstadoEquipo,$creadoPor);
                    }
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
                    $Comentario = 'Creación asignación de equipo movil';
                    Inventario::HistorialEM($idEquipoMovil,$Comentario,$EstadoEquipo,$creadoPor);
                    $verrors = 'Se registro con éxito el equipo movil '.$Marca.' - '.$Modelo;
                    return redirect($url.'/mobile')->with('mensaje', $verrors);
                }else{
                    $verrors = array();
                    array_push($verrors, 'Hubo un problema al registrar el equipo movil');
                    return Redirect::to($url.'/mobile')->withErrors(['errors' => $verrors])->withInput();
                }
            }
        }else{
            return Redirect::to($url.'/mobile')->withErrors(['errors' => $verrors])->withInput();
        }
    }

    public function actualizacionEquipoMovil(){
        $data = Input::all();
        $creadoPor          = (int)Session::get('IdUsuario');
        $buscarUsuario = Usuarios::BuscarNombre($creadoPor);
        foreach($buscarUsuario as $value){
            $Administrador = (int)$value->rol_id;
        }
        $url = InventarioController::BuscarURL($Administrador);
        $EstadoEquipo       = (int)Input::get('estado_upd');
        if($EstadoEquipo === 2){
            $reglas = array(
                'tipo_equipo_upd'       =>  'required',
                'fecha_adquision_upd'   =>  'required',
                'serial_upd'            =>  'required',
                'marca_upd'             =>  'required',
                'modelo_upd'            =>  'required',
                'imei_upd'              =>  'required',
                'capacidad_upd'         =>  'required',
                'estado_upd'            =>  'required',
                'comentario'            =>  'required',
                'area_upd'              =>  'required',
                'nombre_asignado_upd'   =>  'required'
            );
        }else{
            $reglas = array(
                'tipo_equipo_upd'       =>  'required',
                'fecha_adquision_upd'   =>  'required',
                'serial_upd'            =>  'required',
                'marca_upd'             =>  'required',
                'modelo_upd'            =>  'required',
                'imei_upd'              =>  'required',
                'capacidad_upd'         =>  'required',
                'estado_upd'            =>  'required',
                'comentario'            =>  'required'
            );
        }

        $validador = Validator::make($data, $reglas);
        $messages = $validador->messages();
        foreach ($reglas as $key => $value){
            $verrors[$key] = $messages->first($key);
        }
        if($validador->passes()) {
            $TipoEquipo         = Input::get('tipo_equipo_upd');
            $FechaAdquisicion   = date('Y-m-d H:i:s', strtotime(Input::get('fecha_adquision_upd')));
            $Serial             = Input::get('serial_upd');
            $Marca              = Input::get('marca_upd');
            $Modelo             = Input::get('modelo_upd');
            $IMEI               = Input::get('imei_upd');
            $Capacidad          = Input::get('capacidad_upd');
            $LineaMovil         = Input::get('linea_movil_upd');
            $Area               = Input::get('area_upd');
            $NombreAsignado     = Input::get('nombre_asignado_upd');
            $EstadoEquipo       = Input::get('estado_upd');
            $idEquipoMovil      = Input::get('idEM');
            $Comentario         = Input::get('comentario');
            if(Input::get('desvincular')){
                $Desvincular = 1;
            }else{
                $Desvincular = 0;
            }

            $ActualizarEquipoMovil = Inventario::ActualizarEquipoMovil($TipoEquipo,$FechaAdquisicion,$Serial,$Marca,$Modelo,$IMEI,$Capacidad,
                                                                            $LineaMovil,$Area,$NombreAsignado,$EstadoEquipo,$creadoPor,$idEquipoMovil,$Desvincular);

            if($ActualizarEquipoMovil){

                Inventario::RegistrarAsignadoEM($TipoEquipo,$idEquipoMovil,$Area,$NombreAsignado,$EstadoEquipo,$creadoPor);

                $destinationPath = null;
                $filename        = null;
                if (Input::hasFile('evidencia_upd')) {
                    $files = Input::file('evidencia_upd');
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
                Inventario::HistorialEM($idEquipoMovil,$Comentario,$EstadoEquipo,$creadoPor);
                $verrors = 'Se actualizo con éxito el equipo movil '.$Marca.' - '.$Modelo;
                return redirect($url.'/mobile')->with('mensaje', $verrors);
            }else{
                $verrors = array();
                array_push($verrors, 'Hubo un problema al actualizar el equipo movil');
                return Redirect::to($url.'/mobile')->withErrors(['errors' => $verrors])->withInput();
            }
        }else{
            return Redirect::to($url.'/mobile')->withErrors(['errors' => $verrors])->withInput();
        }
    }

    public function asignacionLineaMovil(){
        $data           = Input::all();
        $creadoPor      = (int)Session::get('IdUsuario');
        $buscarUsuario  = Usuarios::BuscarNombre($creadoPor);
        foreach($buscarUsuario as $value){
            $Administrador = (int)$value->rol_id;
        }
        $url = InventarioController::BuscarURL($Administrador);
        $Estado             = (int)Input::get('estado');
        if($Estado === 2){
            $reglas = array(
                'nro_linea'         =>  'required',
                'fecha_adquision'   =>  'required',
                'serial'            =>  'required',
                'activo'            =>  'required',
                'proveedores'       =>  'required',
                'plan'              =>  'required',
                'pto_cargo'         =>  'required',
                'cc'                =>  'required',
                'area'              =>  'required',
                'personal'          =>  'required',
                'estado'            =>  'required'
            );
        }else{
            $reglas = array(
                'nro_linea'         =>  'required',
                'fecha_adquision'   =>  'required',
                'serial'            =>  'required',
                'activo'            =>  'required',
                'proveedores'       =>  'required',
                'plan'              =>  'required',
                'pto_cargo'         =>  'required',
                'estado'            =>  'required'
            );
        }

        $validador = Validator::make($data, $reglas);
        $messages = $validador->messages();
        foreach ($reglas as $key => $value){
            $verrors[$key] = $messages->first($key);
        }
        if($validador->passes()) {
            $NroLinea           = Input::get('nro_linea');
            $FechaAdquisicion   = date('Y-m-d H:i:s', strtotime(Input::get('fecha_adquision')));
            $Serial             = Input::get('serial');
            $Activo             = Input::get('activo');
            $Proveedor          = Input::get('proveedores');
            $Plan               = Input::get('plan');
            $PtoCargo           = Input::get('pto_cargo');
            $Cc                 = Input::get('cc');
            $Area               = Input::get('area');
            $Personal           = Input::get('personal');
            $Estado             = Input::get('estado');
            $BuscarInfoEquipo   = Inventario::BuscarInfoLineaMovil($Serial);
            $TicketsBusqueda    = (int)count($BuscarInfoEquipo);
            foreach($BuscarInfoEquipo as $row){
                $NombreResponsable = $row->personal;
            }
            if($TicketsBusqueda > 0){
                $verrors = array();
                array_push($verrors, 'El equipo con serial '.$Serial.' ya se ecuentra asignado a '.$NombreResponsable);
                return Redirect::to($url.'/lineMobile')->withErrors(['errors' => $verrors])->withInput();
            }else{
                $RegistrarLineaMovil = Inventario::RegistrarLineaMovil($NroLinea,$FechaAdquisicion,$Serial,$Activo,$Proveedor,$Plan,$PtoCargo,$Cc,$Area,$Personal,$Estado,$creadoPor);
                if($RegistrarLineaMovil){
                    $BuscarUltimo = Inventario::BuscarLastLineaMovil($creadoPor);
                    foreach($BuscarUltimo as $row){
                        $idEquipoMovil = $row->id;
                    }
                    if($Personal){
                        Inventario::RegistrarAsignadoLM($idEquipoMovil,$Area,$Personal,$Estado,$creadoPor);
                    }
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
                            $filename           = $nombrearchivo.'_Linea Movil_'.$idEquipoMovil.'.'.$extension;
                            $uploadSuccess      = $file->move($destinationPath, $filename);
                            $archivofoto        = file_get_contents($uploadSuccess);
                            $NombreFoto         = $filename;
                            $actualizarEvidencia = Inventario::EvidenciaLM($idEquipoMovil,$NombreFoto);
                        }
                    }
                    $Comentario = 'Creación asignación de linea movil Nro. '.$NroLinea;
                    Inventario::HistorialLM($idEquipoMovil,$Comentario,$Estado,$creadoPor);
                    $verrors = 'Se registro con éxito la linea movil Nro. '.$NroLinea;
                    return redirect($url.'/lineMobile')->with('mensaje', $verrors);
                }else{
                    $verrors = array();
                    array_push($verrors, 'Hubo un problema al registrar la linea movil');
                    return Redirect::to($url.'/lineMobile')->withErrors(['errors' => $verrors])->withInput();
                }
            }
        }else{
            return Redirect::to($url.'/lineMobile')->withErrors(['errors' => $verrors])->withInput();
        }
    }

    public function actualizacionLineaMovil(){
        $data           = Input::all();
        $creadoPor      = (int)Session::get('IdUsuario');
        $buscarUsuario  = Usuarios::BuscarNombre($creadoPor);
        foreach($buscarUsuario as $value){
            $Administrador = (int)$value->rol_id;
        }
        $url = InventarioController::BuscarURL($Administrador);
        $Estado             = (int)Input::get('estado_upd');
        if($Estado === 2){
            $reglas = array(
                'nro_linea_upd'         =>  'required',
                'fecha_adquision_upd'   =>  'required',
                'serial_upd'            =>  'required',
                'activo_upd'            =>  'required',
                'proveedores_upd'       =>  'required',
                'plan_upd'              =>  'required',
                'pto_cargo_upd'         =>  'required',
                'cc_upd'                =>  'required',
                'area_upd'              =>  'required',
                'personal_upd'          =>  'required',
                'estado_upd'            =>  'required',
                'comentario'            =>  'required'
            );
        }else{
            $reglas = array(
                'nro_linea_upd'         =>  'required',
                'fecha_adquision_upd'   =>  'required',
                'serial_upd'            =>  'required',
                'activo_upd'            =>  'required',
                'proveedores_upd'       =>  'required',
                'plan_upd'              =>  'required',
                'pto_cargo_upd'         =>  'required',
                'estado_upd'            =>  'required',
                'comentario'            =>  'required'
            );
        }
        $validador = Validator::make($data, $reglas);
        $messages = $validador->messages();
        foreach ($reglas as $key => $value){
            $verrors[$key] = $messages->first($key);
        }
        if($validador->passes()) {
            $NroLinea           = Input::get('nro_linea_upd');
            $FechaAdquisicion   = date('Y-m-d H:i:s', strtotime(Input::get('fecha_adquision_upd')));
            $Serial             = Input::get('serial_upd');
            $Activo             = Input::get('activo_upd');
            $Proveedor          = Input::get('proveedores_upd');
            $Plan               = Input::get('plan_upd');
            $PtoCargo           = Input::get('pto_cargo_upd');
            $Cc                 = Input::get('cc_upd');
            $Area               = Input::get('area_upd');
            $Personal           = Input::get('personal_upd');
            $Estado             = Input::get('estado_upd');
            $IdLineaMovil       = Input::get('idLM');
            $Comentario         = Input::get('comentario');

            $ActualizacionLineaMovil = Inventario::ActualizarLineaMovil($NroLinea,$FechaAdquisicion,$Serial,$Activo,$Proveedor,$Plan,$PtoCargo,$Cc,$Area,$Personal,$Estado,$creadoPor,$IdLineaMovil);

            if($ActualizacionLineaMovil){

                Inventario::RegistrarAsignadoLM($IdLineaMovil,$Area,$Personal,$Estado,$creadoPor);

                $destinationPath = null;
                $filename        = null;
                if (Input::hasFile('evidencia_upd')) {
                    $files = Input::file('evidencia_upd');
                    foreach($files as $file){
                        $destinationPath    = public_path().'/assets/dist/img/evidencias_inventario';
                        $extension          = $file->getClientOriginalExtension();
                        $name               = $file->getClientOriginalName();
                        $nombrearchivo      = pathinfo($name, PATHINFO_FILENAME);
                        $nombrearchivo      = TicketsController::eliminar_tildes($nombrearchivo);
                        $filename           = $nombrearchivo.'_Linea Movil_'.$IdLineaMovil.'.'.$extension;
                        $uploadSuccess      = $file->move($destinationPath, $filename);
                        $archivofoto        = file_get_contents($uploadSuccess);
                        $NombreFoto         = $filename;
                        $actualizarEvidencia = Inventario::EvidenciaLM($IdLineaMovil,$NombreFoto);
                    }
                }
                Inventario::HistorialLM($IdLineaMovil,$Comentario,$Estado,$creadoPor);
                $verrors = 'Se actualizo con éxito la linea movil '.$NroLinea;
                return redirect($url.'/lineMobile')->with('mensaje', $verrors);
            }else{
                $verrors = array();
                array_push($verrors, 'Hubo un problema al actualizar la linea movil');
                return Redirect::to($url.'/lineMobile')->withErrors(['errors' => $verrors])->withInput();
            }

        }else{
            return Redirect::to($url.'/lineMobile')->withErrors(['errors' => $verrors])->withInput();
        }
    }

    public function ingresoEquipo(){
        $data           = Input::all();
        $creadoPor      = (int)Session::get('IdUsuario');
        $buscarUsuario  = Usuarios::BuscarNombre($creadoPor);
        foreach($buscarUsuario as $value){
            $Administrador = (int)$value->rol_id;
        }
        $url = InventarioController::BuscarURL($Administrador);
        $reglas = array(
            'tipo_equipo'       =>  'required',
            'tipo_ingreso'      =>  'required',
            'fecha_adquision'   =>  'required',
            'serial'            =>  'required',
            'marca'             =>  'required'
        );
        $validador = Validator::make($data, $reglas);
        $messages = $validador->messages();
        foreach ($reglas as $key => $value){
            $verrors[$key] = $messages->first($key);
        }
        if($validador->passes()) {
            $TipoEquipo         = Input::get('tipo_equipo');
            $TipoIngreso        = Input::get('tipo_ingreso');
            if(Input::get('emp_renting')){
                $EmpresaRenting = Input::get('emp_renting');
            }else{
                $EmpresaRenting = 'SIN EMPRESA';
            }
            $FechaAdquisicion   = date('Y-m-d H:i:s', strtotime(Input::get('fecha_adquision')));
            $Serial             = Input::get('serial');
            $Marca              = Input::get('marca');
            $Procesador         = Input::get('procesador');
            $VelProcesador      = Input::get('vel_procesador');
            $DiscoDuro          = Input::get('disco_duro');
            $MemoriaRam         = Input::get('memoria_ram');
            $EstadoEquipo       = Input::get('estado');
            $BuscarSerial       = Inventario::BuscarSerialEquipo($Serial);
            $TotalBusqueda      = (int)count($BuscarSerial);
            if($TotalBusqueda > 0){
                $verrors = array();
                array_push($verrors, 'Ya existe un equipo con el serial '.$Serial);
                return Redirect::to($url.'/desktops')->withErrors(['errors' => $verrors])->withInput();
            }else{

                $IngresarEquipo = Inventario::IngresarEquipo($TipoEquipo,$TipoIngreso,$EmpresaRenting,$FechaAdquisicion,$Serial,$Marca,$Procesador,$VelProcesador,$DiscoDuro,$MemoriaRam,$EstadoEquipo,$creadoPor);
                if($IngresarEquipo){
                    $BuscarUltimo = Inventario::BuscarLastEquipo($creadoPor);
                    foreach($BuscarUltimo as $row){
                        $idEquipo = $row->id;
                    }
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
                            $filename           = $nombrearchivo.'_Equipo_'.$idEquipo.'.'.$extension;
                            $uploadSuccess      = $file->move($destinationPath, $filename);
                            $archivofoto        = file_get_contents($uploadSuccess);
                            $NombreFoto         = $filename;
                            $actualizarEvidencia = Inventario::EvidenciaIE($idEquipo,$NombreFoto);
                        }
                    }
                    $Comentario = 'Creación de equipo Nro. '.$idEquipo.' en el sistema';
                    Inventario::HistorialE($idEquipo,$Comentario,$EstadoEquipo,$creadoPor);
                    $verrors = 'Se ingreso satisfactoriamente el equipo No. de Activo '.$idEquipo;
                    return redirect($url.'/desktops')->with('mensaje', $verrors);
                }else{
                    $verrors = array();
                    array_push($verrors, 'Hubo un problema al ingresar el equipo');
                    return Redirect::to($url.'/desktops')->withErrors(['errors' => $verrors])->withInput();
                }
            }
        }else{
            return Redirect::to($url.'/desktops')->withErrors(['errors' => $verrors])->withInput();
        }
    }

    public function actualizacionEquipo(){
        $data           = Input::all();
        $creadoPor      = (int)Session::get('IdUsuario');
        $buscarUsuario  = Usuarios::BuscarNombre($creadoPor);
        foreach($buscarUsuario as $value){
            $Administrador = (int)$value->rol_id;
        }
        $url = InventarioController::BuscarURL($Administrador);
        $reglas = array(
            'tipo_equipo_upd'       =>  'required',
            'tipo_ingreso_upd'      =>  'required',
            'fecha_adquision_upd'   =>  'required',
            'serial_upd'            =>  'required',
            'marca_upd'             =>  'required',
            'comentario'            =>  'required'
        );
        $validador = Validator::make($data, $reglas);
        $messages = $validador->messages();
        foreach ($reglas as $key => $value){
            $verrors[$key] = $messages->first($key);
        }
        if($validador->passes()) {
            $TipoEquipo         = Input::get('tipo_equipo_upd');
            $TipoIngreso        = Input::get('tipo_ingreso_upd');
            if(Input::get('emp_renting_upd')){
                $EmpresaRenting = Input::get('emp_renting_upd');
            }else{
                $EmpresaRenting = 'SIN EMPRESA';
            }
            $FechaAdquisicion   = date('Y-m-d H:i:s', strtotime(Input::get('fecha_adquision_upd')));
            $Serial             = Input::get('serial_upd');
            $Marca              = Input::get('marca_upd');
            $Procesador         = Input::get('procesador_upd');
            $VelProcesador      = Input::get('vel_procesador_upd');
            $DiscoDuro          = Input::get('disco_duro_upd');
            $MemoriaRam         = Input::get('memoria_ram_upd');
            $EstadoEquipo       = Input::get('estado_upd');
            $Comentario         = Input::get('comentario');
            $IdEquipo           = Input::get('idE');

            $ActualizarEquipo   = Inventario::ActualizarEquipo($TipoEquipo,$TipoIngreso,$EmpresaRenting,$FechaAdquisicion,$Serial,$Marca,$Procesador,$VelProcesador,$DiscoDuro,$MemoriaRam,$EstadoEquipo,$creadoPor,$IdEquipo);

            if($ActualizarEquipo){
                $destinationPath = null;
                $filename        = null;
                if (Input::hasFile('evidencia_upd')) {
                    $files = Input::file('evidencia_upd');
                    foreach($files as $file){
                        $destinationPath    = public_path().'/assets/dist/img/evidencias_inventario';
                        $extension          = $file->getClientOriginalExtension();
                        $name               = $file->getClientOriginalName();
                        $nombrearchivo      = pathinfo($name, PATHINFO_FILENAME);
                        $nombrearchivo      = TicketsController::eliminar_tildes($nombrearchivo);
                        $filename           = $nombrearchivo.'_Equipo_'.$IdEquipo.'.'.$extension;
                        $uploadSuccess      = $file->move($destinationPath, $filename);
                        $archivofoto        = file_get_contents($uploadSuccess);
                        $NombreFoto         = $filename;
                        $actualizarEvidencia = Inventario::EvidenciaIE($IdEquipo,$NombreFoto);
                    }
                }
                Inventario::HistorialE($IdEquipo,$Comentario,$EstadoEquipo,$creadoPor);
                $verrors = 'Se actualizo satisfactoriamente el equipo No. de Activo '.$IdEquipo;
                return redirect($url.'/desktops')->with('mensaje', $verrors);
            }else{
                $verrors = array();
                array_push($verrors, 'Hubo un problema al actualizar el equipo');
                return Redirect::to($url.'/desktops')->withErrors(['errors' => $verrors])->withInput();
            }
        }else{
            return Redirect::to($url.'/desktops')->withErrors(['errors' => $verrors])->withInput();
        }
    }
}
