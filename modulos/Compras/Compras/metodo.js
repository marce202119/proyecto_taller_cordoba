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
    $(".form-line").attr("class","form-line focused");
}

function getPedidos(){
    var pedidosnro = $("#client_nro").val();
    $.ajax({
        method: "POST",
        url: "listaPedidos.php",
        data:{
            pedidos:pedidosnro
        }

    }).done(function(lista){
        
        var fila = "";
        $.each(lista, function(i, item){
            fila += "<li class='list-group-item' onclick='seleccionPedidos("+JSON.stringify(item)+")'>"+item.pedidos+"</li>";
        });

        $("#ulPedidos").html(fila);
        $("#listaPedidos").attr("style", "display:block; position:absolute; z-index:3000;");
    }).fail(function(a,b,c){
        swal("ERROR", c, "error");
    })
}

function seleccionPedidos(datos){
    Object.keys(datos).forEach(key => {
        $("#"+key).val(datos[key]);
    });
    $("#ulPedidos").html("");
    $("#listaPedidos").attr("style", "display:none;");
    $(".form-line").attr("class","form-line focused");
}

function getCondi(){
    var condi = $("#condicion").val();
    $.ajax({
        method: "POST",
        url: "listaCondicion.php",
        data:{
            condicion:condi
        }

    }).done(function(lista){
        
        var fila = "";
        $.each(lista, function(i, item){
            fila += "<li class='list-group-item' onclick='seleccionCondicion("+JSON.stringify(item)+")'>"+item.condicion+"</li>";
        });

        $("#ulCondi").html(fila);
        $("#listaCondi").attr("style", "display:block; position:absolute; z-index:3000;");
    }).fail(function(a,b,c){
        swal("ERROR", c, "error");
    })
}

function seleccionCondicion(datos){
    Object.keys(datos).forEach(key => {
        $("#"+key).val(datos[key]);
    });
    $("#ulCondi").html("");
    $("#listaCondi").attr("style", "display:none;");
    $(".form-line").attr("class","form-line focused");
    condicion();
}

function condicion(){
    var tipfactura = $("#tip_fac_nro").val()
    if (tipfactura === '2') {
        $(".editable").removeAttr("disabled");
        $('#vent_cuotas').val('0');
        $('#vent_plazo').val('0');
    } else if(tipfactura === '1') {
        $(".editable").attr("disabled", "disabled");
        $('#vent_cuotas').val('1');
        $('#vent_plazo').val('0');
    }
}


function agregar(){
    $("#operacion").val(1);
    $("#ventas_nro").val(0);
    $(".editables").removeAttr("disabled");
    habilitarBotones(false);
    $(".form-line").attr("class","form-line focused");
}

function editar(){
    $("#operacion").val(2);
    $(".editables").removeAttr("disabled");
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

function getProducto(){

    var sucursal = $("#id_sucursal").val()
    var mercaderia = $("#pedido_nro").val()

    if (mercaderia > 0) {

        $.ajax({
            method: "POST",
            url: "listaProductos.php",
            data:{
                mercaderia:mercaderia,
                sucursal: sucursal
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
        
    } else {
        var mercaderia = $("#mercaderia").val()
        $.ajax({
            method: "POST",
            url: "listaProductos2.php",
            data:{
                mercaderia:mercaderia,
                sucursal: sucursal
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
            ventas_nro:$("#ventas_nro").val(),
            vent_fech_emision:$("#vent_fech_emision").val(),
            tip_fac_nro:$("#tip_fac_nro").val(),
            vent_cuotas:$("#vent_cuotas").val(),
            vent_plazo:$("#vent_plazo").val(),
            id_sucursal:$("#id_sucursal").val(),
            id_usuario:$("#id_funcionarios").val(),
            client_nro:$("#client_nro").val(),
            pedido_nro:$("#pedido_nro").val(),
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
                $("#ventas_nro").val(respuesta.ultcod)
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
            ventas_nro:$("#ventas_nro").val(),
            depo_nro:$("#depo_nro").val(),
            items_nro:$("#items_nro").val(),
            ventas_precio:$("#items_precio").val(),
            ventas_cantidad:$("#pedido_cantidad").val(),
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
               $(".editableDet").val("");
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
                    lineas += rs.ventas_nro;
                lineas += "</td>";
                lineas += "<td>";
                    lineas += rs.cliente;
                lineas += "</td>";
                lineas += "<td>";
                    lineas += rs.pedidos;
                lineas += "</td>";
                lineas += "<td>";
                    lineas += rs.condicion;
                lineas += "</td>";
                lineas += "<td>";
                    lineas += rs.vent_estado;
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
            ventas_nro: $("#ventas_nro").val()
        }
    }).done(function(resultadoDet){
        console.log(JSON.stringify(resultadoDet));
        var lineas = "";
        var totalExe = 0;
        var totalG5 = 0;
        var totalG10 = 0;
        var iva5 = 0;
        var iva10 = 0;
        var totalIva = 0;
        var totalGral = 0;
        for(rsd of resultadoDet){
            totalExe += parseInt(rsd.exenta);
            totalG5 += parseInt(rsd.grav5);
            totalG10 += parseInt(rsd.grav10);
            lineas += "<tr onclick='seleccionDetalle("+JSON.stringify(rsd)+")'>"
                lineas += "<td>";
                    lineas += rsd.items_nro;
                lineas += "</td>";
                lineas += "<td>";
                    lineas += rsd.mercaderia;
                lineas += "</td>";
                lineas += "<td>";
                    lineas += rsd.ventas_precio;
                lineas += "</td>";
                lineas += "<td>";
                    lineas += rsd.pedido_cantidad;
                lineas += "</td>";
                lineas += "<td>";
                    lineas += rsd.exenta;
                lineas += "</td>";
                lineas += "<td>";
                    lineas += rsd.grav5;
                lineas += "</td>";
                lineas += "<td>";
                    lineas += rsd.grav10;
                lineas += "</td>";
            lineas += "</tr>"
        }
        iva5 = parseInt(totalG5/21);
        iva10 = parseInt(totalG10/11);
        totalIva = iva5+iva10;
        totalGral = totalExe+totalG5+totalG10;
        var lineaFoot = "<tr>";
            lineaFoot += "<th colspan='4'>";
                lineaFoot += "SUBTOTALES";
            lineaFoot += "</th>";
            lineaFoot += "<th>";
                lineaFoot += totalExe;
            lineaFoot += "</th>";
            lineaFoot += "<th>";
                lineaFoot += totalG5;
            lineaFoot += "</th>";
            lineaFoot += "<th>";
                lineaFoot += totalG10;
            lineaFoot += "</th>";
        lineaFoot += "</tr>";

        lineaFoot += "<tr>";
            lineaFoot += "<th colspan='5'>";
                lineaFoot += "LIQUIDACION DE IVA";
            lineaFoot += "</th>";
            lineaFoot += "<th>";
                lineaFoot += iva5;
            lineaFoot += "</th>";
            lineaFoot += "<th>";
                lineaFoot += iva10;
            lineaFoot += "</th>";
        lineaFoot += "</tr>";

        lineaFoot += "<tr class='bg-orange'>";
            lineaFoot += "<th colspan='6'>";
                lineaFoot += "TOTAL IVA";
            lineaFoot += "</th>";
            lineaFoot += "<th>";
                lineaFoot += totalIva;
            lineaFoot += "</th>";
        lineaFoot += "</tr>";

        lineaFoot += "<tr class='bg-red'>";
            lineaFoot += "<th colspan='6'>";
                lineaFoot += "TOTAL GENERAL";
            lineaFoot += "</th>";
            lineaFoot += "<th>";
                lineaFoot += totalGral;
            lineaFoot += "</th>";
        lineaFoot += "</tr>";
        
        $("#grilla_detalles").html(lineas);
        $("#pie_detalles").html(lineaFoot);

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