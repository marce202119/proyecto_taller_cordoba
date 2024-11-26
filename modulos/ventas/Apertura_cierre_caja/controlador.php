<?php
header('Content-type: application/json; charset=utf-8');
require_once "../../../app/clases/Conexion.php";
$objConexion = new Conexion();
$conexion = $objConexion->getConexion();

if(isset($_POST['operacion'])){

    $sql = "select * from sp_apertura_cierre(
        {$_POST['aper_cierre_nro']},
        '{$_POST['ac_fcha_cierre']}',
        '{$_POST['ac_fcha_apertura']}',
        {$_POST['ac_monto_apertura']},
        {$_POST['ac_monto_cierre']},
        {$_POST['id_sucursal']},
        {$_POST['funcio_cod']},
        {$_POST['caja_nro']},
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
    $sql = "select select * from apertura_cierre as ac";
    $resultado = pg_query($conexion,$sql);
    $datos = pg_fetch_all($resultado);
    echo json_encode($datos);
}
    
?>