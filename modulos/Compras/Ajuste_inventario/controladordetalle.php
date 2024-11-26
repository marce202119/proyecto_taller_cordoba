<?php
header('Content-type: application/json; charset=utf-8');
require_once "../../../app/clases/Conexion.php";
$objConexion = new Conexion();
$conexion = $objConexion->getConexion();

if(isset($_POST['operacion_det'])){

    $sql = "select sp_ajuste_det(
        {$_POST['ajus_nro']},
        '{$_POST['ajus_motivo_cod']}',
        {$_POST['ajus_det_cantidad']},
        {$_POST['ajus_det_precio']},
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
    $sql = "select * from ajuste_det as ajd ";
    $resultado = pg_query($conexion,$sql);
    $datos = pg_fetch_all($resultado);
    echo json_encode($datos);
}
    
?>