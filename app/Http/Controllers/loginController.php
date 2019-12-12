<?php

namespace App\Http\Controllers;

use App\Http\Controllers\User\UsuariosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use App\Models\Admin\Usuarios;
use App\Models\User\Tickets;
use App\Models\User\ControlCambios;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('auth.login');
    }

    public function helpdesk()
    {

        return view('auth.login');
    }

    public function usuarios()
    {

        return view('pagina.usuarios');
    }

    public function servicios()
    {

        return view('pagina.servicios');
    }

    public function Acceso(){

        $data = Input::all();
        $reglas = array(
            'user' => 'required',
            'password' => 'required',
            'g-recaptcha-response' => 'required|captcha'
        );
        $validador = Validator::make($data, $reglas);
        $messages = $validador->messages();
        foreach ($reglas as $key => $value){
            $verrors[$key] = $messages->first($key);
        }
        if($validador->passes()) {
            $Usuario    = Input::get('user');
            $Password   = Input::get('password');
            $clave      = hash('sha512', $Password);

            $consultarUsuario = Usuarios::BuscarUser($Usuario);

            if($consultarUsuario){
                $consultarLogin = Usuarios::BuscarPass($Usuario,$clave);
                if($consultarLogin){

                    foreach($consultarLogin as $value){
                        $IdUsuario          = (int)$value->id;
                        $nombreUsuario      = $value->nombre;
                        $emailUsuario       = $value->email;
                        $userName           = $value->username;
                        $profile_pic        = $value->profile_pic;
                        $estado             = (int)$value->activo;
                        $idRol              = (int)$value->id_rol;
                        $idCategoria        = (int)$value->id_categoria;
                        $idZona             = (int)$value->id_zona;
                        $idSede             = (int)$value->id_sede;
                        $fechaInicio        = $value->created_at;
                        $idArea             = (int)$value->id_area;
                        $administracion     = (int)$value->administrador;
                    }

                    If($estado === 1){
                        $Rol    = Usuarios::BuscarNombreRol($idRol);
                        foreach($Rol as $valor){
                            $NombreRol = $valor->nombre;
                        }
                        $Categoria    = Usuarios::BuscarNombreCategoria($idCategoria);
                        foreach($Categoria as $valor){
                            $NombreCategoria = $valor->nombre;
                        }
                        $Area    = Usuarios::BuscarNombreArea($idArea);
                        foreach($Area as $valor){
                            $NombreArea = $valor->nombre;
                        }
                        $Sede    = Usuarios::BuscarNombreSede($idSede);
                        foreach($Sede as $valor){
                            $NombreSede = $valor->nombre;
                        }
                        $Zona    = Usuarios::BuscarNombreZona($idZona);
                        foreach($Zona as $valor){
                            $NombreZona = $valor->nombre;
                        }
                        setlocale(LC_ALL, 'es_ES');
                        // $fechaCreacion = date('F, Y', strtotime($fechaInicio));
                        $mesCreacion = date('F', strtotime($fechaInicio));
                        $anio = date('Y', strtotime($fechaInicio));
                        $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
                        $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
                        $nombreMes = str_replace($meses_EN, $meses_ES, $mesCreacion);

                        $fechaCreacion = $nombreMes.', '.$anio;

                        $fotoPerfil = "<img src='../aplicativo/profile_pics/$profile_pic' class='img-circle' alt='User Image'>";
                        $fotoMenu   = "<img src='../aplicativo/profile_pics/$profile_pic' class='user-image' alt='User Image'>";
                        $fotoPerfilM = "<img src='aplicativo/profile_pics/$profile_pic' class='img-circle' alt='User Image'>";
                        $fotoMenuM   = "<img src='aplicativo/profile_pics/$profile_pic' class='user-image' alt='User Image'>";
                        $fotoUser   = "<img src='../aplicativo/profile_pics/$profile_pic' class='profile-user-img img-responsive img-circle' alt='User profile picture' style='width: 35%;'>";

                        $notificaciones = Tickets::Notificaciones($IdUsuario);
                        $contadorNotificacion = count($notificaciones);
                        if($contadorNotificacion > 0){
                            $listarNotificaciones = array();
                        $contN = 0;
                        foreach($notificaciones as $noti){
                            $UserCreador = $noti->creado_por;
                            $usuarios = Usuarios::BuscarNombre($UserCreador);
                            foreach($usuarios as $user){
                                $UsuarioN = $user->nombre;
                            }
                            $listarNotificaciones[$contN]['creador'] = $UsuarioN;
                            $contN++;
                        }
                        }else{
                            $contadorNotificacion = 0;
                            $listarNotificaciones = null;
                        }


                        $cambios = ControlCambios::Notificaciones($IdUsuario);
                        $contadorCambios = count($cambios);

                        $listarCambios = array();
                        $contC = 0;
                        foreach($cambios as $noti){
                            $UserCreador = $noti->creado_por;
                            $usuarios = Usuarios::BuscarNombre($UserCreador);
                            foreach($usuarios as $user){
                                $UsuarioN = $user->nombre;
                            }
                            $listarCambios[$contC]['creador'] = $UsuarioN;
                            $contC++;
                        }

                        \Session::put('IdUsuario', $IdUsuario);
                        \Session::put('NombreUsuario', $nombreUsuario);
                        \Session::put('UserName', $userName);
                        \Session::put('Rol', $idRol);
                        \Session::put('Zona', $idZona);
                        \Session::put('Sede', $idSede);
                        \Session::put('Email', $emailUsuario);
                        \Session::put('Activo', $estado);
                        \Session::put('NombreSede', $NombreSede);
                        \Session::put('NombreZona', $NombreZona);
                        \Session::put('NombreArea', $NombreArea);
                        \Session::put('NombreCategoria', $NombreCategoria);
                        \Session::put('NombreRol', $NombreRol);
                        \Session::put('Categoria', $idCategoria);
                        \Session::put('ProfilePicMenu', $fotoMenu);
                        \Session::put('ProfilePic', $fotoPerfil);
                        \Session::put('ProfilePicMenuM', $fotoMenuM);
                        \Session::put('ProfilePicM', $fotoPerfilM);
                        \Session::put('ProfileUser', $fotoUser);
                        \Session::put('FechaCreacion', $fechaCreacion);
                        \Session::put('Administracion', $administracion);
                        \Session::put('Notificaciones', $contadorNotificacion);
                        \Session::put('Notificacion', $listarNotificaciones);
                        \Session::put('Cambios', $contadorCambios);
                        \Session::put('Cambio', $listarCambios);
                        \Session::save();
                        // return \Response::json(['valido'=>'true','rol'=>$rol]);
                        $usuario = \Session::get('NombreUsuario');
                        if(($idRol === 1) || ($idRol === 6)){
                            return redirect()->route('admin/dashboard');
                        }elseif($idRol === 5){
                            return redirect()->route('dashboardMonitoreo');
                        }else{
                            return redirect()->route('user/dashboard');
                        }
                        // return view('user.index',['NombreUsuario' => $nombreUsuario]);

                    }else{
                        $verrors = array();
                        array_push($verrors, 'Usuario inactivo');
                        // return \Response::json(['valido'=>'false','errors'=>$verrors]);
                        return redirect('/')->withErrors(['errors' => $verrors])->withInput();
                    }
                }else{
                    $verrors = array();
                    array_push($verrors, 'Contraseña erronea');
                    // return \Response::json(['valido'=>'false','errors'=>$verrors]);
                    return redirect('/')->withErrors(['errors' => $verrors])->withInput();
                }

            }else{
                $verrors = array();
                array_push($verrors, 'Usuario '.$Usuario.' no existe');
                // return \Response::json(['valido'=>'false','errors'=>$verrors]);
                return redirect('/')->withErrors(['errors' => $verrors])->withInput();
            }
        }else{
            return redirect('/')->withErrors(['errors' => $verrors])->withInput();
            // return \Response::json(['valido'=>'false','errors'=>$verrors]);
        }
    }

    public function RecuperarContrasena(){
        $data = Input::all();
        $UserName = Input::get('username');
        $UserEmail = Input::get('correo');

        if(!empty($UserName) || !empty($UserEmail)){

            if(!empty($UserName) && empty($UserEmail)){

                $BuscarUsuario = Usuarios::BuscarUser($UserName);
                if($BuscarUsuario){
                    $cadena = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ()#.$@?';
                    $limite = strlen($cadena) - 1;
                    $b = '';
                    for ($i=0; $i < 8; $i++){
                        $b .= $cadena[rand(0, $limite)];
                    }
                    $nuevaContrasena = Hash('sha512',$b);
                    foreach($BuscarUsuario as $value){
                        $idUser = $value->id;
                        $emailUser = $value->email;
                    }
                    $UpdatePassword = Usuarios::NuevaContrasena($idUser,$nuevaContrasena);
                    if($UpdatePassword){

                        $for = "$emailUser";
                        $subject = "Recuperación de Contraseña";
                        Mail::send('email/EmailRContrasena',
                                ['Contrasena' => $b,'NombreUser' => $UserName,],
                                function($msj) use($subject,$for){
                                    $msj->from("soporte@utservisalud.com.co","Mesa de Ayuda Tics - Servisalud QCL");
                                    $msj->subject($subject);
                                    $msj->to($for);

                        });

                        $verrors = 'Se envio con exito la nueva contraseña al correo del usuario '.$UserName;
                        return redirect('/')->with('mensaje', $verrors);
                    }else{
                        $verrors = array();
                    array_push($verrors, 'Hubo un problema al recuperar la contraseña');
                    return redirect('/')->withErrors(['errors' => $verrors])->withInput();
                    }
                }else{
                    $verrors = array();
                    array_push($verrors, 'El usuario '.$UserName.' NO se encuentra en la base de datos');
                    return redirect('/')->withErrors(['errors' => $verrors])->withInput();
                }
            }else if(empty($UserName) && !empty($UserEmail)){
                $BuscarUsuario = Usuarios::BuscarUserEmail($UserEmail);
                if($BuscarUsuario){
                    $cadena = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ()#.$@?';
                    $limite = strlen($cadena) - 1;
                    $b = '';
                    for ($i=0; $i < 8; $i++){
                        $b .= $cadena[rand(0, $limite)];
                    }
                    $nuevaContrasena = Hash('sha512',$b);
                    foreach($BuscarUsuario as $value){
                        $idUser = $value->id;
                        $userName = $value->nombre;
                        $emailUser = $value->email;
                    }
                    $UpdatePassword = Usuarios::NuevaContrasena($idUser,$nuevaContrasena);
                    if($UpdatePassword){
                        $for = "$emailUser";
                        $subject = "Recuperación de Contraseña";
                        Mail::send('email/EmailRContrasena',
                                ['Contrasena' => $b,'NombreUser' => $userName,],
                                function($msj) use($subject,$for){
                                    $msj->from("soporte@utservisalud.com.co","Mesa de Ayuda Tics - Servisalud QCL");
                                    $msj->subject($subject);
                                    $msj->to($for);

                        });
                        $verrors = 'Se envio con exito la nueva contraseña al correo del usuario '.$UserName;
                        return redirect('/')->with('mensaje', $verrors);
                    }else{
                        $verrors = array();
                    array_push($verrors, 'Hubo un problema al recuperar la contraseña');
                    return redirect('/')->withErrors(['errors' => $verrors])->withInput();
                    }
                }else{
                    $verrors = array();
                    array_push($verrors, 'El correo '.$UserEmail.' NO se encuentra en la base de datos');
                    return redirect('/')->withErrors(['errors' => $verrors])->withInput();
                }
            }else if(!empty($UserName) && !empty($UserEmail)){
                $BuscarUsuario = Usuarios::RestablecerPassword($UserName,$UserEmail);
                if($BuscarUsuario){
                    $cadena = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ()#.$@?';
                    $limite = strlen($cadena) - 1;
                    $b = '';
                    for ($i=0; $i < 8; $i++){
                        $b .= $cadena[rand(0, $limite)];
                    }
                    $nuevaContrasena = Hash('sha512',$b);
                    foreach($BuscarUsuario as $value){
                        $idUser = $value->id;
                        $userName = $value->nombre;
                        $emailUser = $value->email;
                    }
                    $UpdatePassword = Usuarios::NuevaContrasena($idUser,$nuevaContrasena);
                    if($UpdatePassword){
                        $subject = "Recuperación de Contraseña";
                        Mail::send('email/EmailRContrasena',
                                ['Contrasena' => $b,'NombreUser' => $userName,],
                                function($msj) use($subject,$for){
                                    $msj->from("soporte@utservisalud.com.co","Mesa de Ayuda Tics - Servisalud QCL");
                                    $msj->subject($subject);
                                    $msj->to($for);

                        });
                        $verrors = 'Se envio con exito la nueva contraseña al correo del usuario '.$UserName;
                        return redirect('/')->with('mensaje', $verrors);
                    }else{
                        $verrors = array();
                    array_push($verrors, 'Hubo un problema al recuperar la contraseña');
                    return redirect('/')->withErrors(['errors' => $verrors])->withInput();
                    }
                }else{
                    $verrors = array();
                    array_push($verrors, 'El usuario '.$UserName.' y correo '.$UserEmail.' NO se encuentra en la base de datos');
                    return redirect('/')->withErrors(['errors' => $verrors])->withInput();
                }
            }
        }else{
            $verrors = array();
            array_push($verrors, 'Debe diligenciar uno de los dos campos para continuar');
            return redirect('/')->withErrors(['errors' => $verrors])->withInput();
        }
    }

    public function dashboardMonitoreo()
    {
        setlocale(LC_ALL, 'es_CO');
        $EnDesarrollo   = Tickets::EnDesarrollo();
        foreach($EnDesarrollo as $valor){
            $desarrolloT = $valor->total;
        }
        $EnDesarrolloCC   = ControlCambios::EnDesarrollo();
        foreach($EnDesarrolloCC as $valor){
            $desarrolloC = $valor->total;
        }
        $Pendientes     = Tickets::Pendientes();
        foreach($Pendientes as $valor){
            $pendientesT = $valor->total;
        }
        $PendientesCC     = ControlCambios::Pendientes();
        foreach($PendientesCC as $valor){
            $pendientesC = $valor->total;
        }
        $Cancelados     = Tickets::Cancelados();
        foreach($Cancelados as $valor){
            $canceladosT = $valor->total;
        }
        $CanceladosCC     = ControlCambios::Cancelados();
        foreach($CanceladosCC as $valor){
            $canceladosC = $valor->total;
        }
        $Terminados     = Tickets::Terminados();
        foreach($Terminados as $valor){
            $terminadosT = $valor->total;
        }
        $TerminadosCC     = ControlCambios::Terminados();
        foreach($TerminadosCC as $valor){
            $terminadosC = $valor->total;
        }
        $Infraestructura     = Tickets::Infraestructura();
        foreach($Infraestructura as $valor){
            $InfraestructuraT = $valor->total;
        }
        $InfraestructuraCC     = ControlCambios::Infraestructura();
        foreach($InfraestructuraCC as $valor){
            $InfraestructuraC = $valor->total;
        }
        $Redes     = Tickets::Redes();
        foreach($Redes as $valor){
            $RedesT = $valor->total;
        }
        $RedesCC     = ControlCambios::Redes();
        foreach($RedesCC as $valor){
            $RedesC = $valor->total;
        }
        $Aplicaciones     = Tickets::Aplicaciones();
        foreach($Aplicaciones as $valor){
            $AplicacionesT = $valor->total;
        }
        $AplicacionesCC     = ControlCambios::Aplicaciones();
        foreach($AplicacionesCC as $valor){
            $AplicacionesC = $valor->total;
        }
        $Desarrollo     = Tickets::Desarrollo();
        foreach($Desarrollo as $valor){
            $DesarrolloT = $valor->total;
        }
        $DesarrolloCC     = ControlCambios::Desarrollo();
        foreach($DesarrolloCC as $valor){
            $DesarrolloC = $valor->total;
        }
        $Soporte     = Tickets::Soporte();
        foreach($Soporte as $valor){
            $SoporteT = $valor->total;
        }
        $SoporteCC     = ControlCambios::Soporte();
        foreach($SoporteCC as $valor){
            $SoporteC = $valor->total;
        }
        setlocale(LC_ALL, 'es_ES');
        $fechaActual = date('M - Y');
        // $mesActual  = date('M - y', strtotime($fechaActual));
        $mesCreacion = date('M', strtotime($fechaActual));
        $anio = date('y', strtotime($fechaActual));
        $meses_ES = array("Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic");
        $meses_EN = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
        $nombreMes = str_replace($meses_EN, $meses_ES, $mesCreacion);

        $mesActual              = $nombreMes.' - '.$anio;
        $guardarMes             = Tickets::GuardarMes($mesActual);

        $buscarGestion          = Tickets::buscarGestion();
        $buscarGestionTotal     = Tickets::buscarGestionTotal();
        $buscarGestionCC        = ControlCambios::buscarGestion();
        $buscarGestionTotalCC   = ControlCambios::buscarGestionTotal();

        foreach($buscarGestionTotal as $row){
            $totalGestion = (int)$row->total;
        }
        foreach($buscarGestionTotalCC as $row){
            $totalGestionC = (int)$row->total;
        }
        $resultado_consulta = array();
        $cont = 0;

        if($totalGestion > 0){
            $resultado_gestion = array();
            $contadorGestion = count($buscarGestion);
            $contG = 0;
            foreach($buscarGestion as $consulta){
                    $resultado_gestion[$contG]['nombre']= $consulta->nombre_usuario;
                    $resultado_gestion[$contG]['desarrollo']= $consulta->desarrollo;
                    $resultado_gestion[$contG]['pendientes']= $consulta->pendientes;
                    $resultado_gestion[$contG]['terminados']= $consulta->terminados;
                    $resultado_gestion[$contG]['cancelados']= $consulta->cancelados;

                    if($cont >= ($contadorGestion-1)){
                        $resultado_gestion[$contG]['separador']= '';
                    }else{
                        $resultado_gestion[$contG]['separador']= ',';
                    }
                    $contG++;
            }
        }else{
            $resultado_gestion = null;
        }
        if($totalGestionC > 0){
            $resultado_gestionC = array();
            $contadorGestionC = count($buscarGestionCC);
            $contGC = 0;
            foreach($buscarGestionCC as $consulta){
                    $resultado_gestionC[$contGC]['nombre']= $consulta->nombre_usuario;
                    $resultado_gestionC[$contGC]['desarrollo']= $consulta->desarrollo;
                    $resultado_gestionC[$contGC]['pendientes']= $consulta->pendientes;
                    $resultado_gestionC[$contGC]['terminados']= $consulta->terminados;
                    $resultado_gestionC[$contGC]['cancelados']= $consulta->cancelados;

                    if($contGC >= ($contadorGestionC-1)){
                        $resultado_gestionC[$contGC]['separador']= '';
                    }else{
                        $resultado_gestionC[$contGC]['separador']= ',';
                    }
                    $contGC++;
            }
        }else{
            $resultado_gestionC = null;
        }

        if($guardarMes === false){
            $resultado_consulta = null;
        }else{
            $buscarMes = Tickets::BuscarMes();
            $contadorMes = count($buscarMes);

            foreach($buscarMes as $consulta){
                    $resultado_consulta[$cont]['nombre']= $consulta->nombre;
                    $resultado_consulta[$cont]['incidentes']= $consulta->incidentes;
                    $resultado_consulta[$cont]['requerimientos']= $consulta->requerimientos;

                    if($cont >= ($contadorMes-1)){
                        $resultado_consulta[$cont]['separador']= '';
                    }else{
                        $resultado_consulta[$cont]['separador']= ',';
                    }
                    $cont++;
            }

        }
        $resultado_consultaC = array();
        $contC = 0;
        $guardarMesCC           = ControlCambios::GuardarMes($mesActual);
        // dd($guardarMesCC);
        if($guardarMesCC === false){
            $resultado_consultaC = null;
        }else{
            $buscarMesC = ControlCambios::BuscarMes();
            $contadorMesC = count($buscarMesC);
            // dd($contadorMesC);
            foreach($buscarMesC as $consulta){
                    $resultado_consultaC[$contC]['nombre']= $consulta->nombre;
                    $resultado_consultaC[$contC]['alto']= $consulta->alto;
                    $resultado_consultaC[$contC]['medio']= $consulta->medio;
                    $resultado_consultaC[$contC]['bajo']= $consulta->bajo;

                    if($contC >= ($contadorMesC-1)){
                        $resultado_consultaC[$contC]['separador']= '';
                    }else{
                        $resultado_consultaC[$contC]['separador']= ',';
                    }
                    $contC++;
            }
            // dd($resultado_consultaC);
        }
        // dd($resultado_consultaC);
        return view('indexMonitoreo',['EnDesarrollo' => $desarrolloT,'EnDesarrolloC' => $desarrolloC,'Pendientes' => $pendientesT,'PendientesC' => $pendientesC,
                                   'Terminados' => $terminadosT,'TerminadosC' => $terminadosC,'Cancelados' => $canceladosT,'CanceladosC' => $canceladosC,
                                   'MesGraficas' => $resultado_consulta,'MesGraficasC' => $resultado_consultaC,'Infraestructura' => $InfraestructuraT,
                                   'InfraestructuraC' => $InfraestructuraC,'Redes' => $RedesT,'RedesC' => $RedesC,'Aplicaciones' => $AplicacionesT,'AplicacionesC' => $AplicacionesC,
                                   'Desarrollo' => $DesarrolloT,'DesarrolloC' => $DesarrolloC,'Soporte' => $SoporteT,'SoporteC' => $SoporteC,
                                   'Gestion' => $resultado_gestion,'GestionC' => $resultado_gestionC]);

    }

}
