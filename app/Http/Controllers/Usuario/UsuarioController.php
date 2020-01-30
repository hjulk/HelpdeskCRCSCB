<?php

namespace App\Http\Controllers\Usuario;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\Admin\Sedes;
use App\Models\Helpdesk\Tickets;
use App\Models\Admin\Roles;
use Illuminate\Support\Facades\Validator;
use App\Models\HelpDesk\Inventario;
use App\Models\Admin\Usuarios;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Illuminate\Support\Facades\Redirect;

class UsuarioController extends Controller
{

    public function inicio()
    {
        $Sedes  = Tickets::Sedes();
        $NombreSede = array();
        $NombreSede[''] = 'Seleccione: ';
        foreach ($Sedes as $row){
            $NombreSede[$row->id] = $row->name;
        }

        $Areas  = Sedes::Areas();
        $NombreArea = array();
        $NombreArea[''] = 'Seleccione: ';

        $Tipo  = Tickets::ListarTipo();
        $NombreTipo = array();
        $NombreTipo[''] = 'Seleccione: ';
        foreach ($Tipo as $row){
            $NombreTipo[$row->id] = $row->name;
        }
        $Categoria  = Roles::ListarCategorias();
        $NombreCategoria = array();
        $NombreCategoria[''] = 'Seleccione: ';
        foreach ($Categoria as $row){
            $NombreCategoria[$row->id] = $row->name;
        }
        $Recurrente = Tickets::ListarRecurrentes();
        $TicketRecurrente = array();
        $TicketRecurrente[''] = 'Seleccione: ';
        foreach ($Recurrente as $row){
            $TicketRecurrente[$row->id] = $row->nombre;
        }
        return view('UsuarioFinal.crearTicket',['Sedes' => $NombreSede,'Tipo' => $NombreTipo,'TicketRecurrente' => $TicketRecurrente,'Categoria' => $NombreCategoria,
                                        'Areas' => $NombreArea]);
    }

    public function nuevaSolicitud(){
        $data = Input::all();
        $reglas = array(
            'kind_id'           => 'required',
            'nombre_usuario'    => 'required',
            'description'       => 'required',
            'telefono_usuario'  => 'required',
            'correo_usuario'    => 'required',
            'project_id'        => 'required',
            'area'              => 'required'

        );
        $validador = Validator::make($data, $reglas);
        $messages = $validador->messages();
        foreach ($reglas as $key => $value){
            $verrors[$key] = $messages->first($key);
        }
        if($validador->passes()) {
            $idTipo             = (int)Input::get('kind_id');

            $Descripcion        = Input::get('description');
            $NombreUsuario      = Input::get('nombre_usuario');
            $TelefonoUsuario    = Input::get('telefono_usuario');
            $CorreUsuario       = Input::get('correo_usuario');
            $IdSede             = (int)Input::get('project_id');
            $IdArea             = (int)Input::get('area');
            $BuscarArea         = Sedes::BuscarAreaId($IdArea);
            foreach($BuscarArea as $row){
                $Area           = $row->name;
            }
            // $Area               = Input::get('dependencia');
            $idAsunto           = (int)Input::get('asunto');
            if($idAsunto === 1){
                $Prioridad      = 2;
                $Categoria      = 4;
                $Asunto         = Input::get('title');
            }else{
                $buscardatos = Tickets::ListarRecurrentesId($idAsunto);
                if($buscardatos){
                    foreach($buscardatos as $row){
                        $Prioridad = (int)$row->priority_id;
                        $Categoria = (int)$row->category_id;
                        $Asunto    = $row->nombre;
                    }
                }else{
                    $Prioridad          = 2;
                    $Categoria          = 4;
                    $Asunto             = Input::get('title');
                }
            }

            $AsignadoA          = 44;
            $Estado             = 2;
            $creadoPor          = 31;
            // dd($Prioridad,$Categoria);
            $nameCategoria = 'Mesa de Ayuda';
            $namePrioridad = 'Media';
            $nameEstado = 'Pendiente';
            $nameAsignado = 'Soporte Mesa de Ayuda';
            $emailAsignado = 'soporte.sistemas@cruzrojabogota.org.co';
            $ticketUser = 0;

            $CrearTicket = Tickets::CrearTicket($idTipo,$Asunto,$Descripcion,$NombreUsuario,$TelefonoUsuario,$CorreUsuario,
                                                $IdSede,$Area,$Prioridad,$Categoria,$AsignadoA,$Estado,$creadoPor,$ticketUser);

            if($CrearTicket){
                $buscarUltimo = Tickets::BuscarLastTicket($creadoPor);
                foreach($buscarUltimo as $row){
                    $ticket = $row->id;
                }
                Tickets::CrearTicketAsignado($ticket,$Asunto,$Descripcion,$creadoPor,$AsignadoA);
                $destinationPath = null;
                $filename        = null;
                if (Input::hasFile('evidencia')) {
                    $files = Input::file('evidencia');
                    foreach($files as $file){
                        $destinationPath    = public_path().'/assets/dist/img/evidencias';
                        $extension          = $file->getClientOriginalExtension();
                        $name               = $file->getClientOriginalName();
                        $nombrearchivo      = pathinfo($name, PATHINFO_FILENAME);
                        $nombrearchivo      = UsuarioController::eliminar_tildes($nombrearchivo);
                        $filename           = $nombrearchivo.'_Ticket_'.$ticket.'.'.$extension;
                        $uploadSuccess      = $file->move($destinationPath, $filename);
                        $archivofoto        = file_get_contents($uploadSuccess);
                        $NombreFoto         = $filename;
                        $actualizarEvidencia = Tickets::Evidencia($ticket,$NombreFoto);
                    }
                }

                $BuscarInfoUsuario = Usuarios::BuscarNombre($AsignadoA);
                foreach($BuscarInfoUsuario as $row){
                    $NombreAsignado = $row->name;
                }
                $nombreCreador = 'Soporte';
                $Comentario = "Creación de Ticket y asignado a $NombreAsignado";
                Tickets::HistorialCreacion($ticket,$Comentario,$Estado,$creadoPor,$nombreCreador);
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
                // if(count(Mail::failures()) === 0){
                //     return view('crearTicketMensaje',['Ticket' => $ticket]);
                // }else{
                //     return view('crearTicketMensaje',['Ticket' => $ticket]);
                // }
                if(count(Mail::failures()) === 0){
                    $verrors = 'Se creo con éxito el ticket '.$ticket.'\n Por favor revise la información del ticket que fue enviada al correo registrado para realizar su respectivo seguimiento.';
                    return redirect('usuario/crearTicket')->with('mensaje', $verrors);
                }else{
                    $verrors = 'Se creo con éxito el ticket '.$ticket.', pero no pudo ser enviado el correo al usuario';
                    return redirect('usuario/crearTicket')->with('precaucion', $verrors);
                }
            }else{
                $verrors = array();
                array_push($verrors, 'Hubo un problema al crear el ticket');
                return Redirect::to('usuario/crearTicket')->withErrors(['errors' => $verrors])->withInput();
            }
        }else{
            return Redirect::to('usuario/crearTicket')->withErrors(['errors' => $verrors])->withInput();
            // return redirect('usuario/crearTicket')->withErrors(['errors' => $verrors])->withInput();
        }
    }

    public static function eliminar_tildes($nombrearchivo){

        //Codificamos la cadena en formato utf8 en caso de que nos de errores
        // $cadena = utf8_encode($nombrearchivo);
        $cadena = $nombrearchivo;
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

        $cadena = str_replace(
            array(' ', '-'),
            array('_', '_'),
            $cadena
        );

        return $cadena;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
