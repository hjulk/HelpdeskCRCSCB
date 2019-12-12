<?php

namespace App\Http\Middleware;

use App\Models\Admin\Usuarios;
use Closure;
use Illuminate\Support\Facades\Session;


class UserMiddleware
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
                $is_admin = $value->administrador;
                $rol = $value->id_rol;
            }
            if (($is_admin === 2) && ($rol != 5))
                return $next($request);
            if($rol === 5)
                return redirect('dashboardMonitoreo');
            if($is_admin === 1)
                return redirect('/admin/dashboard');
        }else{
            return redirect('/');
        }

    }
}
