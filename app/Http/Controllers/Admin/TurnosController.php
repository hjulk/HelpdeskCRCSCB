<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Usuarios;
use App\Models\Admin\Sedes;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Http\Requests\Validaciones;
use Validator;
use Monolog\Handler\ZendMonitorHandler;
use App\Http\Middleware\VerifyCsrfToken;

class TurnosController extends Controller
{
    public function turnos(){
        $Turnos         = Usuarios::ListarTurnos();
        $ListarTurnos   = array();
        $cont           = 0;
        foreach($Turnos as $row){
            $ListarTurnos[$cont]['id']              = (int)$row->id;
            $ListarTurnos[$cont]['agente1']         = (int)$row->agente1;
            $agente1 = (int)$row->agente1;
            $BuscarNombre = Usuarios::BuscarNombre($agente1);
            foreach($BuscarNombre as $value){
                $ListarTurnos[$cont]['nombre_agente1'] = $value->name;
            }
            $ListarTurnos[$cont]['agente2']         = (int)$row->agente2;
            $agente2 = (int)$row->agente2;
            $BuscarNombre = Usuarios::BuscarNombre($agente2);
            foreach($BuscarNombre as $value){
                $ListarTurnos[$cont]['nombre_agente2'] = $value->name;
            }
            $ListarTurnos[$cont]['fecha_inicial']   = date('d/m/Y h:i A', strtotime($row->fecha_inicial));
            $ListarTurnos[$cont]['fecha_final']     = date('d/m/Y h:i A', strtotime($row->fecha_final));
            $ListarTurnos[$cont]['id_sede']         = (int)$row->id_sede;
            $IdSede = (int)$row->id_sede;
            $BuscarSede = Sedes::BuscarSedeID($IdSede);
            foreach($BuscarSede as $value){
                $ListarTurnos[$cont]['sede'] = $value->name;
            }
            $ListarTurnos[$cont]['id_horario']      = (int)$row->id_horario;
            $IdHorario = (int)$row->id_horario;
            $BuscarSede = Usuarios::BuscarHorarioID($IdHorario);
            foreach($BuscarSede as $value){
                $ListarTurnos[$cont]['horario'] = $value->name;
            }
            $ListarTurnos[$cont]['disponible']      = $row->disponible;
            $cont++;
        }

        $ListaHorario     = Usuarios::ListarHorarios();
        $Horario = array();
        $Horario[''] = 'Seleccione: ';
        foreach ($ListaHorario as $row){
            $Horario[$row->id] = $row->name;
        }

        $ListaSede     = Usuarios::ListarSedesTurno();
        $Sede = array();
        $Sede[''] = 'Seleccione: ';
        foreach ($ListaSede as $row){
            $Sede[$row->id] = $row->name;
        }

        $ListaAgente     = Usuarios::ListarUsuariosTurno();
        $Agente = array();
        $Agente[''] = 'Seleccione: ';
        foreach ($ListaAgente as $row){
            $Agente[$row->id] = $row->name;
        }

        $Disponibilidad = array();
        $Disponibilidad[''] = 'Seleccione: ';
        $Disponibilidad['DISPONIBILIDAD']   = 'DISPONIBILIDAD';
        $Disponibilidad['MESA DE AYUDA']    = 'MESA DE AYUDA';

        return view('admin.Turnos',['Turnos' => $ListarTurnos,'Horario' => $Horario,'Sede' => $Sede,'Agente' => $Agente,
                                    'Disponibilidad' => $Disponibilidad]);
    }
    public function crearTurno(){
        return view('admin.Turnos');
    }
    public function actualizarTurno(){
        return view('admin.Turnos');
    }
}
