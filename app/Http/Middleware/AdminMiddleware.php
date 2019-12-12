<?php

namespace App\Http\Middleware;

use App\Models\Admin\Usuarios;
use Closure;
use Illuminate\Support\Facades\Session;


class AdminMiddleware
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
            if ($rol === 1)
                return $next($request);
            if($rol === 5)
                return redirect('dashboardMonitoreo');
            return redirect('/user/dashboard');
        }else{
            return redirect('/');
        }

    }
}
