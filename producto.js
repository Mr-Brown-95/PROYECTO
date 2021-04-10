$( document ).ready( function () {
    tablaProducto = $( "#tablaProducto" ).DataTable( {
        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditarP'>Editar</button><button class='btn btn-danger btnBorrarP'>Borrar</button></div></div>"
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

    $( "#btnNuevo" ).click( function () {
        $( "#formProducto" ).trigger( "reset" );
        $( ".modal-header" ).css( "background-color", "#1cc88a" );
        $( ".modal-header" ).css( "color", "white" );
        $( ".modal-title" ).text( "Nueva Producto" );
        $( "#modalProductoCRUD" ).modal( "show" );
        id = null;
        opcion = 1; //alta
    } );

    var fila; //capturar la fila para editar o borrar el registro

//botón EDITAR
    $( document ).on( "click", ".btnEditarP", function () {
        fila = $( this ).closest( "tr" );
        id = parseInt( fila.find( 'td:eq(0)' ).text() );
        nombre = fila.find( 'td:eq(1)' ).text();
        descripcion = fila.find( 'td:eq(2)' ).text();
        categoria = fila.find( 'td:eq(3)' ).text();

        opcion = 2; //editar

        $( ".modal-header" ).css( "background-color", "#4e73df" );
        $( ".modal-header" ).css( "color", "white" );
        $( ".modal-title" ).text( "Editar Producto" );
        $( "#modalProductoCRUD" ).modal( "show" );

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
                    tablaProducto.row( fila.parents( 'tr' ) ).remove().draw();
                }
            } );
        }
    } );

    $( "#formProducto" ).submit( function (e) {
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
                var lengthData = data.length - 1 ;
                console.log( data );
                id = data[lengthData].id;
                nombre = data[lengthData].nombre;
                descripcion = data[lengthData].descripcion;
                categoria = data[lengthData].categoria;

                if (opcion == 1) {
                    tablaProducto.row.add( [id, nombre, descripcion, categoria] ).draw();
                } else {
                    tablaProducto.row( fila ).data( [id, nombre, descripcion, categoria] ).draw();
                }
            }
        } );
        $( "#modalProductoCRUD" ).modal( "hide" );

    } );
   /* $( "#formProducto" ).submit( function (e) {
        e.preventDefault();
        nombre = $.trim( $( "#nombre" ).val() );
        descripcion = $.trim( $( "#descripcion" ).val() );
        categoria = $.trim( $( "#categoria" ).val() );
        existencia = $.trim( $( "#existencia" ).val() );
        fechaEntrada = $.trim( $( "#fechaEntrada" ).val() );
        cantidadEntrada = $.trim( $( "#cantidadEntrada" ).val() );
        fechaSalida = $.trim( $( "#fechaSalida" ).val() );
        cantidadSalida = $.trim( $( "#cantidadSalida" ).val() );
        IdEmpRecibo = $.trim( $( "#IdEmpRecibo" ).val() );
        IdEmpSurte = $.trim( $( "#IdEmpSurte" ).val() );

        $.ajax( {
            url: "bd/productoCrud.php",
            type: "POST",
            dataType: "json",
            data: {nombre: nombre, descripcion: descripcion, categoria: categoria, id: id, opcion: opcion},
            success: function (data) {
                console.log( data );
                id = data[0].id;
                nombre = data[0].descripcion;
                descripcion = data[0].multiplo;
                categoria = data[0].sector;
                if (opcion == 1) {
                    tablaProducto.row.add( [id, nombre, descripcion, categoria, existencia, fechaEntrada,
                        cantidadEntrada, fechaSalida, cantidadSalida, IdEmpRecibo, IdEmpSurte] ).draw();
                } else {
                    tablaProducto.row( fila ).data( [id, nombre, descripcion, categoria, existencia, fechaEntrada,
                        cantidadEntrada, fechaSalida, cantidadSalida, IdEmpRecibo, IdEmpSurte] ).draw();
                }
            }
        } );
        $( "#modalProductoCRUD" ).modal( "hide" );

    } );*/

} );