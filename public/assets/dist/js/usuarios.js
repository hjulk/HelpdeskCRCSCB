$(document).ready(function () {

    $('#id_zona').change(function () {
        var seleccion = $("#id_zona").val();
        if (seleccion === "0") {
            $('#Sedes1').hide();
            $('#Sedes2').hide();
            $('#Sedes3').hide();

            seleccion = 0;
        } else if (seleccion === "1") {
            $('#Sedes1').show();
            $('#Sedes2').hide().val('0');
            $('#Sedes3').hide().val('0');

            seleccion = 1;
        } else if (seleccion === "2") {
            $('#Sedes1').hide().val('0');
            $('#Sedes2').show();
            $('#Sedes3').hide().val('0');

            seleccion = 2;
        } else if (seleccion === "3") {
            $('#Sedes1').hide().val('0');
            $('#Sedes2').hide().val('0');
            $('#Sedes3').show();

            seleccion = 3;
        }

    });
    $('#usuarios').DataTable({
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 }],
            responsive: true,
        lengthChange: false,
        searching   : true,
        ordering    : true,
        info        : true,
        autoWidth   : true,
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

});
