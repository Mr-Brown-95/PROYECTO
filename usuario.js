$(document).ready(function(){
    tablaPersonas = $("#tablaPersonas").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditarU'>Editar</button><button class='btn btn-danger btnBorrarU'>Borrar</button></div></div>"
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

$("#btnNuevo").click(function(){
    $("#formPersonas").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nueva Persona");
    $("#modalCRUD").modal("show");
    id=null;
    opcion = 1; //alta
});
var fila; //capturar la fila para editar o borrar el registro

//botón EDITAR
$(document).on("click", ".btnEditarU", function(){
    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    nombreUsuario = fila.find('td:eq(1)').text();
    usuario = fila.find('td:eq(2)').text();
    password = fila.find('td:eq(3)').text();
    privilegios = fila.find('td:eq(4)').text();
    activo = parseInt(fila.find('td:eq(5)').text());

    $("#nombreUsuario").val(nombreUsuario);
    $("#usuario").val(usuario);
    $("#password").val(password);
    $("#privilegios").val(privilegios);
    $("#activo").val(activo);

    opcion = 2; //editar

    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Persona");
    $("#modalCRUD").modal("show");

});

//botón BORRAR
$(document).on("click", ".btnBorrarU", function(){
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3 //borrar
    var respuesta = confirm("¿Está seguro de eliminar el registro: "+id+"?");
    if(respuesta){
        $.ajax({
            url: "bd/usuarioCrud.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id:id},
            success: function (){
                tablaPersonas.row(fila.parents('tr')).remove().draw();
            }
        });
    }
});/*
 success: function(){
                tablaPersonas.row(fila.parents('tr')).remove().draw();
            }*/

$("#formPersonas").submit(function(e){
    e.preventDefault();
    nombreUsuario = $.trim($("#nombreUsuario").val());
    usuario = $.trim($("#usuario").val());
    password = $.trim($("#password").val());
    privilegios = $.trim($("#privilegios").val());
    activo = $.trim($("#activo").val());
    $.ajax({
        url: "bd/usuarioCrud.php",
        type: "POST",
        dataType: "json",
        data:{nombreUsuario:nombreUsuario, usuario:usuario, password:password, privilegios:privilegios, activo:activo, id:id, opcion:opcion},
        success: function(data){
            console.log(data);
            id = data[0].id;
            nombreUsuario = data[0].nombreUsuario;
            usuario = data[0].usuario;
            password = data[0].password;
            privilegios = data[0].privilegios;
            activo = data[0].activo;
            if(opcion == 1){tablaPersonas.row.add([id,nombreUsuario,usuario,password,privilegios,activo]).draw();}
            else{tablaPersonas.row(fila).data([id,nombreUsuario,usuario,password,privilegios,activo]).draw();}
        }
    });
    $("#modalCRUD").modal("hide");

});

});