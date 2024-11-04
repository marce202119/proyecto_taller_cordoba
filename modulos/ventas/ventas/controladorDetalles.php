<?php
header('Content-type: application/json; charset=utf-8');
require_once "../../../app/clases/Conexion.php";
$objConexion = new Conexion();
$conexion = $objConexion->getConexion();

if(isset($_POST['operacion_det'])){

    $sql = "select sp_ventas_det(
        {$_POST['ventas_nro']},
        {$_POST['depo_nro']},
        {$_POST['items_nro']},
        {$_POST['ventas_precio']},
        {$_POST['ventas_cantidad']},
        {$_POST['operacion_det']}
    );";

    $resultado = pg_query($conexion,$sql);
    if(!$resultado){
        echo json_encode(
            array(
                "mensaje"=>pg_last_error(),
                "tipo"=>"error"
            )
        );
    }else{
        $ultcod = pg_fetch_assoc($resultado);
        echo json_encode(
            array(
                "mensaje"=>pg_last_notice($conexion),
                "tipo"=>"success"
            )
        );
    }

    
}else{
    $sql = "select 
    vd.*, vd.ventas_cantidad,
    i.items_nro, i.items_desc as mercaderia,
    i.tip_impto_nro, i.items_precio,
    ti.tip_impto_nro, ti.tip_impto_desc,
    (case i.tip_impto_nro when 1 then vd.ventas_cantidad * vd.ventas_precio else 0 end) as grav5,
    (case i.tip_impto_nro when 2 then vd.ventas_cantidad * vd.ventas_precio else 0 end) as grav10,
    (case i.tip_impto_nro when 3 then vd.ventas_cantidad * vd.ventas_precio else 0 end) as exenta,
    vd.ventas_cantidad as pedido_cantidad
    from ventas_det as vd
    inner join items as i on vd.items_nro = i.items_nro 
    inner join tipo_impuesto as ti on i.tip_impto_nro = ti.tip_impto_nro
    left join pedidos_ventas as pv on vd.ventas_nro = pv.ventas_nro
    full join pedidos_ventas_cab as pvc on pv.pedido_nro = pvc.pedido_nro 
    full join pedidos_ventas_det as pvd on pvc.pedido_nro = pvd.pedido_nro
    where vd.ventas_nro = {$_POST['ventas_nro']}
    group by vd.ventas_nro,vd.depo_nro,vd.items_nro,i.items_nro,ti.tip_impto_nro;";
    $resultado = pg_query($conexion,$sql);
    $datos = pg_fetch_all($resultado);
    echo json_encode($datos);
}
    
?>