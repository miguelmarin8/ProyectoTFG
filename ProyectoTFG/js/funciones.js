function DATOS() {
    var nombre = document.getElementById("nombre").value;
    var apellidos = document.getElementById("apellidos").value;
    var email = document.getElementById("email").value;

    if (nombre !== "" && apellidos !== "" && email !== "") {
        document.getElementById("DATOS").style.display = "";

    } else {
        document.getElementById("DATOS").style.display = "none";
    }
}

function mostrarContrasena() {
    var tipo = document.getElementById("password");
    if (tipo.type == "password") {
        tipo.type = "text";
    } else {
        tipo.type = "password";
    }
}

function mostrarTablaRegistro() {
    var tablausu = document.getElementById('usuarios').style.display = 'none';
    if (tablausu.style.display === 'none') {
        tablausu.style.display = 'block';
    } else {
        tablausu.style.display = 'none';
    }
}


//TABLA AREA ADMINISTRADOR USUARIOS
$(document).ready(function () {
    $('#tablaUsuarios').DataTable({
        language: {
            processing: "Tratamiento en curso...",
            search: "Buscar&nbsp;:",
            lengthMenu: "Agrupar de _MENU_ items",
            info: "Mostrando del item _START_ al _END_ de un total de _TOTAL_ items",
            infoEmpty: "No existen datos.",
            infoFiltered: "(filtrado de _MAX_ elementos en total)",
            infoPostFix: "",
            loadingRecords: "Cargando...",
            zeroRecords: "No se encontraron datos con tu busqueda",
            emptyTable: "No hay datos disponibles en la tabla.",
            paginate: {
                first: "Primero",
                previous: "Anterior",
                next: "Siguiente",
                last: "Ultimo"
            },
            aria: {
                sortAscending: ": active para ordenar la columna en orden ascendente",
                sortDescending: ": active para ordenar la columna en orden descendente"
            }
        },
        scrollY: 400,
        lengthMenu: [
            [10, 25, -1],
            [10, 25, "All"]
        ],
    });

    var fila; //capturar la fila para editar o borrar el registro
    //BOTON EDITAR    
    $(document).on("click", ".btnEditarUsuario", function () {
        fila = $(this).closest("tr");
        id_usuario = parseInt(fila.find('td:eq(0)').text());
        nombre = fila.find('td:eq(1)').text();
        apellidos = fila.find('td:eq(2)').text();
        email = fila.find('td:eq(3)').text();
        usuario = fila.find('td:eq(4)').text();

        $("#id_usuario").val(id_usuario);
        $("#nombre").val(nombre);
        $("#apellidos").val(apellidos);
        $("#email").val(email);
        $("#usuario").val(usuario);
        $("#modalEditar").modal("show");

    });
    //BOTON BORRAR
    $(document).on("click", ".btnBorrarUsuario", function () {
        fila = $(this).closest("tr");
        id_usuario = parseInt(fila.find('td:eq(0)').text());
        email = fila.find('td:eq(3)').text();
        usuario = fila.find('td:eq(4)').text();

        $("#id_usuario2").val(id_usuario);
        $("#email2").val(email);
        $("#usuario2").val(usuario);
        $("#modalEliminar").modal("show");
    });
});


//TABLA AREA ADMINISTRADOR PRODUCTOS

$(document).ready(function(){
   
    $('#tablax').DataTable({
          
       "language":{
           "lengthMenu":"Mostrar _MENU_ registros",
           "zeroRecords":"No se encontraron resultados",
           "info":"Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
           "infoEmpty":"Mostrando registros del 0 al 0 de un total de 0 registros",
           "infoFiltered":"(filtrado de un total de _MAX_ registros)",
           "sSearch":"Buscar:",
           "oPaginate":{
               "sFirst":"Primero",
               "sLast":"Último",
               "sNext":"Siguiente",
               "sPrevious":"Anterior"
           },
           "sProcessing":"Procesando...",
       }
   });
});
