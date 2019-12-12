<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MENÚ DE NAVEGACIÓN</li>
            <li class="treeview">
                    <a href="tickets">
                        <i class="fa fa-ticket"></i> <span>Tickets</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="tickets"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                        <li><a href="reporteTickets"><i class="fa fa-list"></i> Reportes</a></li>

                    </ul>
                </li>
                <li class="treeview">
                        <a href="#">
                            <i class="fa fa-list-alt"></i> <span>Control de cambios</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="controlCambios"><i class="fa fa-dashboard"></i> Dahsboard</a></li>
                            <li><a href="reporteCambios"><i class="fa fa-list"></i> Reportes</a></li>

                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-archive"></i> <span>Inventario</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="treeview">
                                <a href="mobile"><i class="fa fa-mobile"></i>Equipos Móviles
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span></a>
                                <ul class="treeview-menu">
                                    <li><a href="mobile"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                                    <li><a href="reportMobile"><i class="fa fa-list"></i>Reportes</a></li>
                                </ul>
                            </li>
                            <li><a href="laptop"><i class="fa fa-laptop"></i> Portátiles</a></li>
                            <li><a href="printers"><i class="fa fa-print"></i> Impresoras</a></li>
                            <li><a href="perifericos"><i class="fa fa-hdd-o"></i> Perifericos</a></li>

                        </ul>
                    </li>
                    {{-- <li>
                        <a href="politicas">
                          <i class="fa fa-list-alt"></i> <span>Polticas TICS</span>

                        </a>
                      </li> --}}
                    @if(Session::get('Administracion') === 1)
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gear"></i> <span>Administración</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="usuarios"><i class="fa fa-user"></i> Usuarios</a></li>
                    {{--  <li><a href="menu"><i class="fa fa-list"></i> Menus</a></li>  --}}
                    <li><a href="roles"><i class="fa fa-user-secret"></i> Roles Y Categoria</a></li>
                    <li><a href="sedes"><i class="fa fa-map"></i> Ubicación</a></li>
                </ul>
            </li>
            @endif

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
