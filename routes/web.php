<?php
use Illuminate\Support\Facades\Auth;

Route::get('/', 'loginController@index');
Route::post('RecuperarContrasena', 'loginController@RecuperarContrasena')->name('RecuperarContrasena');

// Route::auth();


Route::post('Acceso', 'loginController@Acceso')->name('Acceso');
Auth::routes();

Route::group(['middleware' => 'revalidate'], function () {
    Route::group(['middleware' => 'monitoreo'], function () {
        Route::get('dashboardMonitoreo', 'loginController@dashboardMonitoreo')->name('dashboardMonitoreo');
    });
    Route::group(['middleware' => 'admin'], function () {
        Route::get('admin/dashboard', 'Admin\AdministracionController@dashboard')->name('admin/dashboard');
    });
    Route::group(['middleware' => 'user'], function () {
        Route::get('user/dashboard', 'User\UsuariosController@inicio')->name('user/dashboard');
    });


    // MODULO ADMINISTRACIÓN

    Route::group(['prefix' => 'admin','namespace' => 'Admin','middleware' => 'admin'],function(){
        Route::get('menu','AdministracionController@menu')->name('menu');
        Route::get('sedes','SedesController@sedes')->name('sedes');
        Route::get('roles','RolesController@roles')->name('roles');
        Route::get('dependencias','AdministracionController@dependencias')->name('dependencias');
        Route::get('usuarios','UsuarioController@index')->name('usuarios');
        Route::post('crearRol','RolesController@crearRol')->name('crearRol');
        Route::post('actualizarRol','RolesController@actualizarRol')->name('actualizarRol');
        Route::post('crearCategoria','RolesController@crearCategoria')->name('crearCategoria');
        Route::post('actualizarCategoria','RolesController@actualizarCategoria')->name('actualizarCategoria');
        Route::post('crearUsuario','UsuarioController@crearUsuario')->name('crearUsuario');
        Route::post('actualizarUsuario','UsuarioController@actualizarUsuario')->name('actualizarUsuario');
        Route::post('actualizarUsuarioP','UsuarioController@actualizarUsuarioP')->name('actualizarUsuarioP');
        Route::post('actualizarUsuarioAdmin','UsuarioController@actualizarUsuarioAdmin')->name('actualizarUsuarioAdmin');
        Route::post('crearZona','SedesController@crearZona')->name('crearZona');
        Route::post('actualizarZona','SedesController@actualizarZona')->name('actualizarZona');
        Route::post('crearSede','SedesController@crearSede')->name('crearSede');
        Route::post('actualizarSede','SedesController@actualizarSede')->name('actualizarSede');
        Route::post('crearArea','SedesController@crearArea')->name('crearArea');
        Route::post('actualizarArea','SedesController@actualizarArea')->name('actualizarArea');
        Route::get('tickets','AdministracionController@tickets')->name('tickets');
        Route::post('reabrirTicket','TicketsController@reabrirTicket')->name('reabrirTicket');
        Route::get('reporteTickets','TicketsController@reporteTickets')->name('reporteTickets');
        Route::post('consultarTicket','TicketsController@consultarTickets')->name('consultarTicket');
        Route::get('controlCambios','AdministracionController@controlCambios')->name('controlCambios');
        Route::get('reporteCambios','ControlCambiosController@reporteCambios')->name('reporteCambios');
        Route::post('consultarCambios','ControlCambiosController@consultarCambios')->name('consultarCambios');
        Route::post('reabrirsolicitud','ControlCambiosController@reabrirsolicitud')->name('reabrirsolicitud');
        Route::get('mobile','InventarioController@mobile')->name('mobile');
        Route::get('detalleNovedadM', 'InventarioController@detalleNovedadM')->name('detalleNovedadM');
        Route::get('detalleResponsableM', 'InventarioController@detalleResponsableM')->name('detalleResponsableM');
        Route::get('laptop','InventarioController@laptop')->name('laptop');
        Route::get('printers','InventarioController@printers')->name('printers');
        Route::get('perifericos','InventarioController@perifericos')->name('perifericos');

        Route::get('/logout', function() {
            Auth::logout();
            Session::flush();
            // Session::destroy();
            return Redirect::to('/')->with('mensaje_login', 'Salida Segura');
        });
    });

    // MODULO USUARIOS

    Route::group(['prefix' => 'user','namespace' => 'User','middleware' => 'user'],function(){
        Route::get('tickets','UsuariosController@tickets')->name('tickets');
        Route::get('reporteTickets','TicketsUserController@reporteTickets')->name('reporteTickets');
        Route::post('consultarTicket', 'TicketsUserController@consultarTickets')->name('consultarTicket');
        Route::get('profile', 'UsuariosController@profile')->name('profile');
        Route::post('actualizarUsuario', 'UsuariosController@actualizarUsuario')->name('actualizarUsuario');
        Route::get('controlCambios','UsuariosController@controlCambios')->name('controlCambios');
        Route::get('reporteCambios','ControlCambiosController@reporteCambios')->name('reporteCambios');
        Route::post('consultarCambios','ControlCambiosController@consultarCambios')->name('consultarCambios');
        Route::get('mobile','InventarioController@mobile')->name('mobile');
        Route::get('laptop','InventarioController@laptop')->name('laptop');
        Route::get('printers','InventarioController@printers')->name('printers');
        Route::get('perifericos','InventarioController@perifericos')->name('perifericos');
        Route::get('/logout', function() {
            Auth::logout();
            Session::flush();
            // Session::destroy();
            return Redirect::to('/')->with('mensaje_login', 'Salida Segura');
        });
    });

    Route::get('/logout', function() {
        Auth::logout();
        Session::flush();
        // Session::destroy();

        return Redirect::to('/')->with('mensaje', 'Salida Segura');
    });

    // MODULO TICKETS

    Route::post('crearTicket', 'TicketsController@crearTicket')->name('crearTicket');
    Route::get('buscarCategoria', 'TicketsController@buscarCategoria')->name('buscarCategoria');
    Route::get('buscarCategoriaRepo','TicketsController@buscarCategoriaRepo')->name('buscarCategoriaRepo');
    Route::get('buscarCategoriaUPD', 'TicketsController@buscarCategoriaUPD')->name('buscarCategoriaUPD');
    Route::get('buscarZona', 'TicketsController@buscarZona')->name('buscarZona');
    Route::get('buscarSede', 'TicketsController@buscarSede')->name('buscarSede');
    Route::post('actualizarTicket', 'TicketsController@actualizarTicket')->name('actualizarTicket');
    Route::any('calificarTicket', 'TicketsController@calificarTicket')->name('calificarTicket');

    // MODULO INVENTARIOS

    Route::post('asignacionMovil', 'InventarioController@asignacionMovil')->name('asignacionMovil');
    Route::post('actualizacionMovil', 'InventarioController@actualizacionMovil')->name('actualizacionMovil');
    Route::post('asignacionResponsableMovil', 'InventarioController@asignacionResponsableMovil')->name('asignacionResponsableMovil');
    Route::post('actualizarResponsableMovil', 'InventarioController@actualizarResponsableMovil')->name('actualizarResponsableMovil');
    Route::post('agregarNovedadMovil', 'InventarioController@agregarNovedadMovil')->name('agregarNovedadMovil');
    Route::post('actualizarNovedadMobile', 'InventarioController@actualizarNovedadMobile')->name('actualizarNovedadMobile');
    Route::get('desactivarResponsable', 'InventarioController@desctivarResponsableMovil')->name('desactivarResponsable');

});
