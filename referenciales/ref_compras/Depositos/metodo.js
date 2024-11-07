
listar();

function agregar() {
    $("#operacion").val(1);
    $("#depo_nro").val(0); 
    $(".editable").removeAttr("disabled");
    habilitarBotones(false);
    $(".form-line").attr("class", "form-line focused");
}


function editar() {
    $("#operacion").val(2);
    $(".editable").removeAttr("disabled");
    $(".form-line").attr("class", "form-line focused");
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
        $(".btnOperacion1").attr("class", "btn btn-success waves-effect btnOperacion1");
        $(".btnOperacion2").attr("class", "btn btn-danger waves-effect btnOperacion2 hidden");
    } else {
        $(".btnOperacion2").attr("class", "btn btn-primary waves-effect btnOperacion2");
        $(".btnOperacion3").attr("class", "btn btn-warning waves-effect btnOperacion3");
        $(".btnOperacion4").attr("class", "btn btn-danger waves-effect btnOperacion4");
        $(".btnOperacion1").attr("class", "btn btn-success waves-effect btnOperacion1 hidden");
    }
}

function seleccionSucursal(datos) {
    Object.keys(datos).forEach(key => {
        $("#" + key).val(datos[key]);
    });
    $("#ulSucursal").html("");
    $("#listaSucursal").attr("style", "display:none;");
    $(".form-line").attr("class", "form-line focused");
}

function getSucursal() {
    $.ajax({
        method: "POST",
        url: "listaSucursal.php",
        data: {
            sucu_desc: $("#sucu_desc").val()
        }
    }).done(function(lista) {
        var fila = "";
        $.each(lista, function(i, item) {
            fila += "<li class='list-group-item' onclick='seleccionSucursal(" + JSON.stringify(item) + ")'>" + item.sucu_desc + "</li>";
        });
        $("#ulSucursal").html(fila);
        $("#listaSucursal").attr("style", "display:block; position:absolute; z-index:3000;");
    }).fail(function(a, b, c) {
        swal("ERROR", c, "error");
    });
}


function confirmarOperacion() {
    var operacion = $("#operacion").val();
    var pregunta = "¿Desea grabar el nuevo registro?";
    var titulo = "Alta!";

    if (operacion == 2) {
        pregunta = "¿Desea modificar el registro seleccionado?";
        titulo = "Modificación!!!";
    }

    if (operacion == 3) {
        pregunta = "¿Desea eliminar el registro seleccionado?";
        titulo = "Eliminar!!!";
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
        data: {
            depo_nro: $("#depo_nro").val(),
            depo_desc: $("#depo_desc").val(),
            id_sucursal: $("#id_sucursal").val(),
            operacion: $("#operacion").val()
        }
    }).done(function(respuesta) {
        console.log(respuesta);
        swal({
            title: "Respuesta",
            text: respuesta.mensaje,
            type: respuesta.tipo
        }, function() {
            if (respuesta.tipo == "success") {
                $("#depo_nro").val(respuesta.ultcod);
                location.reload(true);
            }
        });
    }).fail(function(a, b, c) {
        swal("ERROR", c, "error");
    });
}


function listar() {
    $.ajax({
        method: "GET",
        url: "controlador.php"
    }).done(function(resultado) {
        console.log(JSON.stringify(resultado));
        var lineas = "";
        for (rs of resultado) {
            lineas += "<tr onclick='seleccion(" + JSON.stringify(rs) + ")'>";
            lineas += "<td>" + rs.depo_nro + "</td>";
            lineas += "<td>" + rs.depo_desc + "</td>";
            lineas += "<td>" + rs.id_sucursal + "</td>";
            lineas += "</tr>";
        }
        $("#grilla_datos").html(lineas);
        formatoTabla();
    }).fail(function(a, b, c) {
        alert(c);
    });
}


function seleccion(json) {
    Object.keys(json).forEach(function(key) {
        $("#" + key).val(json[key]);
    });
    $(".form-line").attr("class", "form-line focused");
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
