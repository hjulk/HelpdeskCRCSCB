@extends("theme.$theme.layout")

@section('titulo')
Dahsboard
@endsection

@section('contenido')
@include('Modals.ModalGraficas')

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong>Dashboard Tickets</strong></h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>

                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="info-box bg-aqua">

                                <span class="info-box-icon"><i class="fa fa-spinner fa-pulse"></i></span>

                                <div class="info-box-content">
                                    <a href="tickets">
                                        <span class="info-box-text"><font style="font-size: 20px;color:white;">En Desarrollo</font></span>
                                        <span class="info-box-number"><font style="font-size: 36px;color:white;">{{ $EnDesarrollo }}</font></span>
                                    </a>
                                </div>

                            </div>

                            <div class="info-box bg-red">
                                <span class="info-box-icon"><i class="fa fa-exclamation-triangle faa-ring animated fa-fw"></i></span>

                                <div class="info-box-content">
                                    <a href="tickets">
                                        <span class="info-box-text"><font style="font-size: 20px;color:white;">Pendientes</font></span>
                                        <span class="info-box-number"><font style="font-size: 36px;color:white;">{{ $Pendientes }}</font></span>
                                    </a>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <div class="info-box bg-green">
                                <span class="info-box-icon"><i class="fa fa-trophy faa-burst animated"></i></span>

                                <div class="info-box-content">
                                    <a href="tickets">
                                        <span class="info-box-text"><font style="font-size: 20px;color:white;">Terminados</font></span>
                                        <span class="info-box-number"><font style="font-size: 36px;color:white;">{{ $Terminados }}</font></span>
                                    </a>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <div class="info-box bg-yellow">
                                <span class="info-box-icon"><i class="fa fa-ban faa-passing animated"></i></span>

                                <div class="info-box-content">
                                    <a href="tickets">
                                        <span class="info-box-text"><font style="font-size: 20px;color:white;">Cancelados</font></span>
                                        <span class="info-box-number"><font style="font-size: 36px;color:white;">{{ $Cancelados }}</font></span>
                                    </a>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class='panel panel-default'>
                                        <div class='panel-body'>
                                            <div id='barras' style="height: -webkit-fill-available; width: -webkit-fill-available;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class='panel panel-default'>
                                        <div class='panel-body'>
                                            <div id='graficas' style="height: -webkit-fill-available; width: -webkit-fill-available;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- /.progress-group -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- ./box-body -->

                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>

    <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><strong>Dashboard Control de Cambios</strong></h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>

                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="info-box bg-aqua">
                                    <span class="info-box-icon"><i class="fa fa-spinner fa-pulse"></i></span>

                                    <div class="info-box-content">
                                        <a href="controlCambios">
                                            <span class="info-box-text"><font style="font-size: 20px;color:white;">En Desarrollo</font></span>
                                            <span class="info-box-number"><font style="font-size: 36px;color:white;">{{ $EnDesarrolloC }}</font></span>
                                        </a>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <div class="info-box bg-red">
                                    <span class="info-box-icon"><i class="fa fa-exclamation-triangle faa-ring animated fa-fw"></i></span>

                                    <div class="info-box-content">
                                        <a href="controlCambios">
                                            <span class="info-box-text"><font style="font-size: 20px;color:white;">Pendientes</font></span>
                                            <span class="info-box-number"><font style="font-size: 36px;color:white;">{{ $PendientesC }}</font></span>
                                        </a>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <div class="info-box bg-green">
                                    <span class="info-box-icon"><i class="fa fa-trophy faa-burst animated"></i></span>

                                    <div class="info-box-content">
                                        <a href="controlCambios">
                                            <span class="info-box-text"><font style="font-size: 20px;color:white;">Terminados</font></span>
                                            <span class="info-box-number"><font style="font-size: 36px;color:white;">{{ $TerminadosC }}</font></span>
                                        </a>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <div class="info-box bg-yellow">
                                    <span class="info-box-icon"><i class="fa fa-ban faa-passing animated"></i></span>

                                    <div class="info-box-content">
                                        <a href="controlCambios">
                                            <span class="info-box-text"><font style="font-size: 20px;color:white;">Cancelados</font></span>
                                            <span class="info-box-number"><font style="font-size: 36px;color:white;">{{ $CanceladosC }}</font></span>
                                        </a>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class='panel panel-default'>
                                            <div class='panel-body'>
                                                <div id='barrasC' style="height: -webkit-fill-available; width: -webkit-fill-available;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class='panel panel-default'>
                                            <div class='panel-body'>
                                                <div id='graficasC' style="height: -webkit-fill-available; width: -webkit-fill-available;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- /.progress-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- ./box-body -->
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>

    @endsection

    @section('scripts')
    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v3.3"></script>

    <script asyn src="https://livegap.com/charts/js/webfont.js"></script>
    <script src="https://livegap.com/charts/js/Chart.min.js"></script>
    <script src="{{asset("assets/$theme/Highcharts/code/modules/exporting.js")}}" type="text/javascript"></script>
        <script src="{{asset("assets/$theme/Highcharts/code/highcharts.js")}}" type="text/javascript"></script>
        <script src="{{asset("assets/$theme/Highcharts/code/highcharts-more.js")}}" type="text/javascript"></script>
        <script src="{{asset("assets/$theme/Highcharts/code/highcharts.js")}}" type="text/javascript"></script>
        <script src="{{asset("assets/$theme/Highcharts/code/highcharts-3d.js")}}" type="text/javascript"></script>
        <script src="{{asset("assets/$theme/Highcharts/code/modules/exporting.js")}}" type="text/javascript"></script>
        <script src="{{asset("assets/$theme/Highcharts/code/modules/export-data.js")}}" type="text/javascript"></script>
    <script src="{{asset("assets/$theme/dist/js/dashboard.js")}}"></script>
    <script>

            Highcharts.chart('barras', {
                chart: {
                    type: 'column',
                },
                title: {
                    text: 'Tickets Gestionados por Mes'
                },

                colors:[
                        '#7cb5ec',
                        '#f7a35c'
                        ],
                xAxis: {
                    categories: [
                        @if($MesGraficas)
                        @foreach($MesGraficas as $valor)
                            '{{$valor['nombre']}}' {{$valor['separador']}}
                        @endforeach
                        @endif
                    ],
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Numero de Tickets'
                    }
                },
                tooltip: {


                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Incidentes',
                    data: [
                        @if($MesGraficas)
                        @foreach($MesGraficas as $valor)
                            {{$valor['incidentes']}} {{$valor['separador']}}
                        @endforeach
                        @endif
                ]
                }, {
                    name: 'Requerimientos',
                    data: [
                        @if($MesGraficas)
                        @foreach($MesGraficas as $valor)
                            {{$valor['requerimientos']}} {{$valor['separador']}}
                        @endforeach
                        @endif
                ]
                }]
            });

            Highcharts.chart('graficas', {
                chart: {
                    type: 'pie',
                    options3d: {
                        enabled: true,
                        alpha: 45,
                        beta: 0
                    }
                },
                colors:[

                    '#FE9129',
                    '#8B103E',
                    '#64D9A8',
                    '#33B2E3',
                    '#FF333F'
                ],
                title: {
                    text: 'Tickets Gestionados por SubArea'
                },

                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        depth: 35,
                        dataLabels: {
                            enabled: true,
                            format: '{point.name}'
                        }
                    }
                },
                series: [{
                    type: 'pie',
                    name: 'Tickets',
                    data: [

                        ['Infraestructura', {{ $Infraestructura }}],
                        ['Aplicaciones', {{ $Aplicaciones }}],
                        ['Redes', {{ $Redes }}],
                        ['Desarrollo', {{ $Desarrollo }}],
                        ['Soporte', {{ $Soporte }}]
                    ]
                }]
            });
    </script>

    <script>

            Highcharts.chart('barrasC', {
                chart: {
                    type: 'column',
                },
                title: {
                    text: 'Solicitudes Gestionadas Por Mes Según Impacto'
                },

                colors:[
                        '#f56954',
                        '#f39c12',
                        '#00a65a'
                        ],
                xAxis: {
                    categories: [
                        @if($MesGraficasC)
                        @foreach($MesGraficasC as $valor)
                            '{{$valor['nombre']}}' {{$valor['separador']}}
                        @endforeach
                        @endif
                    ],
                    crosshair: true
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Numero de Solicitudes'
                    }
                },
                tooltip: {


                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Alto',
                    data: [
                        @if($MesGraficasC)
                        @foreach($MesGraficasC as $valor)
                            {{$valor['alto']}} {{$valor['separador']}}
                        @endforeach
                        @endif
                ]
                }, {
                    name: 'Medio',
                    data: [
                        @if($MesGraficasC)
                        @foreach($MesGraficasC as $valor)
                            {{$valor['medio']}} {{$valor['separador']}}
                        @endforeach
                        @endif
                ]
                },
                {
                    name: 'Bajo',
                    data: [
                        @if($MesGraficasC)
                        @foreach($MesGraficasC as $valor)
                            {{$valor['bajo']}} {{$valor['separador']}}
                        @endforeach
                        @endif
                ]
                }]
            });

            Highcharts.chart('graficasC', {
                chart: {
                    type: 'pie',
                    options3d: {
                        enabled: true,
                        alpha: 45,
                        beta: 0
                    }
                },
                colors:[

                    '#FE9129',
                    '#8B103E',
                    '#64D9A8',
                    '#33B2E3',
                    '#FF333F'
                ],
                title: {
                    text: 'Solicitudes Gestionadas por SubArea'
                },

                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        depth: 35,
                        dataLabels: {
                            enabled: true,
                            format: '{point.name}'
                        }
                    }
                },
                series: [{
                    type: 'pie',
                    name: 'Tickets',
                    data: [

                        ['Infraestructura', {{ $InfraestructuraC }}],
                        ['Aplicaciones', {{ $AplicacionesC }}],
                        ['Redes', {{ $RedesC }}],
                        ['Desarrollo', {{ $DesarrolloC }}],
                        ['Soporte', {{ $SoporteC }}]
                    ]
                }]
            });
        </script>


    @endsection
