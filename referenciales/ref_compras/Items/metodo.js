listar();
formatoFecha();

function agregar(){
    $("#operacion").val(1);
    $("#items_nro").val(0);
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

function formatoFecha(){
    $('.datetimepicker').bootstrapMaterialDatePicker({
        format: 'DD/MM/YYYY HH:mm:ss',
        clearButton: true,
        weekStart: 1
    });

    $('.datepicker').bootstrapMaterialDatePicker({
        format: 'DD/MM/YYYY',
        clearButton: true,
        weekStart: 1,
        time: false
    });
}

function getTipImpto(){
    $.ajax({
        method: "POST",
        url: "listaImpuesto.php",
        data:{
            impuesto:$("#impuesto").val()
        }

    }).done(function(lista){
        
        var fila = "";
        $.each(lista, function(i, item){
            fila += "<li class='list-group-item' onclick='seleccionTipImpuesto("+JSON.stringify(item)+")'>"+item.impuesto+"</li>";
        });

        $("#ulTipImpto").html(fila);
        $("#listaTipImpto").attr("style", "display:block; position:absolute; z-index:3000;");
    }).fail(function(a,b,c){
        swal("ERROR", c, "error");
    })
}

function seleccionTipImpuesto(datos){
    Object.keys(datos).forEach(key => {
        $("#"+key).val(datos[key]);
    });
    $("#ulTipImpto").html("");
    $("#listaTipImpto").attr("style", "display:none;");
    $(".form-line").attr("class","form-line focused");
}


function getTipItems(){
    $.ajax({
        method: "POST",
        url: "listaTipoItem.php",
        data:{
            mercaderia:$("#mercaderia").val()
        }

    }).done(function(lista){
        
        var fila = "";
        $.each(lista, function(i, item){
            fila += "<li class='list-group-item' onclick='selecciontipo("+JSON.stringify(item)+")'>"+item.mercaderia+"</li>";
        });

        $("#ulTipo").html(fila);
        $("#listaTipo").attr("style", "display:block; position:absolute; z-index:3000;");
    }).fail(function(a,b,c){
        swal("ERROR", c, "error");
    })
}

function selecciontipo(datos){
    Object.keys(datos).forEach(key => {
        $("#"+key).val(datos[key]);
    });
    $("#ulTipo").html("");
    $("#listaTipo").attr("style", "display:none;");
    $(".form-line").attr("class","form-line focused");
}


function confirmarOperacion(){

    var operacion = $("#operacion").val();
    var pregunta = "¿Desea grabar el nuevo registro?";
    var titulo = "Alta!";

    if(operacion == 2){
        pregunta = "¿Desea modificar el registro seleccionado?";
        titulo = "Modificacion!!!";
    }

    if(operacion == 3){
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
    }, function () {
        grabar();
    });
}

function grabar(){
    $.ajax({
        method:"POST",
        url:"controlador.php",
        data:{
            items_nro:$("#items_nro").val(),
            items_fecha_venc:$("#items_fecha_venc").val(),
            items_precio:$("#items_precio").val(),
            items_stock_min:$("#items_stock_min").val(),
            items_stock_max:$("#items_stock_max").val(),
            items_desc:$("#items_desc").val(),
            tip_impto_nro:$("#tip_impto_nro").val(),
            tip_items_nro:$("#tip_items_nro").val(),
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
                $("#items_nro").val(respuesta.ultcod);
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
                    lineas += rs.items_nro;
                lineas += "</td>";
                lineas += "<td>";
                    lineas += rs.items_desc;
                lineas += "</td>";
                lineas += "<td>";
                    lineas += rs.items_precio;
                lineas += "</td>";
                lineas += "<td>";
                    lineas += rs.items_stock_min;
                lineas += "</td>";
                lineas += "<td>";
                    lineas += rs.items_stock_max;
                lineas += "</td>";
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