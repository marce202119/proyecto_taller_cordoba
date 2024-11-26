<?php
header('Content-type: application/json; charset=utf-8');
require_once "../../../app/clases/Conexion.php";
$objConexion = new Conexion();
$conexion = $objConexion->getConexion();

if(isset($_POST['operacion'])){

    $sql = "select * from sp_orden_comp_cab(
        {$_POST['orden_comp_nro']},
        '{$_POST['orden_comp_fecha']}',
        {$_POST['id_sucursal']},
        '{$_POST['orden_compra_estado']}',
        {$_POST['provee_cod']},
        {$_POST['tip_fac_cod']},
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
    $sql = "select * from pedido_compra_cab as pcc ";
    $resultado = pg_query($conexion, $sql);
    $datos = pg_fetch_all($resultado);
    echo json_encode($datos);
}
    
?>