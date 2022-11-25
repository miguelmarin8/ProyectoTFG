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

 $(document).ready(function() {
            $('#tablax').DataTable({
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
        });
