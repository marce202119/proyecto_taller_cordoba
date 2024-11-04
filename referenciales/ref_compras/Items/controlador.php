<?php
header('Content-type: application/json; charset=utf-8');
require_once "../../../app/clases/Conexion.php";
$objConexion = new Conexion();
$conexion = $objConexion->getConexion();

if(isset($_POST['operacion'])){

    $sql = "select * from sp_items(
        {$_POST['items_nro']},
        '{$_POST['items_fecha_venc']}',
        {$_POST['items_precio']},
        {$_POST['items_stock_min']},
        {$_POST['items_stock_max']},
        '{$_POST['items_desc']}',
        {$_POST['tip_impto_nro']},
        {$_POST['tip_items_nro']},
        {$_POST['operacion']}
    ) as ultcod;";
        //echo($sql);
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
    i.*,
    ti.tip_impto_nro, tip_impto_desc as impuesto,
    ti2.tip_items_nro, ti2.tip_items_desc as mercaderia
    from items i 
    inner join tipo_impuesto as ti on i.tip_impto_nro = ti.tip_impto_nro
    inner join tipo_items as ti2 on i.tip_items_nro = ti2.tip_items_nro";
    $resultado = pg_query($conexion,$sql);
    $datos = pg_fetch_all($resultado);
    echo json_encode($datos);
}
    
?>