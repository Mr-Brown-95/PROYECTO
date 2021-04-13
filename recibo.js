$( document ).ready( function () {
    tablaRecibo = $( "#tablaRecibo" ).DataTable( {
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

    $( "#btnNuevoR" ).click( function () {
        $( "#formRecibo" ).trigger( "reset" );
        $( ".modal-header" ).css( "background-color", "#1cc88a" );
        $( ".modal-header" ).css( "color", "white" );
        $( ".modal-title" ).text( "Recibir Producto" );
        $( "#modalReciboCRUD" ).modal( "show" );
        opcion = 1; //alta
        $.ajax( {
            type: 'POST',
            url: 'bd/reciboCrud.php',
            data: {opcion: opcion}
        } )
            .done( function (data) {
                $( '#idR' ).html( data )
            } )
            .fail( function () {
                alert( 'Hubo un errror al cargar productos' )
            } )
        $( '#idR' ).on( 'change', function () {
            opcion = 2;
            var id = $( '#idR' ).val()
            $.ajax( {
                type: 'POST',
                url: 'bd/reciboCrud.php',
                data: {id: id, opcion: opcion}
            } )
                .done( function (data) {
                    var dat = JSON.parse( data );
                    $( "#nombreR" ).val( dat[0].nombre );
                    $( "#descripcionR" ).val( dat[0].descripcion );
                    $( "#categoriaR" ).val( dat[0].categoria );

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
    var fechaEntrada = year + "-" + mes + "-" + diaSemana;
    //agregar recibo
    $( "#formRecibo" ).submit( function (e) {


        opcion = 3;
        id = $( '#idR' ).val()
        nombre = $.trim( $( "#nombreR" ).val() );
        descripcion = $.trim( $( "#descripcionR" ).val() );
        categoria = $.trim( $( "#categoriaR" ).val() );
        cantidadEntrada = $.trim( $( "#cantidadR" ).val() );
        IdEmpRecibo = $.trim( $( "#IdEmpRecibo" ).val() );
        $.ajax( {
            url: "bd/reciboCrud.php",
            type: "POST",
            dataType: "json",
            data: {
                nombre: nombre,
                descripcion: descripcion,
                categoria: categoria,
                cantidadEntrada: cantidadEntrada,
                fechaEntrada: fechaEntrada,
                IdEmpRecibo:IdEmpRecibo,
                id: id,
                opcion: opcion
            },
            success: function (data) {

                var lengthData = data.length - 1 ;
                console.log(data);
                id = data[lengthData].id;
                nombre = data[lengthData].nombre;
                descripcion = data[lengthData].descripcion;
                categoria = data[lengthData].categoria;
                cantidadEntrada = data[lengthData].cantidadEntrada;
                fechaEntrada = data[lengthData].fechaEntrada;
                IdEmpRecibo = data[lengthData].IdEmpRecibo;

                jsBuscar();
            }
        } );
        $( "#modalReciboCRUD" ).modal( "hide" );

    } );
    //función que realiza la busqueda
    function jsBuscar(){

        //obtenemos el valor insertado a buscar
        buscar = $( '#idR' ).val()

        //realizamos el recorrido solo por las celdas que contienen el código, que es la primera
        $("#tablaRecibo tr").find('td:eq(0)').each(function () {

            //obtenemos el codigo de la celda
            id = $(this).html();
            //obtenemos el numero de la fila
            fila = $( this ).closest( "tr" );
            //comparamos para ver si el código es igual a la busqueda
            if(id==buscar){

                if (opcion == 3) {
                    tablaRecibo.row.add( [id, nombre, descripcion, categoria, cantidadEntrada, fechaEntrada, IdEmpRecibo] ).draw();
                } else {
                    tablaRecibo.row( fila ).data( [id, nombre, descripcion, categoria, cantidadEntrada, fechaEntrada, IdEmpRecibo] ).draw();
                }

            }

        })
    }//fin busqueda

} );//fin
