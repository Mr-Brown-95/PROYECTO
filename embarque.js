$( document ).ready( function () {
    tablaEmbarque = $( "#tablaEmbarque" ).DataTable( {
        "columnDefs": [{
            "data": null,}],
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

    $( "#btnNuevoE" ).click( function () {
        $( "#formEmbarque" ).trigger( "reset" );
        $( ".modal-header" ).css( "background-color", "#1cc88a" );
        $( ".modal-header" ).css( "color", "white" );
        $( ".modal-title" ).text( "Surtir Producto" );
        $( "#modalEmbarqueCRUD" ).modal( "show" );
        opcion = 1; //alta
        $.ajax( {
            type: 'POST',
            url: 'bd/embarqueCrud.php',
            data: {opcion: opcion}
        } )
            .done( function (data) {
                $( '#idE' ).html( data )
            } )
            .fail( function () {
                alert( 'Hubo un errror al cargar productos' )
            } )
        $( '#idE' ).on( 'change', function () {
            opcion = 2;
            var id = $( '#idE' ).val()
            $.ajax( {
                type: 'POST',
                url: 'bd/embarqueCrud.php',
                data: {id: id, opcion: opcion}
            } )
                .done( function (data) {
                    var dat = JSON.parse( data );
                    $( "#nombreE" ).val( dat[0].nombre );
                    $( "#descripcionE" ).val( dat[0].descripcion );
                    $( "#categoriaE" ).val( dat[0].categoria );

                } )
                .fail( function () {
                    alert( 'Hubo un errror al cargar productos' )
                } )
        } )
        //id = null;

    } );
    var fila; //capturar la fila para editar o borrar el registro
    var fecha = new Date(),
        diaSemana = fecha.getDate(),
        mes = fecha.getMonth(),
        year = fecha.getFullYear();
    mes = mes + 1;
    if (diaSemana < 10) {
        diaSemana = "0" + diaSemana;
    }
    if (mes < 10) {
        mes = "0" + mes;
    }
    var fechaSalida = year + "-" + mes + "-" + diaSemana;
    //agregar Embarque
    $( "#formEmbarque" ).submit( function (e) {
        opcion = 3;
        e.preventDefault();
        id = $( '#idE' ).val()
        nombre = $.trim( $( "#nombreE" ).val() );
        descripcion = $.trim( $( "#descripcionE" ).val() );
        categoria = $.trim( $( "#categoriaE" ).val() );
        cantidadSalida = $.trim( $( "#cantidadSalida" ).val() );
        IdEmpSurte = $.trim( $( "#IdEmpSurte" ).val() );
        $.ajax( {
            url: "bd/embarqueCrud.php",
            type: "POST",
            dataType: "json",
            data: {
                nombre: nombre,
                descripcion: descripcion,
                categoria: categoria,
                cantidadSalida: cantidadSalida,
                fechaSalida: fechaSalida,
                IdEmpSurte:IdEmpSurte,
                id: id,
                opcion: opcion
            },
            success: function (data) {
                var lengthData = data.length - 1 ;

                id = data[lengthData].id;
                nombre = data[lengthData].nombre;
                descripcion = data[lengthData].descripcion;
                categoria = data[lengthData].categoria;
                cantidadSalida = data[lengthData].cantidadSalida;
                fechaSalida = data[lengthData].fechaSalida;
                IdEmpSurte = data[lengthData].IdEmpSurte;

                if (opcion == 3) {
                    tablaEmbarque.row.add( [id, nombre, descripcion, categoria, cantidadSalida, fechaSalida, IdEmpSurte] ).draw();
                } else {
                    tablaEmbarque.row( fila ).data( [id, nombre, descripcion, categoria, cantidadSalida, fechaSalida, IdEmpSurte] ).draw();
                }
            }
        } );
        $( "#modalEmbarqueCRUD" ).modal( "hide" );

    } );

} );//fin
