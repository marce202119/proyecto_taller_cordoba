listar();
formatoFecha();

function getlistaProdructos(){
    $.ajax({
        method: "POST",
        url: "listaProductos.php",
        data:{
            Productos:$("#Productos").val()
        }

    }).done(function(lista){
        
        var fila = "";
        $.each(lista, function(i, item){
            fila += "<li class='list-group-item' onclick='seleccionProductos("+JSON.stringify(item)+")'>"+item.Productos+"</li>";
        });

        $("#ulProductos").html(fila);
        $("#listaProductos").attr("style", "display:block; position:absolute; z-index:3000;");
    }).fail(function(a,b,c){
        swal("ERROR", c, "error");
    })
}

function seleccionlistaProductos(datos){
    Object.keys(datos).forEach(key => {
        $("#"+key).val(datos[key]);
    });
    $("#ulProductos").html("");
    $("#listaProductos").attr("style", "display:none;");
    $(".form-line").attr("class","form-line focused");
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
            sucu_nombre: $("#sucu_nombre").val()
        }
    }).done(function(lista) {
        var fila = "";
        $.each(lista, function(i, item) {
            fila += "<li class='list-group-item' onclick='seleccionSucursal(" + JSON.stringify(item) + ")'>" + item.sucu_nombre + "</li>";
        });
        $("#ulSucursal").html(fila);
        $("#listaSucursal").attr("style", "display:block; position:absolute; z-index:3000;");
    }).fail(function(a, b, c) {
        swal("ERROR", c, "error");
    });
}

function agregar(){
    $("#operacion").val(1);
    $("#orden_comp_nro").val(0);
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
            pedido_fecha:$("#pedido_fecha").val(),
            id_sucursal:$("#id_sucursal").val(),
            pedido_estado:$("#pedido_estado").val(),
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
    alert 

    $.ajax({
        method:"POST",
        url:"controladorDetalles.php",
        data:{
            pedido_nro:$("#pedido_nro").val(),
            pdet_cantidad:$("#pdet_cantidad").val(),
            pdet_precio:$("#pdet_precio").val(),
            id_funcionarios:$("#funcio_cod").val(),
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
                    lineas += rs.pedido_nro;
                lineas += "</td>";
                lineas += "<td>";
                    lineas += rs.pedido_fecha;
                lineas += "</td>";
                lineas += "<td>";
                    lineas += rs.id_sucursal;
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
function seleccionDetalle(json){
    Object.keys(json).forEach(function(key) {
        $("#"+key).val(json[key]);
    });
    $(".form-line").attr("class","form-line focused");
    $("#operacion_det").val("2");
}