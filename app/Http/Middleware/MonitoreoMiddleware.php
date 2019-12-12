<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use App\Models\Admin\Usuarios;

class MonitoreoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $idUsuario = Session::get('IdUsuario');
        if($idUsuario){
            $Usuario = Usuarios::BuscarNombre($idUsuario);
            foreach($Usuario as $value){
                $rol = $value->rol_id;
            }
            if (($rol === 2) && ($rol != 3) && ($rol != 4))
                return redirect('/user/dashboard');
            if($rol === 6)
                return $next($request);
            if($rol === 1)
                return redirect('/admin/dashboard');
        }else{
            return redirect('/');
        }
    }
}
