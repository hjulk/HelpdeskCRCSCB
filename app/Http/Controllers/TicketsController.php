<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\Admin\Sedes;
use App\Models\Helpdesk\Tickets;
use Validator;
use App\Models\Admin\Usuarios;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class TicketsController extends Controller
{

    public function crearTicket()
    {
        $data = Input::all();
        $creadoPor          = (int)Input::get('IdUsuario');
        $buscarUsuario = Usuarios::BuscarNombre($creadoPor);
        foreach($buscarUsuario as $value){
            $Administrador = (int)$value->rol_id;
        }
        $url = TicketsController::BuscarURL($Administrador);
        $reglas = array(
            'kind_id'           =>  'required',
            'title'             =>  'required',
            'description'       =>  'required',
            'nombre_usuario'    =>  'required',
            'telefono_usuario'  =>  'required',
            'correo_usuario'    =>  'required',
            'project_id'        =>  'required',
            'dependencia'       =>  'required',
            'priority_id'       =>  'required',
            'id_categoria'       =>  'required',
            'id_usuario'        =>  'required',
            'id_estado'         =>  'required',
            'evidencia'         =>  'max:5120'
        );
        $validador = Validator::make($data, $reglas);
        $messages = $validador->messages();
        foreach ($reglas as $key => $value){
            $verrors[$key] = $messages->first($key);
        }
        if($validador->passes()) {

            $idTipo             = (int)Input::get('kind_id');
            $Asunto             = Input::get('title');
            $Descripcion        = Input::get('description');
            $NombreUsuario      = Input::get('nombre_usuario');
            $TelefonoUsuario    = Input::get('telefono_usuario');
            $CorreUsuario       = Input::get('correo_usuario');
            $IdSede             = (int)Input::get('project_id');
            $Area               = Input::get('dependencia');
            $Prioridad          = (int)Input::get('priority_id');
            $Categoria          = (int)Input::get('id_categoria');
            $AsignadoA          = (int)Input::get('id_usuario');
            $Estado             = (int)Input::get('id_estado');
            $creadoPor          = (int)Input::get('IdUsuario');

            $nombreCategoria    = Tickets::Categoria($Categoria);
            $nombrePrioridad    = Tickets::Prioridad($Prioridad);
            $nombreEstado       = Tickets::Estado($Estado);
            $nombreAsignado     = Usuarios::BuscarNombre($AsignadoA);

            foreach($nombreCategoria as $row){
                $nameCategoria = $row->name;
            }
            foreach($nombrePrioridad as $row){
                $namePrioridad = $row->name;
            }
            foreach($nombreEstado as $row){
                $nameEstado = $row->name;
            }
            foreach($nombreAsignado as $row){
                $nameAsignado = $row->name;
                $emailAsignado = $row->email;
            }

            $CrearTicket = Tickets::CrearTicket($idTipo,$Asunto,$Descripcion,$NombreUsuario,$TelefonoUsuario,$CorreUsuario,
                                                $IdSede,$Area,$Prioridad,$Categoria,$AsignadoA,$Estado,$creadoPor);

            if($CrearTicket){
                $buscarUltimo = Tickets::BuscarLastTicket($creadoPor);
                foreach($buscarUltimo as $row){
                    $ticket = $row->id;
                }
                $destinationPath = null;
                $filename        = null;
                if (Input::hasFile('evidencia')) {
                    $files = Input::file('evidencia');
                    foreach($files as $file){
                        $destinationPath    = public_path().'/assets/dist/img/evidencias';
                        $extension          = $file->getClientOriginalExtension();
                        $name               = $file->getClientOriginalName();
                        $nombrearchivo      = pathinfo($name, PATHINFO_FILENAME);
                        $nombrearchivo      = TicketsController::eliminar_tildes($nombrearchivo);
                        $filename           = $nombrearchivo.'_Ticket_'.$ticket.'.'.$extension;
                        $uploadSuccess      = $file->move($destinationPath, $filename);
                        $archivofoto        = file_get_contents($uploadSuccess);
                        $NombreFoto         = $filename;
                        $actualizarEvidencia = Tickets::Evidencia($ticket,$NombreFoto);
                    }
                }


                $fecha_sistema  = date('d-m-Y h:i a');
                $fechaCreacion  = date('d-m-Y h:i a', strtotime($fecha_sistema));

                $subject = "Creación ticket Mesa de ayuda";

                $buscar = strpos($CorreUsuario,';');
                if($buscar === false){
                    $for = "$CorreUsuario";
                }else{
                    $for = array();
                    $for = explode(';',$CorreUsuario);
                }
                // $for = "$CorreUsuario";
                $cco = "$emailAsignado";
                $calificacion = 1;
                if($Estado === 3){
                    $calificacion1 = "<a href='http://192.168.0.125:8080/helpdeskcrcscb/public/calificarTicket?valor=1&idTicket=$ticket'><img src='http://192.168.0.125:8080/helpdesk/public/assets/dist/img/calificacion/excelente.png' width='60' height='60'/></a>";
                    $calificacion2 = "<a href='http://192.168.0.125:8080/helpdeskcrcscb/public/calificarTicket?valor=2&idTicket=$ticket'><img src='http://192.168.0.125:8080/helpdesk/public/assets/dist/img/calificacion/bueno.png' width='60' height='60'/></a>";
                    $calificacion3 = "<a href='http://192.168.0.125:8080/helpdeskcrcscb/public/calificarTicket?valor=1&idTicket=$ticket'><img src='http://192.168.0.125:8080/helpdesk/public/assets/dist/img/calificacion/regular.png' width='60' height='60'/></a>";
                    $calificacion4 = "<a href='http://192.168.0.125:8080/helpdeskcrcscb/public/calificarTicket?valor=1&idTicket=$ticket'><img src='http://192.168.0.125:8080/helpdesk/public/assets/dist/img/calificacion/malo.png' width='60' height='60'/></a>";
                    $calificacion5 = "<a href='http://192.168.0.125:8080/helpdeskcrcscb/public/calificarTicket?valor=1&idTicket=$ticket'><img src='http://192.168.0.125:8080/helpdesk/public/assets/dist/img/calificacion/pesimo.png' width='60' height='60'/></a>";
                    // $calificacion1 = "<a href='http://crcscbmesadeayuda.cruzrojabogota.org.co/calificarTicket?valor=1&idTicket=$ticket'><img src='http://crcscbmesadeayuda.cruzrojabogota.org.co/assets/dist/img/calificacion/excelente.png' width='60' height='60'/></a>";
                    // $calificacion2 = "<a href='http://crcscbmesadeayuda.cruzrojabogota.org.co/calificarTicket?valor=2&idTicket=$ticket'><img src='http://crcscbmesadeayuda.cruzrojabogota.org.co/dist/img/calificacion/bueno.png' width='60' height='60'/></a>";
                    // $calificacion3 = "<a href='http://crcscbmesadeayuda.cruzrojabogota.org.co/calificarTicket?valor=1&idTicket=$ticket'><img src='http://crcscbmesadeayuda.cruzrojabogota.org.co/assets/dist/img/calificacion/regular.png' width='60' height='60'/></a>";
                    // $calificacion4 = "<a href='http://crcscbmesadeayuda.cruzrojabogota.org.co/calificarTicket?valor=1&idTicket=$ticket'><img src='http://crcscbmesadeayuda.cruzrojabogota.org.co/assets/dist/img/calificacion/malo.png' width='60' height='60'/></a>";
                    // $calificacion5 = "<a href='http://crcscbmesadeayuda.cruzrojabogota.org.co/calificarTicket?valor=1&idTicket=$ticket'><img src='http://crcscbmesadeayuda.cruzrojabogota.org.co/assets/dist/img/calificacion/pesimo.png' width='60' height='60'/></a>";
                 }else{
                    $calificacion = 0;
                    $calificacion1 = null;
                    $calificacion2 = null;
                    $calificacion3 = null;
                    $calificacion4 = null;
                    $calificacion5 = null;
                }
                Mail::send('email/EmailCreacion',
                        ['Ticket' => $ticket,'Asunto' => $Asunto,'Categoria' => $nameCategoria,'Prioridad' => $namePrioridad,
                        'Mensaje' => $Descripcion, 'NombreReportante' => $NombreUsuario, 'Telefono' => $TelefonoUsuario,
                        'Correo' => $CorreUsuario,'AsignadoA' => $nameAsignado,'Estado' => $nameEstado,'Fecha' => $fecha_sistema,'Calificacion' => $calificacion,
                        'Calificacion1' => $calificacion1,'Calificacion2' => $calificacion2,'Calificacion3' => $calificacion3,
                        'Calificacion4' => $calificacion4,'Calificacion5' => $calificacion5],
                        function($msj) use($subject,$for,$cco){
                            $msj->from("soporte.sistemas@cruzrojabogota.org.co","Mesa de Ayuda - Tics");
                            $msj->subject($subject);
                            $msj->to($for);
                            $msj->cc($cco);
                        });
                if(count(Mail::failures()) === 0){
                    $verrors = 'Se creo con éxito el ticket '.$ticket;
                    return redirect($url.'/tickets')->with('mensaje', $verrors);
                }else{
                    $verrors = 'Se creo con éxito el ticket '.$ticket.', pero no pudo ser enviado el correo al usuario';
                    return redirect($url.'/tickets')->with('precaucion', $verrors);
                }

            }else{
                $verrors = array();
                array_push($verrors, 'Hubo un problema al crear el ticket');
                return \Redirect::to($url.'/tickets')->withErrors(['errors' => $verrors])->withInput();
            }
        }else{
            return \Redirect::to($url.'/tickets')->withErrors(['errors' => $verrors])->withInput();
        }
    }

    public function buscarCategoria()
    {

        $data = Input::all();
        $id   = Input::get('id_categoria');
        $NombreUsuario = array();
        $buscarUsuario = Usuarios::BuscarXCategoria($id);
        $NombreUsuario[0] = 'Seleccione: ';
        foreach ($buscarUsuario as $row){
            $NombreUsuario[$row->id] = $row->name;
        }
        return \Response::json(array('valido'=>'true','Usuario'=>$NombreUsuario));

    }

    public function buscarCategoriaRepo()
    {

        $data = Input::all();
        $id   = Input::get('id_categoria');
        $NombreUsuario = array();
        $buscarUsuario = Usuarios::BuscarXCategoria($id);
        $NombreUsuario[0] = 'Seleccione: ';
        foreach ($buscarUsuario as $row){
            $NombreUsuario[$row->id] = $row->nombre;
        }
        return \Response::json(array('valido'=>'true','Usuario'=>$NombreUsuario));

    }

    public function buscarCategoriaUPD()
    {

        $data = Input::all();
        $id   = Input::get('id_categoria');
        $NombreUsuario = array();
        $buscarUsuario = Usuarios::BuscarXCategoria($id);
        $NombreUsuario[0] = 'Seleccione: ';
        foreach ($buscarUsuario as $row){
            $NombreUsuario[$row->id] = $row->nombre;
        }
        return \Response::json(array('valido'=>'true','Usuario'=>$NombreUsuario));

    }

    public function buscarZona()
    {

        $data = Input::all();
        $id   = Input::get('id_zona');
        $NombreSede = array();
        $buscarSede = Usuarios::BuscarXZona($id);
        $NombreSede[0] = 'Seleccione: ';
        foreach ($buscarSede as $row){
            $NombreSede[$row->id] = $row->nombre;
        }
        return \Response::json(array('valido'=>'true','Sedes'=>$NombreSede));

    }

    public function buscarSede()
    {

        $data = Input::all();
        $id   = Input::get('id_sede');
        $NombreArea = array();
        $buscarArea = Usuarios::BuscarXSede($id);
        $NombreArea[0] = 'Seleccione: ';
        foreach ($buscarArea as $row){
            $NombreArea[$row->id] = $row->nombre;
        }
        return \Response::json(array('valido'=>'true','Areas'=>$NombreArea));

    }

    public function actualizarTicket()
    {
        $data = Input::all();
        $creadoPor          = (int)Input::get('IdUsuario');
        $buscarUsuario = Usuarios::BuscarNombre($creadoPor);
        foreach($buscarUsuario as $value){
            $Administrador = (int)$value->administrador;
        }
        $reglas = array(
            'id_prioridad_upd'      =>  'required',
            'id_categoriaupd'       =>  'required',
            'id_usuarioupd'         =>  'required',
            'id_estado_upd'         =>  'required',
            'comentario'            =>  'required',
            'evidencia_upd'         =>  'max:5120'
        );
        $validador = Validator::make($data, $reglas);
        $messages = $validador->messages();
        foreach ($reglas as $key => $value){
            $verrors[$key] = $messages->first($key);
        }
        if($validador->passes()) {

            $idTicket           = (int)Input::get('idT');
            $idTipo             = (int)Input::get('id_tipo_upd');
            $Asunto             = Input::get('asunto_upd');
            $Descripcion        = Input::get('descripcion_upd');
            $NombreUsuario      = Input::get('nombre_usuario_upd');
            $TelefonoUsuario    = Input::get('telefono_usuario_upd');
            $CorreUsuario       = Input::get('correo_usuario_upd');
            $IdZona             = (int)Input::get('id_zona_upd');
            $IdSede             = (int)Input::get('id_sede_upd');
            $IdArea             = (int)Input::get('id_area_upd');
            $Prioridad          = (int)Input::get('id_prioridad_upd');
            $Categoria          = (int)Input::get('id_categoriaupd');
            $AsignadoA          = (int)Input::get('id_usuarioupd');
            $Estado             = (int)Input::get('id_estado_upd');
            $creadoPor          = (int)Input::get('IdUsuario');
            $comentario         = Input::get('comentario');
            $CargoUsuario       = Input::get('cargo_usuario_upd');
            $NombreJefe         = Input::get('nombre_jefe');
            $TelefonoJefe       = Input::get('telefono_jefe');

            $nombreCategoria = Tickets::Categoria($Categoria);
            $nombrePrioridad = Tickets::Prioridad($Prioridad);
            $nombreEstado       = Tickets::Estado($Estado);
            $nombreAsignado     = Usuarios::BuscarNombre($AsignadoA);

            foreach($nombreCategoria as $row){
                $nameCategoria = $row->nombre;
            }
            foreach($nombrePrioridad as $row){
                $namePrioridad = $row->nombre;
            }
            foreach($nombreEstado as $row){
                $nameEstado = $row->name;
            }
            foreach($nombreAsignado as $row){
                $nameAsignado = $row->nombre;
                $emailAsignado = $row->email;
            }

            $actualizarTicket   = Tickets::ActualizarTicket($idTicket,$idTipo,$Asunto,$Descripcion,$NombreUsuario,$TelefonoUsuario,$CorreUsuario,$CargoUsuario,
                                                $IdZona,$IdSede,$IdArea,$Prioridad,$Categoria,$AsignadoA,$Estado,$creadoPor,$comentario,$NombreJefe,$TelefonoJefe);
            if($actualizarTicket){

                $destinationPath = null;
                $filename        = null;
                if (Input::hasFile('evidencia_upd')) {
                    $files = Input::file('evidencia_upd');
                    foreach($files as $file){
                        $destinationPath    = public_path().'/aplicativo/evidencias';
                        $extension          = $file->getClientOriginalExtension();
                        $name               = $file->getClientOriginalName();
                        $nombrearchivo      = pathinfo($name, PATHINFO_FILENAME);
                        $nombrearchivo      = TicketsController::eliminar_tildes($nombrearchivo);
                        $filename           = $nombrearchivo.'_Ticket_'.$idTicket.'.'.$extension;
                        $uploadSuccess      = $file->move($destinationPath, $filename);
                        $archivofoto        = file_get_contents($uploadSuccess);
                        $NombreFoto         = $filename;
                        $actualizarEvidencia = Tickets::Evidencia($idTicket,$NombreFoto);
                    }
                }


                $fecha_sistema  = date('d-m-Y h:i a');
                $fechaCreacion  = date('d-m-Y H:i a', strtotime($fecha_sistema));

                $subject = "Actualización del ticket $idTicket Mesa de ayuda";
                $buscar = strpos($CorreUsuario,';');
                if($buscar === false){
                    $for = "$CorreUsuario";
                }else{
                    $for = array();
                    $for = explode(';',$CorreUsuario);
                }
                // $for = "$CorreUsuario";
                $cco = "$emailAsignado";
                $calificacion = 1;
                if($Estado === 3){
                    $calificacion1 = "<a href='http://192.168.0.116:8080/helpdesk/public/calificarTicket?valor=1&idTicket=$idTicket'><img src='http://192.168.0.116:8080/helpdesk/public/aplicativo/like.png' width='60' height='60'/></a>";
                    $calificacion2 = "<a href='http://192.168.0.116:8080/helpdesk/public/calificarTicket?valor=2&idTicket=$idTicket'><img src='http://192.168.0.116:8080/helpdesk/public/aplicativo/nolike.png' width='60' height='60'/></a>";

                }else{
                    $calificacion = 0;
                    $calificacion1 = null;
                    $calificacion2 = null;

                }

                Mail::send('email/EmailActualizacion',
                        ['Ticket' => $idTicket,'Asunto' => $Asunto,'Categoria' => $nameCategoria,'Prioridad' => $namePrioridad,
                        'Mensaje' => $comentario, 'NombreReportante' => $NombreUsuario, 'Telefono' => $TelefonoUsuario,
                        'Correo' => $CorreUsuario,'AsignadoA' => $nameAsignado,'Estado' => $nameEstado,'Fecha' => $fecha_sistema,'Calificacion' => $calificacion,
                        'Calificacion1' => $calificacion1,'Calificacion2' => $calificacion2],

                        function($msj) use($subject,$for,$cco){
                            $msj->from("soporte@utservisalud.com.co","Mesa de Ayuda Tics - Servisalud QCL");
                            $msj->subject($subject);
                            $msj->to($for);
                            $msj->cc($cco);
                        });

                if(count(Mail::failures()) === 0){
                    $verrors = 'Se actualizo con éxito el ticket '.$idTicket;
                    if($Administrador === 1){
                        return redirect('admin/tickets')->with('mensaje', $verrors);
                    }else{
                        return redirect('user/tickets')->with('mensaje', $verrors);
                    }
                }else{
                    $verrors = 'Se actualizo con éxito el ticket '.$idTicket.', pero no pudo ser enviado el correo al usuario';
                    if($Administrador === 1){
                        return redirect('admin/tickets')->with('precaucion', $verrors);
                    }else{
                        return redirect('user/tickets')->with('precaucion', $verrors);
                    }
                }
            }else{
                $verrors = array();
                array_push($verrors, 'Hubo un problema al actualizar el ticket');
                // return redirect('admin/usuarios')->withErrors(['errors' => $verrors])->withInput();
                if($Administrador === 1){
                    return \Redirect::to('admin/tickets')->withErrors(['errors' => $verrors])->withInput();
                }else{
                    return \Redirect::to('user/tickets')->withErrors(['errors' => $verrors])->withInput();
                }
            }
        }else{
            if($Administrador === 1){
                return \Redirect::to('admin/tickets')->withErrors(['errors' => $verrors])->withInput();
            }else{
                return \Redirect::to('user/tickets')->withErrors(['errors' => $verrors])->withInput();
            }
        }
    }

    public function reporteTickets(){
        $Categoria  = Usuarios::Categoria();
        $NombreCategoria = array();
        $NombreCategoria[''] = 'Seleccione: ';
        foreach ($Categoria as $row){
            $NombreCategoria[$row->id] = $row->nombre;
        }
        $Tipo  = Tickets::ListarTipo();
        $NombreTipo = array();
        $NombreTipo[''] = 'Seleccione: ';
        foreach ($Tipo as $row){
            $NombreTipo[$row->id] = $row->nombre;
        }
        $Prioridad  = Tickets::ListarPrioridad();
        $NombrePrioridad = array();
        $NombrePrioridad[''] = 'Seleccione: ';
        foreach ($Prioridad as $row){
            $NombrePrioridad[$row->id] = $row->nombre;
        }
        $Zonas  = Sedes::Zonas();
        $NombreZona = array();
        $NombreZona[''] = 'Seleccione: ';
        foreach ($Zonas as $row){
            $NombreZona[$row->id] = $row->nombre;
        }

        $NombreUsuario = array();
        $NombreUsuario[''] = 'Seleccione: ';
        $Usuarios = Usuarios::ListarUsuarios();
        foreach ($Usuarios as $row){
            $NombreUsuario[$row->id] = $row->nombre;
        }
        $NombreSede = array();
        $NombreSede[''] = 'Seleccione: ';
        $Sedes  = Sedes::Sedes();
        $NombreSedes = array();
        $NombreSedes[''] = 'Seleccione: ';
        foreach ($Sedes as $row){
            $NombreSedes[$row->id] = $row->nombre;
        }
        $NombreArea = array();
        $NombreArea[''] = 'Seleccione: ';
        $Areas  = Sedes::Areas();
        $NombreAreas = array();
        $NombreAreas[''] = 'Seleccione: ';
        foreach ($Areas as $row){
            $NombreAreas[$row->id] = $row->nombre;
        }

        $Estado  = Tickets::ListarEstadoUpd();
        $NombreEstado = array();
        $NombreEstado[0] = 'Seleccione: ';
        foreach ($Estado as $row){
            $NombreEstado[$row->id] = $row->name;
        }

        $Zonas = Sedes::Zonas();
        $NombreZona = array();
        $NombreZona[''] = 'Seleccione: ';
        foreach ($Zonas as $row){
            $NombreZona[$row->id] = $row->nombre;
        }
        return view('tickets.reporte',['Tipo' => $NombreTipo,'Estado' => $NombreEstado,'Categoria' => $NombreCategoria,
                                        'Usuario' => $NombreUsuario,'Prioridad' => $NombrePrioridad,'Zona' => $NombreZona,
                                        'Sede' => $NombreSedes, 'Area' =>$NombreAreas,'FechaInicio' => null,'FechaFin' => null]);
    }

    public function consultarTickets(){
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
        if($validador->passes()) {
            $idTipo         = Input::get('id_tipo');
            $idCategoria    = Input::get('id_categoria');
            $idUsuarioC     = Input::get('id_creado');
            $idUsuarioA     = Input::get('id_asignado');
            $idPrioridad    = Input::get('id_prioridad');
            $idEstado       = Input::get('id_estado');
            $idZona         = Input::get('id_zona');
            $idSede         = Input::get('id_sede');
            $idArea         = Input::get('id_area');
            $finicio        = Input::get('fechaInicio');
            $ffin           = Input::get('fechaFin');
            $consultaReporte = Tickets::Reporte($idTipo,$idCategoria,$idUsuarioC,$idUsuarioA,$idPrioridad,$idEstado,$idZona,$idSede,$idArea,$finicio,$ffin);

            $resultado = json_decode(json_encode($consultaReporte), true);
            foreach($resultado as &$value) {
                $value['created_at'] = date('d/m/Y h:i A', strtotime($value['created_at']));
                if($value['updated_at']){
                    $value['updated_at'] = date('d/m/Y h:i A', strtotime($value['updated_at']));
                }else{
                    $value['updated_at'] = 'SIN ACTUALIZACIÓN';
                }
                $id_tipo = $value['id_tipo'];
                $nombreTipo = Tickets::Tipo($id_tipo);
                foreach($nombreTipo as $valor){
                    $value['id_tipo'] = strtoupper($valor->nombre);
                }
                $id_categoria = $value['id_categoria'];
                $nombreCategoria = Tickets::Categoria($id_categoria);
                foreach($nombreCategoria as $valor){
                    $value['id_categoria'] = strtoupper($valor->nombre);
                }
                $id_zona = $value['id_zona'];
                $nombreZonaS = Sedes::BuscarZonaID($id_zona);
                foreach($nombreZonaS as $valor){
                    $value['id_zona'] = strtoupper($valor->nombre);
                }
                $id_sede = $value['id_sede'];
                $nombreSedeS = Sedes::BuscarSedeID($id_sede);
                foreach($nombreSedeS as $valor){
                    $value['id_sede'] = strtoupper($valor->nombre);
                }
                $id_area = $value['id_area'];
                $nombreAreaS = Sedes::BuscarAreaID($id_area);
                foreach($nombreAreaS as $valor){
                    $value['id_area'] = strtoupper($valor->nombre);
                }
                $id_prioridad = $value['id_prioridad'];
                $nombrePrioridad = Tickets::Prioridad($id_prioridad);
                foreach($nombrePrioridad as $valor){
                    switch($id_prioridad){
                        Case 1: $value['id_prioridad'] = "<span class='label label-danger' style='font-size:13px;'><b></b>".strtoupper($valor->nombre)."</span>";
                                break;
                        Case 2: $value['id_prioridad'] = "<span class='label label-warning' style='font-size:13px;'><b></b>".strtoupper($valor->nombre)."</span>";
                                break;
                        Case 3: $value['id_prioridad'] = "<span class='label label-success' style='font-size:13px;'><b></b>".strtoupper($valor->nombre)."</span>";
                                break;
                    }
                    // $value['id_prioridad'] = strtoupper($valor->nombre);
                }
                $id_estado = $value['id_estado'];
                $nombreEstado = Tickets::Estado($id_estado);
                foreach($nombreEstado as $valor){
                    $value['id_estado'] = strtoupper($valor->name);
                }
                $creado = $value['creado_por'];
                $buscarUsuario = Usuarios::BuscarNombre($creado);
                foreach($buscarUsuario as $valor){
                    $value['creado_por'] = strtoupper($valor->nombre);
                }
                $asignado = $value['asignado_a'];
                $buscarUsuario = Usuarios::BuscarNombre($asignado);
                foreach($buscarUsuario as $valor){
                    $value['asignado_a'] = strtoupper($valor->nombre);
                }
                $actualizado = $value['actualizado_por'];
                $buscarUsuario = Usuarios::BuscarNombre($actualizado);
                foreach($buscarUsuario as $valor){
                    $value['actualizado_por'] = strtoupper($valor->nombre);
                }
                $value['nombre_usuario'] = strtoupper($value['nombre_usuario']);
                $id_ticket = $value['id'];
                $value['historial'] = null;
                $historialTicket = Tickets::HistorialTicket($id_ticket);
                $contadorHistorial = count($historialTicket);
                if($contadorHistorial > 0){
                    foreach($historialTicket as $row){
                        $value['historial'] .= "- ".$row->observacion." (".$row->nombre_usuario." - ".date('d/m/Y h:i a', strtotime($row->creado)).")\n";
                    }
                }else{
                    $value['historial'] = null;
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


            // return \Response::json(array('valido'=>'true'));
        }else{
            return \Response::json(['valido'=>'false','errors'=>$verrors]);
        }

    }

    public function calificarTicket(){
        $puntuacion = (int)Input::get('valor');
        $idTicket   = (int)Input::get('idTicket');
        $ipCliente  = $_SERVER['REMOTE_ADDR'];
        $UserName   = gethostbyaddr($_SERVER['REMOTE_ADDR']);

        $buscarCalificacion = Tickets::BuscarCalificacion($idTicket,$ipCliente);
        $contadorBusqueda = count($buscarCalificacion);
        if($contadorBusqueda > 0){
            $Mensaje = 'Su valoración ya fue guardada anteriormente.';
        }else{
            $Calificar = Tickets::Calificar($idTicket,$ipCliente,$UserName,$puntuacion);
            if($Calificar){
                $Mensaje = 'Muchas Gracias por su atención y su valoración del servicio.';
            }else{
                $Mensaje = 'Hubo un problema al realizar su calificación, intente de nuevo';
            }

        }

        return view('Email.CalificacionT',['MENSAJE' => $Mensaje]);

    }

    public static function eliminar_tildes($nombrearchivo){

        //Codificamos la cadena en formato utf8 en caso de que nos de errores
        $cadena = utf8_encode($nombrearchivo);

        //Ahora reemplazamos las letras
        $cadena = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $cadena
        );

        $cadena = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $cadena );

        $cadena = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $cadena );

        $cadena = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $cadena );

        $cadena = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $cadena );

        $cadena = str_replace(
            array('ñ', 'Ñ', 'ç', 'Ç'),
            array('n', 'N', 'c', 'C'),
            $cadena
        );

        return $cadena;
    }

    public function BuscarURL($Administrador){
        if($Administrador === 1){
            return 'admin';
        }else{
            return 'user';
        }
    }
}
