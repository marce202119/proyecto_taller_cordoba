<?php
header('Content-type: application/json; charset=utf-8');
require_once "../../../app/clases/Conexion.php";
$objConexion = new Conexion();
$conexion = $objConexion->getConexion();

if(isset($_POST['operacion'])){

    $sql = "select * from sp_nota_comp_cab(
        {$_POST['n_comp_nro']},
        {$_POST['comp_nro_factura']},
        '{$_POST['n_comp_fecha ']}',
        '{$_POST['n_comp_estado']}',
        {$_POST['funcio_cod']},
        {$_POST['id_sucursal']},
        '{$_POST['nota_comp_vig_hasta']}',
        {$_POST['nota_comp_timb_nro']},
        {$_POST['nota_comp_fact_nro']},
        {$_POST['nota_comp_monto']},
        '{$_POST['nota_comp_motivo']}',
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
    $sql = "select * from nota_comp_cab as ncc ";
    $resultado = pg_query($conexion, $sql);
    $datos = pg_fetch_all($resultado);
    echo json_encode($datos);
}
    
?>