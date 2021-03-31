$( document ).ready( function () {
    tablaRecibo = $( "#tablaRecibo" ).DataTable( {
        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditarR'>Editar</button></div></div>"
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

    $( "#btnNuevoR" ).click( function () {
        $( "#formRecibo" ).trigger( "reset" );
        $( ".modal-header" ).css( "background-color", "#1cc88a" );
        $( ".modal-header" ).css( "color", "white" );
        $( ".modal-title" ).text( "Recibir Producto" );
        $( "#modalReciboCRUD" ).modal( "show" );
        opcion = 1; //alta
        $.ajax({
            type: 'POST',
            url: 'bd/reciboCrud.php',
            data:{opcion: opcion}
        })
            .done(function(data){
                $('#idR').html(data)
            })
            .fail(function(){
                alert('Hubo un errror al cargar productos')
            })
        $('#idR').on('change',function (){
            opcion = 2;
            var id = $('#idR').val()
            $.ajax({
                type: 'POST',
                url: 'bd/reciboCrud.php',
                data:{id:id,opcion: opcion}
            })
                .done(function(data){
                    var dat = JSON.parse(data);
                    console.log(dat[0].nombre);
                    console.log(dat[0].descripcion);
                    console.log(dat[0].categoria);
                })
                .fail(function(){
                    alert('Hubo un errror al cargar productos')
                })
        })
        //id = null;

    } );
    var fila; //capturar la fila para editar o borrar el registro

    //agregar recibo
    $( "#formRecibo" ).submit( function (e) {
        e.preventDefault();
        id = $.trim( $( "#id" ).val() );
        nombre = $.trim( $( "#nombreR" ).val() );
        descripcion = $.trim( $( "#descripcionR" ).val() );
        categoria = $.trim( $( "#categoriaR" ).val() );
        $.ajax( {
            url: "bd/reciboCrud.php",
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
/*
* //botón EDITAR
    $( document ).on( "click", ".btnEditarR", function () {
        fila = $( this ).closest( "tr" );
        id = parseInt( fila.find( 'td:eq(0)' ).text() );
        nombre = fila.find( 'td:eq(1)' ).text();
        descripcion = fila.find( 'td:eq(2)' ).text();
        categoria = fila.find( 'td:eq(3)' ).text();

        opcion = 2; //editar

        $( ".modal-header" ).css( "background-color", "#4e73df" );
        $( ".modal-header" ).css( "color", "white" );
        $( ".modal-title" ).text( "Recibir Producto" );
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
                url: "bd/reciboCrud.php",
                type: "POST",
                dataType: "json",
                data: {opcion: opcion, id: id},
                success: function () {
                    tablaRecibo.row( fila.parents( 'tr' ) ).remove().draw();
                }
            } );
        }
    } );*/

} );//fin