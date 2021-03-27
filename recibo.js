$( document ).ready( function () {
    tablaRecibo = $( "#tablaRecibo" ).DataTable( {
        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditarR'>Recibir</button></div></div>"
        }],

        //Para cambiar el lenguaje a español
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "sProcessing": "Procesando...",
        }
    } );


    var fila; //capturar la fila para editar o borrar el registro

//botón EDITAR
    $( document ).on( "click", ".btnEditarR", function () {
        fila = $( this ).closest( "tr" );
        id = parseInt( fila.find( 'td:eq(0)' ).text() );
        nombre = fila.find( 'td:eq(1)' ).text();
        descripcion = fila.find( 'td:eq(2)' ).text();
        categoria = fila.find( 'td:eq(3)' ).text();

        opcion = 2; //editar

        $( ".modal-header" ).css( "background-color", "#4e73df" );
        $( ".modal-header" ).css( "color", "white" );
        $( ".modal-title" ).text( "Editar Producto" );
        $( "#modalReciboCRUD" ).modal( "show" );

    } );

//botón BORRAR
    $( document ).on( "click", ".btnBorrarP", function () {
        fila = $( this );
        id = parseInt( $( this ).closest( "tr" ).find( 'td:eq(0)' ).text() );
        opcion = 3 //borrar
        var respuesta = confirm( "¿Está seguro de eliminar el registro: " + id + "?" );
        if (respuesta) {
            $.ajax( {
                url: "bd/productoCrud.php",
                type: "POST",
                dataType: "json",
                data: {opcion: opcion, id: id},
                success: function () {
                    tablaRecibo.row( fila.parents( 'tr' ) ).remove().draw();
                }
            } );
        }
    } );

    $( "#formRecibo" ).submit( function (e) {
        e.preventDefault();
        nombre = $.trim( $( "#nombre" ).val() );
        descripcion = $.trim( $( "#descripcion" ).val() );
        categoria = $.trim( $( "#categoria" ).val() );
        $.ajax( {
            url: "bd/productoCrud.php",
            type: "POST",
            dataType: "json",
            data: {
                nombre: nombre,
                descripcion: descripcion,
                categoria: categoria,
                id: id,
                opcion: opcion
            },
            success: function (data) {
                console.log( data );

                id = data[0].id;
                nombre = data[0].nombre;
                descripcion = data[0].descripcion;
                categoria = data[0].categoria;

                if (opcion == 1) {
                    tablaRecibo.row.add( [id, nombre, descripcion, categoria] ).draw();
                } else {
                    tablaRecibo.row( fila ).data( [id, nombre, descripcion, categoria] ).draw();
                }
            }
        } );
        $( "#modalReciboCRUD" ).modal( "hide" );

    } );

} );//fin