<?php
header('Content-type: application/json; charset=utf-8');
require_once "../../../app/clases/Conexion.php";
$objConexion = new Conexion();
$conexion = $objConexion->getConexion();

if(isset($_POST['operacion'])){

    $sql = "select * from sp_compra_cab(
        {$_POST['comp_nro_factura']},
        '{$_POST['comp_fecha']}',
        {$_POST['comp_cuota ']},
        {$_POST['comp_plazo']},
        '{$_POST['comp_inter_fcha_cuot_venci']}',
        '{$_POST['comp_estado']}',
        {$_POST['id_sucursal']},
        {$_POST['tip_fac_cod']},
        {$_POST['timb_cod']},
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
    $sql = "select * from compra_cab as cc ";
    $resultado = pg_query($conexion, $sql);
    $datos = pg_fetch_all($resultado);
    echo json_encode($datos);
}
    
?>