<?php
header('Content-type: application/json; charset=utf-8');
require_once "../../../app/clases/Conexion.php";
$objConexion = new Conexion();
$conexion = $objConexion->getConexion();

if(isset($_POST['operacion_det'])){

    $sql = "select sp_pedido_compra_det(
        {$_POST['pedido_nro']},
        {$_POST['pdet_cantidad']},
        {$_POST['pdet_precio']},
        {$_POST['items_cod']},
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
    $sql = "select pcd.*, pcd.pdet_precio as items_precio, i.items_desc 
    from pedido_compra_det as pcd 
    inner join items as i on pcd.items_cod = i.items_cod 
    where pcd.pedido_nro = {$_POST['pedido_nro']}";
    $resultado = pg_query($conexion,$sql);
    $datos = pg_fetch_all($resultado);
    echo json_encode($datos);
}
    
?>