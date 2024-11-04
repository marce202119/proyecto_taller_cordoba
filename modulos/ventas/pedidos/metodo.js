listar();
formatoFecha();

function getClientes(){
    $.ajax({
        method: "POST",
        url: "listaClientes.php",
        data:{
            cliente:$("#cliente").val()
        }

    }).done(function(lista){
        
        var fila = "";
        $.each(lista, function(i, item){
            fila += "<li class='list-group-item' onclick='seleccionCliente("+JSON.stringify(item)+")'>"+item.cliente+"</li>";
        });

        $("#ulClientes").html(fila);
        $("#listaClientes").attr("style", "display:block; position:absolute; z-index:3000;");
    }).fail(function(a,b,c){
        swal("ERROR", c, "error");
    })
}

function seleccionCliente(datos){
    Object.keys(datos).forEach(key => {
        $("#"+key).val(datos[key]);
    });
    $("#ulClientes").html("");
    $("#listaClientes").attr("style", "display:none;");
    $(".form-line").attr("class");
}


function agregar(){
    $("#operacion").val(1);
    $("#pedido_nro").val(0);
    $(".editable").removeAttr("disabled");
    habilitarBotones(false);
    $(".form-line").attr("class","form-line focused");
}

function editar(){
    $("#operacion").val(2);
    $(".editable").removeAttr("disabled");
    habilitarBotones(false);
    $(".form-line").attr("class","form-line focused");

}

function cancelar(){
    location.reload(true);
}

function anular(){
    $("#operacion").val(3);
    habilitarBotones(false);
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

//llama a la base de datos items y muestra los datos en el interfaz
function getProducto(){
    $.ajax({
        method: "POST",
        url: "listaProductos.php",
        data:{
            mercaderia:$("#mercaderia").val()
        }

    }).done(function(lista){
        
        var fila = "";
        $.each(lista, function(i, item){
            fila += "<li class='list-group-item' onclick='seleccionProducto("+JSON.stringify(item)+")'>"+item.mercaderia+"</li>";
        });

        $("#ulProductos").html(fila);
        $("#listaProductos").attr("style", "display:block; position:absolute; z-index:3000;");
    }).fail(function(a,b,c){
        swal("ERROR", c, "error");
    })
}

function seleccionProducto(datos){
    Object.keys(datos).forEach(key => {
        $("#"+key).val(datos[key]);
    });
    $("#ulProductos").html("");
    $("#listaProductos").attr("style", "display:none;");
    $(".form-line").attr("class","form-line focused");
}

function formatoFecha(){
    $('.datetimepicker').bootstrapMaterialDatePicker({
        format: 'DD/MM/YYYY HH:mm:ss',
        clearButton: true,
        weekStart: 1
    });

    $('.datepicker').bootstrapMaterialDatePicker({
        format: 'DD/MM/YYYY HH:mm:ss',
        clearButton: true,
        weekStart: 1,
        time: false
    });
}

function confirmarOperacion(){

    var operacion = $("#operacion").val();
    var pregunta = "¿Desea grabar el nuevo registro?";
    var titulo = "Alta!";

    if(operacion == 2){
        pregunta = "¿Desea modificar el registro seleccionado?";
        titulo = "Modificación!!!";
    }

    if(operacion == 3){
        pregunta = "¿Desea anular el registro seleccionado?";
        titulo = "Baja!!!";
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
            pedido_nro:$("#pedido_nro").val(),
            id_sucursal:$("#id_sucursal").val(),
            id_funcionarios:$("#id_funcionarios").val(),
            client_nro:$("#client_nro").val(),
            pedido_fecha:$("#pedido_fecha_f").val(),
            pedido_fecha_pedido:$("#pedido_fecha_pedido_f").val(),
            pedido_fecha_tope:$("#pedido_fecha_tope_f").val(),
            pedido_obs:$("#pedido_obs").val(),
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
                $("#pedido_nro").val(respuesta.ultcod)
            }
        });
    }).fail(function(a,b,c){
        swal("ERROR",c,"error");
    });
}

function agregarDetalle(operacion){
    $.ajax({
        method:"POST",
        url:"controladorDetalles.php",
        data:{
            pedido_nro:$("#pedido_nro").val(),
            items_nro:$("#items_nro").val(),
            pedido_precio:$("#items_precio").val(),
            pedido_cantidad:$("#pedido_cantidad").val(),
            operacion_det:operacion
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
               listarDetalles();
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
                    lineas += rs.pedido_nro;
                lineas += "</td>";
                lineas += "<td>";
                    lineas += rs.cliente;
                lineas += "</td>";
                lineas += "<td>";
                    lineas += rs.client_ruc;
                lineas += "</td>";
                lineas += "<td>";
                    lineas += rs.pedido_fecha_pedido_f;
                lineas += "</td>";
                lineas += "<td>";
                    lineas += rs.pedido_fecha_tope_f;
                lineas += "</td>";
                lineas += "<td>";
                    lineas += rs.pedido_estado;
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
    listarDetalles();
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

function listarDetalles(){
    $.ajax({
        method:"POST",
        url:"controladorDetalles.php",
        data:{
            pedido_nro: $("#pedido_nro").val()
        }
    }).done(function(resultadoDet){
        console.log(JSON.stringify(resultadoDet));
        var lineas = "";
        for(rsd of resultadoDet){
            lineas += "<tr onclick='seleccionDetalle("+JSON.stringify(rsd)+")'>"
                lineas += "<td>";
                    lineas += rsd.mercaderia;
                lineas += "</td>";
                lineas += "<td>";
                    lineas += rsd.items_precio;
                lineas += "</td>";
                lineas += "<td>";
                    lineas += rsd.pedido_cantidad;
                lineas += "</td>";
            lineas += "</tr>"
        }
        $("#grilla_detalles").html(lineas);
    }).fail(function(a,b,c){
        alert(c);
    })
}

function seleccionDetalle(json){
    Object.keys(json).forEach(function(key) {
        $("#"+key).val(json[key]);
    });
    $(".form-line").attr("class","form-line focused");
    $("#operacion_det").val("2");
}