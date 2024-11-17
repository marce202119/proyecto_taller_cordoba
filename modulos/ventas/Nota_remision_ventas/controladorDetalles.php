<?php
header('Content-type: application/json; charset=utf-8');
require_once "../../../app/clases/Conexion.php";
$objConexion = new Conexion();
$conexion = $objConexion->getConexion();

if(isset($_POST['operacion_det'])){

    $sql = "select sp_pedidos_ventas_det(
        {$_POST['pedido_nro']},
        {$_POST['items_nro']},
        {$_POST['pedido_precio']},
        {$_POST['pedido_cantidad']},
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
    pvd.*,
    pvd.pedido_nro,
    i.items_desc as mercaderia, i.items_precio, i.items_nro 
    from pedidos_ventas_det as pvd
    inner join items as i on pvd.items_nro = i.items_nro  
    where pedido_nro = {$_POST['pedido_nro']};";
    $resultado = pg_query($conexion,$sql);
    $datos = pg_fetch_all($resultado);
    echo json_encode($datos);
}
    
?>