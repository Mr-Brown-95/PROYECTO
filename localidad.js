$(document).ready(function(){
    tablaUbicacion = $("#tablaUbicacion").DataTable({
        "columnDefs":[{
            "targets": -1,
            "data":null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditarL'>Editar</button><button class='btn btn-danger btnBorrarL'>Borrar</button></div></div>"
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
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
            },
            "sProcessing":"Procesando...",
        }
    });

    $("#btnNuevol").click(function(){
        $("#formUbicacion").trigger("reset");
        $(".modal-header").css("background-color", "#1cc88a");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Nueva Ubicacion");
        $("#modalUbicacionCRUD").modal("show");
        id=null;
        opcion = 1; //alta
    });
    var fila; //capturar la fila para editar o borrar el registro

//botón EDITAR
    $(document).on("click", ".btnEditarL", function(){
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        pasillo = fila.find('td:eq(1)').text();
        rack = fila.find('td:eq(2)').text();
        nivel = fila.find('td:eq(3)').text();
        idEmpleado = parseInt(fila.find('td:eq(4)').text());

        $("#pasillo").val(pasillo);
        $("#rack").val(rack);
        $("#nivel").val(nivel);
        $("#idEmpleado").val(idEmpleado);

        opcion = 2; //editar

        $(".modal-header").css("background-color", "#4e73df");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Persona");
        $("#modalUbicacionCRUD").modal("show");

    });

//botón BORRAR
    $(document).on("click", ".btnBorrarL", function(){
        fila = $(this);
        id = parseInt($(this).closest("tr").find('td:eq(0)').text());
        opcion = 3 //borrar
        var respuesta = confirm("¿Está seguro de eliminar el registro: "+id+"?");
        if(respuesta){
            $.ajax({
                url: "bd/localidadCrud.php",
                type: "POST",
                dataType: "json",
                data: {opcion:opcion, id:id},
                success: function(){
                    tablaUbicacion.row(fila.parents('tr')).remove().draw();
                }
            });
        }
    });

    $("#formUbicacion").submit(function(e){
        e.preventDefault();
        pasillo = $.trim($("#pasillo").val());
        rack = $.trim($("#rack").val());
        nivel = $.trim($("#nivel").val());
        idEmpleado = $.trim($("#idEmpleado").val());
        $.ajax({
            url: "bd/localidadCrud.php",
            type: "POST",
            dataType: "json",
            data:{pasillo:pasillo, rack:rack, nivel:nivel, idEmpleado:idEmpleado, id:id, opcion:opcion},
            success: function(data){

                var lengthData = data.length - 1 ;

                id = data[lengthData].id;
                pasillo = data[lengthData].pasillo;
                rack = data[lengthData].rack;
                nivel = data[lengthData].nivel;
                idEmpleado = data[lengthData].idEmpleado;
                if(opcion == 1){tablaUbicacion.row.add([id,pasillo,rack,nivel,idEmpleado]).draw();}
                else{tablaUbicacion.row(fila).data([id,pasillo,rack,nivel,idEmpleado]).draw();}
            }
        });
        $("#modalUbicacionCRUD").modal("hide");

    });

});