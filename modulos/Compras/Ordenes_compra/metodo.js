listar();
formatoFecha();

function getlistaProveedor(){
    $.ajax({
        method: "POST",
        url: "listaProveedor.php",
        data:{
            proveedor:$("#proveedor").val()
        }

    }).done(function(lista){
        
        var fila = "";
        $.each(lista, function(i, item){
            fila += "<li class='list-group-item' onclick='seleccionproveedor("+JSON.stringify(item)+")'>"+item.proveedor+"</li>";
        });

        $("#ulproveedor").html(fila);
        $("#listaProveedor").attr("style", "display:block; position:absolute; z-index:3000;");
    }).fail(function(a,b,c){
        swal("ERROR", c, "error");
    })
}

function seleccionlistaProveedor(datos){
    Object.keys(datos).forEach(key => {
        $("#"+key).val(datos[key]);
    });
    $("#ulproveedor").html("");
    $("#listaProveedor").attr("style", "display:none;");
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
            orden_comp_nro:$("#orden_comp_nro").val(),
            orden_comp_fecha:$("#orden_comp_fecha").val(),
            id_sucursal:$("#id_sucursal").val(),
            orden_compra_estado:$("#orden_compra_estado").val(),
            provee_cod:$("#provee_cod").val(),
            tip_fac_cod:$("#tip_fac_cod").val(),
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
                $("#orden_comp_nro").val(respuesta.ultcod)
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
            orden_comp_nro:$("#orden_comp_nro").val(),
            items_nro:$("#items_nro").val(),
            oc_cantidad:$("#oc_cantidad").val(),
            oc_precio:$("#oc_precio").val(),
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
                    lineas += rs.orden_comp_nro;
                lineas += "</td>";
                lineas += "<td>";
                    lineas += rs.orden_comp_fecha;
                lineas += "</td>";
                lineas += "<td>";
                    lineas += rs.id_sucursal;
                lineas += "</td>";
                lineas += "<td>";
                    lineas += rs.orden_compra_estado;
                lineas += "</td>";
                lineas += "<td>";
                    lineas += rs.provee_cod;
                lineas += "</td>";
                lineas += "<td>";
                    lineas += rs.tip_fac_cod;
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