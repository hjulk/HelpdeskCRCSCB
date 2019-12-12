$(document).ready(function () {
    $('#control').DataTable({
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 }],
            responsive: true,
        lengthChange: false,
        searching   : true,
        ordering    : true,
        info        : true,
        autoWidth   : true,
        order: [[ 0, "desc" ]],
        language: {
            processing: "Procesando...",
            search: "Buscar:",
            lengthMenu: "Mostrar _MENU_ registros.",
            info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            infoEmpty: "Mostrando registros del 0 al 0 de 0 registros",
            infoFiltered: "(filtrado de un total de _MAX_ registros)",
            infoPostFix: "",
            loadingRecords: "Cargando...",
            zeroRecords: "No se encontraron resultados",
            emptyTable: "Ningún dato disponible en esta tabla",
            row: "Registro",
            export: "Exportar",
            paginate: {
                first: "Primero",
                previous: "Anterior",
                next: "Siguiente",
                last: "Ultimo"
            },
            aria: {
                sortAscending: ": Activar para ordenar la columna de manera ascendente",
                sortDescending: ": Activar para ordenar la columna de manera descendente"
            },
            select: {
                row: "registro",
                selected: "seleccionado"
            }
        },


    });
    $('#reporteC').DataTable({
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 }],
            responsive: true,
        lengthChange: false,
        searching   : true,
        ordering    : true,
        info        : true,
        autoWidth   : true,
        order: [[ 0, "desc" ]],
        language: {
            processing: "Procesando...",
            search: "Buscar:",
            lengthMenu: "Mostrar _MENU_ registros.",
            info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            infoEmpty: "Mostrando registros del 0 al 0 de 0 registros",
            infoFiltered: "(filtrado de un total de _MAX_ registros)",
            infoPostFix: "",
            loadingRecords: "Cargando...",
            zeroRecords: "No se encontraron resultados",
            emptyTable: "Ningún dato disponible en esta tabla",
            row: "Registro",
            export: "Exportar",
            paginate: {
                first: "Primero",
                previous: "Anterior",
                next: "Siguiente",
                last: "Ultimo"
            },
            aria: {
                sortAscending: ": Activar para ordenar la columna de manera ascendente",
                sortDescending: ": Activar para ordenar la columna de manera descendente"
            },
            select: {
                row: "registro",
                selected: "seleccionado"
            }
        },
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'collection',
                text: 'Exportar',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    {extend: 'pdfHtml5', orientation: 'landscape', pageSize: 'A4'},
                    'print'
                ]
            }
        ]

    });
    $('#btnFormularioConsultaCambios').click(function(){

        var Impacto     = $("#id_impacto").val();
        var Ambiente    = $("#id_ambiente").val();
        var Plataforma  = $("#id_plataforma").val();
        var Estado      = $("#id_estado").val();
        var Categoria   = $("#id_categoriarepoC").val();
        var Creador     = $("#id_creadorrepoC").val();
        var Asignado    = $("#id_asignadorepoC").val();
        var FechaInicio = $("#fechaInicio").val();
        var FechaFin    = $("#fechaFin").val();
        var tipo        = 'post';
        $.ajax({
            type: "post",
            url : "consultarCambios",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data : {_method: tipo,id_impacto: Impacto,id_plataforma: Plataforma,id_ambiente: Ambiente,id_estado: Estado,
                    id_categoria: Categoria,id_creador: Creador,id_asignado: Asignado,fechaInicio: FechaInicio,fechaFin: FechaFin},
            success : function(data){
                var valido = data['valido'];
                var errores = data['errors'];
                if(valido === 'true'){

                    var Resultado = jQuery.parseJSON(data['results']);
                    $('#panelResultadoC').show();
                    $('#reporteC').DataTable().destroy();
                    $('#reporteC').DataTable({
                        data: Resultado,
                        columnDefs: [
                            { responsivePriority: 1, targets: 0 },
                            { responsivePriority: 2, targets: -10 }],
                            responsive: {
                                details: {
                                    display: $.fn.dataTable.Responsive.display.modal( {
                                        header: function ( row ) {
                                            var data = row.data();
                                            return 'Detalle Solicitud ';
                                        }
                                    } ),
                                    renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                                        tableClass: 'table'
                                    })
                                }
                            },
                        lengthChange: false,
                        searching   : true,
                        ordering    : true,
                        info        : true,
                        autoWidth   : true,
                        order: [[ 0, "desc" ]],
                        columns: [
                                    { "data": "id" },
                                    { "data": "creado" },
                                    { "data": "actualizado" },
                                    { "data": "id_impacto" },
                                    { "data": "id_plataforma" },
                                    { "data": "id_ambiente" },
                                    { "data": "fecha_publicacion" },
                                    { "data": "asignado_a" },
                                    { "data": "escalamiento" },
                                    { "data": "nombre_solicitante" },
                                    { "data": "telefono_solicitante" },
                                    { "data": "correo_solicitante" },
                                    { "data": "descripcion" },
                                    { "data": "actualizado_por" },
                                    { "data": "historial" }
                                ],
                        dom: 'Bfrtip',
                        buttons: [
                            {
                                extend: 'collection',
                                text: 'Exportar',
                                buttons: [
                                    'copy',
                                    'excel',
                                    'csv',
                                    {extend: 'pdfHtml5', orientation: 'landscape', pageSize: 'A4'},
                                    'print'
                                ]
                            }
                        ],
                        language: {
                            processing: "Procesando...",
                            search: "Buscar:",
                            lengthMenu: "Mostrar _MENU_ registros.",
                            info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                            infoEmpty: "Mostrando registros del 0 al 0 de 0 registros",
                            infoFiltered: "(filtrado de un total de _MAX_ registros)",
                            infoPostFix: "",
                            loadingRecords: "Cargando...",
                            zeroRecords: "No se encontraron resultados",
                            emptyTable: "Ningún dato disponible en esta tabla",
                            row: "Registro",
                            export: "Exportar",
                            paginate: {
                                first: "Primero",
                                previous: "Anterior",
                                next: "Siguiente",
                                last: "Ultimo"
                            },
                            aria: {
                                sortAscending: ": Activar para ordenar la columna de manera ascendente",
                                sortDescending: ": Activar para ordenar la columna de manera descendente"
                            },
                            select: {
                                row: "registro",
                                selected: "seleccionado"
                            }
                        }
                    });
                }else{
                    $.each(errores,function(key, value){
                        if(value){
                            toastr.error(value);
                        }
                    });
                    $('#panelResultadoC').hide();
                }
            },

            });
        });
});
