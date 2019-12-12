<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Response;
use App\Models\Admin\Sedes;
use App\Models\User\Tickets;
use App\Http\Requests\Validaciones;
use Validator;
use Monolog\Handler\ZendMonitorHandler;
use App\Http\Middleware\VerifyCsrfToken;
use App\Models\Admin\Activo;
use App\Models\Admin\Usuarios;
use Illuminate\Mail\Mailable;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Support\Facades\Mail;


class TicketsUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crearTicket()
    {
        $data = Input::all();
        $reglas = array(
            'id_tipo'           =>  'required',
            'asunto'            =>  'required',
            'descripcion'       =>  'required',
            'nombre_usuario'    =>  'required',
            'telefono_usuario'  =>  'required',
            'correo_usuario'    =>  'required',
            'id_zona'           =>  'required',
            'id_sede'           =>  'required',
            'id_area'           =>  'required',
            'id_prioridad'      =>  'required',
            'id_categoria'      =>  'required',
            'id_usuario'        =>  'required',
            'id_estado'         =>  'required'
        );
        $validador = Validator::make($data, $reglas);
        $messages = $validador->messages();
        foreach ($reglas as $key => $value){
            $verrors[$key] = $messages->first($key);
        }
        if($validador->passes()) {

            $idTipo             = (int)Input::get('id_tipo');
            $Asunto             = Input::get('asunto');
            $Descripcion        = Input::get('descripcion');
            $NombreUsuario      = Input::get('nombre_usuario');
            $TelefonoUsuario    = Input::get('telefono_usuario');
            $CorreUsuario       = Input::get('correo_usuario');
            $IdZona             = (int)Input::get('id_zona');
            $IdSede             = (int)Input::get('id_sede');
            $IdArea             = (int)Input::get('id_area');
            $Prioridad          = (int)Input::get('id_prioridad');
            $Categoria          = (int)Input::get('id_categoria');
            $AsignadoA          = (int)Input::get('id_usuario');
            $Estado             = (int)Input::get('id_estado');
            $creadoPor          = (int)Input::get('IdUsuario');

            $nombreCategoria = Tickets::Categoria($Categoria);
            $nombrePrioridad = Tickets::Prioridad($Prioridad);
            $nombreEstado = Tickets::Estado($Estado);
            $nombreAsignado = Usuarios::BuscarNombre($AsignadoA);

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
            }

            $CrearTicket = Tickets::CrearTicket($idTipo,$Asunto,$Descripcion,$NombreUsuario,$TelefonoUsuario,$CorreUsuario,$CargoUsuario,
            $IdZona,$IdSede,$IdArea,$Prioridad,$Categoria,$AsignadoA,$Estado,$creadoPor);

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
                        $destinationPath    = public_path().'/aplicativo/evidencias';
                        $extension          = $file->getClientOriginalExtension();
                        $name               = $file->getClientOriginalName();
                        $nombrearchivo      = pathinfo($name, PATHINFO_FILENAME);
                        $filename           = $nombrearchivo.'_Ticket_'.$ticket.'.'.$extension;
                        $uploadSuccess      = $file->move($destinationPath, $filename);
                        $archivofoto        = file_get_contents($uploadSuccess);
                        $NombreFoto         = $filename;
                        $actualizarEvidencia = Tickets::Evidencia($ticket,$NombreFoto);
                    }
                }

                date_default_timezone_set('America/Bogota');
                $fecha_sistema  = date('d-m-Y H:i a');
                $fechaCreacion  = date('d-m-Y H:i a', strtotime($fecha_sistema));

                $subject = "Creación ticket Mesa de ayuda";
                $for = "$CorreUsuario";
                Mail::send('email/EmailCreacion',
                        ['Ticket' => $ticket,'Asunto' => $Asunto,'Categoria' => $nameCategoria,'Prioridad' => $namePrioridad,
                        'Mensaje' => $Descripcion, 'NombreReportante' => $NombreUsuario, 'Telefono' => $TelefonoUsuario,
                        'Correo' => $CorreUsuario,'AsignadoA' => $nameAsignado,'Estado' => $nameEstado,'Fecha' => $fechaCreacion],
                        function($msj) use($subject,$for){
                            $msj->from("desarrolladorsenior.tics@gmail.com","Mesa de Ayuda Tics - Servisalud QCL");
                            $msj->subject($subject);
                            $msj->to($for);
                        });

                $verrors = 'Se creo con éxito el ticket '.$ticket;
                return redirect('user/tickets')->with('mensaje', $verrors);
            }else{
                $verrors = array();
                array_push($verrors, 'Hubo un problema al crear el ticket');
                // return redirect('user/usuarios')->withErrors(['errors' => $verrors])->withInput();
                return \Redirect::to('user/tickets')->withErrors(['errors' => $verrors])->withInput();
            }


        }else{
            return \Redirect::to('user/tickets')->withErrors(['errors' => $verrors])->withInput();
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
            $NombreUsuario[$row->id] = $row->nombre;
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
        $reglas = array(
            'id_prioridad_upd'      =>  'required',
            'id_categoriaupd'       =>  'required',
            'id_usuarioupd'         =>  'required',
            'id_estado_upd'         =>  'required',
            'comentario'            =>  'required'
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

            $nombreCategoria = Tickets::Categoria($Categoria);
            $nombrePrioridad = Tickets::Prioridad($Prioridad);
            $nombreEstado = Tickets::Estado($Estado);
            $nombreAsignado = Usuarios::BuscarNombre($AsignadoA);

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
            }

            $actualizarTicket   = Tickets::ActualizarTicket($idTicket,$idTipo,$Asunto,$Descripcion,$NombreUsuario,$TelefonoUsuario,$CorreUsuario,$CargoUsuario,
            $IdZona,$IdSede,$IdArea,$Prioridad,$Categoria,$AsignadoA,$Estado,$creadoPor,$comentario);
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
                        $filename           = $nombrearchivo.'_Ticket_'.$idTicket.'.'.$extension;
                        $uploadSuccess      = $file->move($destinationPath, $filename);
                        $archivofoto        = file_get_contents($uploadSuccess);
                        $NombreFoto         = $filename;
                        $actualizarEvidencia = Tickets::Evidencia($idTicket,$NombreFoto);
                    }
                }

                date_default_timezone_set('America/Bogota');
                $fecha_sistema  = date('d-m-Y H:i a');
                $fechaCreacion  = date('d-m-Y H:i a', strtotime($fecha_sistema));

                $subject = "Actualización del ticket $idTicket Mesa de ayuda";
                $for = "$CorreUsuario";
                Mail::send('email/EmailActualizacion',
                        ['Ticket' => $idTicket,'Asunto' => $Asunto,'Categoria' => $nameCategoria,'Prioridad' => $namePrioridad,
                        'Mensaje' => $comentario, 'NombreReportante' => $NombreUsuario, 'Telefono' => $TelefonoUsuario,
                        'Correo' => $CorreUsuario,'AsignadoA' => $nameAsignado,'Estado' => $nameEstado,'Fecha' => $fechaCreacion],
                        function($msj) use($subject,$for){
                            $msj->from("desarrolladorsenior.tics@gmail.com","Mesa de Ayuda Tics - Servisalud QCL");
                            $msj->subject($subject);
                            $msj->to($for);
                        });

                $verrors = 'Se actualizo con éxito el ticket '.$idTicket;
                return redirect('user/tickets')->with('mensaje', $verrors);
            }else{
                $verrors = array();
                array_push($verrors, 'Hubo un problema al crear el ticket');
                // return redirect('user/usuarios')->withErrors(['errors' => $verrors])->withInput();
                return \Redirect::to('user/tickets')->withErrors(['errors' => $verrors])->withInput();
            }
        }else{
            return \Redirect::to('user/tickets')->withErrors(['errors' => $verrors])->withInput();
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


}
