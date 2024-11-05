listar();

function agregar(){
    $("#operacion").val(1);
    $("#tipo_serv_cod").val(0);
    $(".editable").removeAttr("disabled");
    habilitarBotones(false);
    $(".form-line").attr("class","form-line focused");
}

function editar(){
    $("#operacion").val(2)
    $(".editable").removeAttr("disabled");
    $(".form-line").attr("class","form-line focused");
    habilitarBotones(false);
}

function borrar(){
    $("#operacion").val(3);
    habilitarBotones(false);
}

function cancelar(){
    location.reload(true);
}


function habilitarBotones(operacion1){
    if(operacion1){
        $(".btnOperacion1").attr("class","btn btn-success waves-effect btnOperacion1");
        $(".btnOperacion2").attr("class","btn btn-danger waves-effect btnOperacion2 hidden");
    }else{
        $(".btnOperacion2").attr("class","btn btn-primary waves-effect btnOperacion2");
        $(".btnOperacion3").attr("class","btn btn-warning waves-effect btnOperacion3");
        $(".btnOperacion4").attr("class","btn btn-danger waves-effect btnOperacion4");
        $(".btnOperacion1").attr("class","btn btn-success waves-effect btnOperacion1 hidden");
    }
}


function confirmarOperacion(){

    var operacion = $("#operacion").val();
    var pregunta = "¿Desea grabar el nuevo tipo de servicio?";
    var titulo = "Alta!";

    if(operacion == 2){
        pregunta = "¿Desea modificar el tipo de servicio seleccionado?";
        titulo = "Modificacion!!!";
    }

    if(operacion == 3){
        pregunta = "¿Desea eliminar el tipo de servicio seleccionado?";
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
    }, function () {
        grabar();
    });
}

function grabar(){
    $.ajax({
        method:"POST",
        url:"controlador.php",
        data:{
            tipo_serv_cod:$("#tipo_serv_cod").val(),
            tipo_serv_descr:$("#tipo_serv_descr").val(),
            operacion:$("#operacion").val()
        }
    }).done(function(respuesta){
        console.log(respuesta);
        swal({
            title: "Respuesta",
            text: respuesta.mensaje,
            type: respuesta.tipo
        },
        function(){
            if(respuesta.tipo=="success"){
                $("#tipo_serv_cod").val(respuesta.ultcod);
                location.reload(true);
            }
        });
    }).fail(function(a,b,c){
        swal("ERROR",c,"error");
    });
}


function listar(){
    $.ajax({
        method:"GET",
        url:"controlador.php"
    }).done(function(resultado){
        console.log(JSON.stringify(resultado));
        var lineas = "";
        for(rs of resultado){
            lineas += "<tr onclick='seleccion("+JSON.stringify(rs)+")'>"
                lineas += "<td>";
                    lineas += rs.tipo_serv_cod;
                lineas += "</td>";
                lineas += "<td>";
                    lineas += rs.tipo_serv_descr;
                lineas += "</td>";
                lineas += "<td>";
            lineas += "</tr>"
        }
        $("#grilla_datos").html(lineas);
        formatoTabla();
    }).fail(function(a,b,c){
        alert(c);
    })
}

function seleccion(json){
    Object.keys(json).forEach(function(key) {
        $("#"+key).val(json[key]);
    });
    $(".form-line").attr("class","form-line focused");
}



function formatoTabla(){
    //Exportable table
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