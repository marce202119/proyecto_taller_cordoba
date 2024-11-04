<?php
header('Content-type: application/json; charset=utf-8');
require_once "../../../app/clases/Conexion.php";
$objConexion = new Conexion();
$conexion = $objConexion->getConexion();

if(isset($_POST['operacion'])){

    $sql = "select * from sp_ventas_cab(
        {$_POST['ventas_nro']},
        '{$_POST['vent_fech_emision']}',
        {$_POST['tip_fac_nro']},
        {$_POST['vent_cuotas']},
        {$_POST['vent_plazo']},
        {$_POST['id_sucursal']},
        {$_POST['id_usuario']},
        {$_POST['client_nro']},
        {$_POST['pedido_nro']},
        {$_POST['operacion']}
    ) as ultcod;";

    //echo ($sql);

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
                "tipo"=>"success",
                "ultcod"=>$ultcod['ultcod']
            )
        );
    }
} else {
    $sql = "select 
        vc.*,
        tf.tip_fac_nro, tf.tip_fac_desc as condicion,
        to_char(vc.vent_fech_cancel, 'dd/mm/yyyy HH24:mi:ss') as vent_fech_cancel_f,
        c.client_nro, c.client_razon_social ||' | Ruc: '||c.client_ruc as cliente,
        pvc.pedido_nro ||' -- '|| c.client_razon_social as pedidos,
        coalesce (pvc.pedido_nro, 0) as pedido_nro
        from ventas_cab as vc
        inner join tipo_factura as tf on vc.tip_fac_nro = tf.tip_fac_nro
        inner join cliente as c on vc.client_nro = c.client_nro
        left join pedidos_ventas as pv on vc.ventas_nro = pv.ventas_nro
        left join pedidos_ventas_cab as pvc on pv.pedido_nro = pvc.pedido_nro;";
    $resultado = pg_query($conexion, $sql);
    $datos = pg_fetch_all($resultado);
    echo json_encode($datos);
}
    
?>