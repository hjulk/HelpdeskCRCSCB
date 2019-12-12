<header class="main-header">

        <nav class="navbar navbar-static-top">
                <div class="navbar navbar-header">
                        <a href="dashboardMonitoreo" class="navbar-brand"><b><i class="fa fa-dashboard"></i>&nbsp;&nbsp;Mesa de Ayuda TIC´S</b></a>

                </div>
            <div class="navbar-custom-menu">

                <ul class="nav navbar-nav">

                    <li class="dropdown user user-menu">
                        <a href="index" class="dropdown-toggle" data-toggle="dropdown">
                                {!! Session::get('ProfilePicMenuM') !!}
                                 <span class="hidden-xs">{!! Session::get('NombreUsuario') !!}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                {{--  <img src="{{asset("assets/$theme/dist/img/user2-160x160.jpg")}}" class="img-circle" alt="User Image">  --}}
                                {!! Session::get('ProfilePicM') !!}
                                     <p>

                                            {!! Session::get('NombreUsuario') !!}
                                    <small>Usuario desde {!! Session::get('FechaCreacion') !!}</small>
                                </p>
                            </li>

                            <li class="user-footer">
                                <div class="pull-right">
                                    <a href="logout" class="btn btn-default btn-flat">Cerrar Sesión</a>
                                </div>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </nav>
    </header>

