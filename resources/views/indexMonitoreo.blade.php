@extends("theme.$theme.layoutMonitoreo")

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
                                    <a data-toggle="modal" href="#modal-desarrollo">
                                        <span class="info-box-text"><font style="font-size: 20px;color:white;">En Desarrollo</font></span>
                                        <span class="info-box-number"><font style="font-size: 36px;color:white;">{{ $EnDesarrollo }}</font></span>
                                    </a>
                                </div>

                            </div>

                            <div class="info-box bg-red">
                                <span class="info-box-icon"><i class="fa fa-exclamation-triangle faa-ring animated fa-fw"></i></span>

                                <div class="info-box-content">
                                    <a data-toggle="modal" href="#modal-pendientes">
                                        <span class="info-box-text"><font style="font-size: 20px;color:white;">Pendientes</font></span>
                                        <span class="info-box-number"><font style="font-size: 36px;color:white;">{{ $Pendientes }}</font></span>
                                    </a>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <div class="info-box bg-green">
                                <span class="info-box-icon"><i class="fa fa-trophy faa-burst animated"></i></span>

                                <div class="info-box-content">
                                    <a data-toggle="modal" href="#modal-terminados">
                                        <span class="info-box-text"><font style="font-size: 20px;color:white;">Terminados</font></span>
                                        <span class="info-box-number"><font style="font-size: 36px;color:white;">{{ $Terminados }}</font></span>
                                    </a>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <div class="info-box bg-yellow">
                                <span class="info-box-icon"><i class="fa fa-ban faa-passing animated"></i></span>

                                <div class="info-box-content">
                                    <a data-toggle="modal" href="#modal-cancelados">
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
                                    <a data-toggle="modal" href="#modal-desarrolloC">
                                        <span class="info-box-text"><font style="font-size: 20px;color:white;">En Desarrollo</font></span>
                                        <span class="info-box-number"><font style="font-size: 36px;color:white;">{{ $EnDesarrolloC }}</font></span>
                                    </a>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <div class="info-box bg-red">
                                <span class="info-box-icon"><i class="fa fa-exclamation-triangle faa-ring animated fa-fw"></i></span>

                                <div class="info-box-content">
                                    <a data-toggle="modal" href="#modal-pendientesC">
                                        <span class="info-box-text"><font style="font-size: 20px;color:white;">Pendientes</font></span>
                                        <span class="info-box-number"><font style="font-size: 36px;color:white;">{{ $PendientesC }}</font></span>
                                    </a>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <div class="info-box bg-green">
                                <span class="info-box-icon"><i class="fa fa-trophy faa-burst animated"></i></span>

                                <div class="info-box-content">
                                    <a data-toggle="modal" href="#modal-terminadosC">
                                        <span class="info-box-text"><font style="font-size: 20px;color:white;">Terminados</font></span>
                                        <span class="info-box-number"><font style="font-size: 36px;color:white;">{{ $TerminadosC }}</font></span>
                                    </a>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <div class="info-box bg-yellow">
                                <span class="info-box-icon"><i class="fa fa-ban faa-passing animated"></i></span>

                                <div class="info-box-content">
                                    <a data-toggle="modal" href="#modal-canceladosC">
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
    <script>setTimeout('document.location.reload()',10000); </script>
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
                text: 'Solicitudes Gestionadas por mes según Impacto'
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
    <script>
        $(document).ready(function () {
            Highcharts.chart('terminados', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Tickets Terminados por Usuario'
            },
            colors:[
                '#00a65a'
                ],
            xAxis: {
                categories: [
                    @if($Gestion)
                    @foreach($Gestion as $valor)
                        '{{$valor['nombre']}}' {{$valor['separador']}}
                    @endforeach
                    @endif
                    ]


            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Nro de Tickets'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y} Tickets</b></td></tr>',
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
                name: 'Terminados',
                data: [
                    @if($Gestion)
                    @foreach($Gestion as $valor)
                        {{$valor['terminados']}} {{$valor['separador']}}
                    @endforeach
                    @endif
                ]

            }]
        });
    Highcharts.chart('desarrollo', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Tickets En Desarrollo por Usuario'
        },
        colors:[
            '#00c0ef'
            ],
        xAxis: {
            categories: [
                    @if($Gestion)
                    @foreach($Gestion as $valor)
                        '{{$valor['nombre']}}' {{$valor['separador']}}
                    @endforeach
                    @endif
                    ]

        },
        yAxis: {
            min: 0,
            title: {
                text: 'Nro de Tickets'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y} Tickets</b></td></tr>',
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
            name: 'En Desarrollo',
            data: [
                @if($Gestion)
                @foreach($Gestion as $valor)
                    {{$valor['desarrollo']}} {{$valor['separador']}}
                @endforeach
                @endif
            ]

        }]
    });
    Highcharts.chart('pendientes', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Tickets Pendientes por Usuario'
        },
        colors:[
            '#f56954'
            ],
        xAxis: {
            categories: [
                    @if($Gestion)
                    @foreach($Gestion as $valor)
                        '{{$valor['nombre']}}' {{$valor['separador']}}
                    @endforeach
                    @endif
                    ]

        },
        yAxis: {
            min: 0,
            title: {
                text: 'Nro de Tickets'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y} Tickets</b></td></tr>',
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
            name: 'Pendientes',
            data: [
                    @if($Gestion)
                    @foreach($Gestion as $valor)
                        {{$valor['pendientes']}} {{$valor['separador']}}
                    @endforeach
                    @endif
                ]

        }]
    });
    Highcharts.chart('cancelados', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Tickets Cancelados por Usuario'
        },
        colors:[
            '#f39c12'
            ],
        xAxis: {
            categories: [
                @if($Gestion)
                @foreach($Gestion as $valor)
                    '{{$valor['nombre']}}' {{$valor['separador']}}
                @endforeach
                @endif
                ]

        },
        yAxis: {
            min: 0,
            title: {
                text: 'Nro de Tickets'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y} Tickets</b></td></tr>',
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
            name: 'Cancelados',
            data: [
                    @if($Gestion)
                    @foreach($Gestion as $valor)
                        {{$valor['cancelados']}} {{$valor['separador']}}
                    @endforeach
                    @endif
                ]

        }]
    });
});
    </script>
    <script>
        $(document).ready(function () {
            Highcharts.chart('terminadosC', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Solicitudes Terminadas por Usuario'
            },
            colors:[
                '#00a65a'
                ],
            xAxis: {
                categories: [
                    @if($GestionC)
                    @foreach($GestionC as $valor)
                        '{{$valor['nombre']}}' {{$valor['separador']}}
                    @endforeach
                    @endif
                    ]


            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Nro de Solicitudes'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y} Tickets</b></td></tr>',
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
                name: 'Terminados',
                data: [
                    @if($GestionC)
                    @foreach($GestionC as $valor)
                        {{$valor['terminados']}} {{$valor['separador']}}
                    @endforeach
                    @endif
                ]

                }]
            });
            Highcharts.chart('desarrolloC', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Solicitudes En Desarrollo por Usuario'
                },
                colors:[
                    '#00c0ef'
                    ],
                xAxis: {
                    categories: [
                            @if($GestionC)
                            @foreach($GestionC as $valor)
                                '{{$valor['nombre']}}' {{$valor['separador']}}
                            @endforeach
                            @endif
                            ]

                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Nro de Solicitudes'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y} Tickets</b></td></tr>',
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
                    name: 'En Desarrollo',
                    data: [
                        @if($GestionC)
                        @foreach($GestionC as $valor)
                            {{$valor['desarrollo']}} {{$valor['separador']}}
                        @endforeach
                        @endif
                    ]

                }]
            });
            Highcharts.chart('pendientesC', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Solicitudes Pendientes por Usuario'
                },
                colors:[
                    '#f56954'
                    ],
                xAxis: {
                    categories: [
                            @if($GestionC)
                            @foreach($GestionC as $valor)
                                '{{$valor['nombre']}}' {{$valor['separador']}}
                            @endforeach
                            @endif
                            ]

                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Nro de Solicitudes'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y} Tickets</b></td></tr>',
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
                    name: 'Pendientes',
                    data: [
                            @if($GestionC)
                            @foreach($GestionC as $valor)
                                {{$valor['pendientes']}} {{$valor['separador']}}
                            @endforeach
                            @endif
                        ]

                }]
            });
            Highcharts.chart('canceladosC', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Solicitudes Canceladas por Usuario'
                },
                colors:[
                    '#f39c12'
                    ],
                xAxis: {
                    categories: [
                        @if($GestionC)
                        @foreach($GestionC as $valor)
                            '{{$valor['nombre']}}' {{$valor['separador']}}
                        @endforeach
                        @endif
                        ]

                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Nro de Solicitudes'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                        '<td style="padding:0"><b>{point.y} Tickets</b></td></tr>',
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
                    name: 'Cancelados',
                    data: [
                            @if($GestionC)
                            @foreach($GestionC as $valor)
                                {{$valor['cancelados']}} {{$valor['separador']}}
                            @endforeach
                            @endif
                        ]

                }]
            });
        });
    </script>

    @endsection

