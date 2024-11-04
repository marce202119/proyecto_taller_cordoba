<?php
header('Content-type: application/json; charset=utf-8');
require_once "../../../app/clases/Conexion.php";
$objConexion = new Conexion();
$conexion = $objConexion->getConexion();

if(isset($_POST['operacion'])){

    $sql = "select * from sp_pedidos_ventas_cab(
        {$_POST['pedido_nro']},
        '{$_POST['pedido_fecha']}',
        {$_POST['client_nro']},
        '{$_POST['pedido_obs']}',
        {$_POST['id_funcionarios']},
        {$_POST['id_sucursal']},
        '{$_POST['pedido_fecha_tope']}',
        '{$_POST['pedido_fecha_pedido']}',
        {$_POST['operacion']}
    ) as ultcod;";

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

    
}else{
    $sql = "select 
    pvc.*,
    to_char(pvc.pedido_fecha, 'dd/mm/yyyy HH24:mi:ss') as pedido_fecha_f,
    to_char(pvc.pedido_fecha_pedido, 'dd/mm/yyyy HH24:mi:ss') as pedido_fecha_pedido_f,
    to_char(pvc.pedido_fecha_tope, 'dd/mm/yyyy HH24:mi:ss') as pedido_fecha_tope_f,
    to_char(pvc.pedido_fecha_cancel, 'dd/mm/yyyy HH24:mi:ss') as pedido_fecha_cancel_f,
    c.client_razon_social as cliente,
    c.client_ruc,pvc.pedido_estado 
    from pedidos_ventas_cab as pvc
    inner join cliente as c  on pvc.client_nro = c.client_nro;";
    $resultado = pg_query($conexion,$sql);
    $datos = pg_fetch_all($resultado);
    echo json_encode($datos);
}
    
?>