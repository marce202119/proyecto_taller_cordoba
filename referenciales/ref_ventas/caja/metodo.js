function listar() {
    $.ajax({
        method: "GET",
        url: "controlador.php",
        dataType: "json"
    })
    .done(function(resultado) {
        console.log("Resultado del listado:", resultado);
        var lineas = "";
        for (let rs of resultado) {
            lineas += "<tr onclick='seleccion(" + JSON.stringify(rs) + ")'>";
            lineas += "<td>" + rs.codigo + "</td>";
            lineas += "<td>" + rs.nombre + "</td>";
            lineas += "<td>" + rs.ruc + "</td>";
            lineas += "<td>" + rs.direccion + "</td>";
            lineas += "<td>" + rs.email + "</td>";
            lineas += "<td>" + rs.telefono + "</td>";
            lineas += "<td>" + rs.sitio_web + "</td>";
            lineas += "</tr>";
        }
        $("#grilla_datos").html(lineas);
        formatoTabla();
    })
    .fail(function(a, b, c) {
        console.error("Error al listar:", c);
        swal("ERROR", c, "error");
    });
}

function agregar() {
    $("#operacion").val(1);
    $("#provee_cod").val(0);
    $(".editable").removeAttr("disabled");
    habilitarBotones(false);
    $(".form-line").addClass("focused");
}

function editar() {
    $("#operacion").val(2);
    $(".editable").removeAttr("disabled");
    $(".form-line").addClass("focused");
    habilitarBotones(false);
}

function borrar() {
    $("#operacion").val(3);
    habilitarBotones(false);
}

function cancelar() {
    location.reload(true);
}

function habilitarBotones(operacion1) {
    if (operacion1) {
        $(".btnOperacion1").removeClass("hidden");
        $(".btnOperacion2").addClass("hidden");
    } else {
        $(".btnOperacion1").addClass("hidden");
        $(".btnOperacion2").removeClass("hidden");
    }
}

function confirmarOperacion() {
    var operacion = $("#operacion").val();
    var pregunta = "¿Desea grabar el nuevo proveedor?";
    var titulo = "Alta de Proveedor";

    if (operacion == 2) {
        pregunta = "¿Desea modificar el proveedor seleccionado?";
        titulo = "Modificación de Proveedor";
    } else if (operacion == 3) {
        pregunta = "¿Desea eliminar el proveedor seleccionado?";
        titulo = "Eliminar Proveedor";
    }

    swal({
        title: titulo,
        text: pregunta,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#227601",
        confirmButtonText: "SI",
        cancelButtonText: "NO",
        closeOnConfirm: false
    }, function() {
        grabar();
    });
}

function grabar() {
    $.ajax({
      
        method: "POST",
        url: "controlador.php",
        dataType: "json",
        data: {
            p_codigo: $("#provee_cod").val(),
            p_nombre: $("#provee_name").val(),
            p_ruc: $("#provee_ruc").val(),
            p_direccion: $("#provee_direc").val(),
            p_email: $("#email").val(),
            p_telefono: $("#telefono").val(),
            operacion: $("#operacion").val()
        }
    })
    .done(function(respuesta) {
        console.log("Respuesta del grabado:", respuesta); // Debug
        swal({
            title: "Respuesta",
            text: respuesta.mensaje,
            type: respuesta.tipo
        }, function() {
            if (respuesta.tipo === "success") {
                location.reload(true);
            }
        });
    })
    .fail(function(a, b, c) {
        console.error("Error al grabar:", c);
        swal("ERROR", c, "error");
    });
}

function seleccion(json) {
    Object.keys(json).forEach(function(key) {
        $("#" + key).val(json[key]);
    });
    $(".form-line").addClass("focused");
}

function formatoTabla() {
    $('.js-exportable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        dom: 'Bfrtip',
        responsive: true,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
}

// Validaciones de campos
$(document).ready(function() {
    $("#email").on('change', function() {
        var email = $(this).val();
        var regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!regex.test(email)) {
            swal("Error", "Por favor ingrese un email válido", "error");
            $(this).val('');
        }
    });

    $("#provee_ruc").on('change', function() {
        var ruc = $(this).val();
        if (ruc.length < 5) {
            swal("Error", "El RUC debe tener al menos 5 caracteres", "error");
            $(this).val('');
        }
    });

    $("#fecha_incorporacion").on('change', function() {
        var fecha = new Date($(this).val());
        var hoy = new Date();
        if (fecha > hoy) {
            swal("Error", "La fecha no puede ser superior a la actual", "error");
            $(this).val('');
        }
    });
});