<?php
header('Content-type: application/json; charset=utf-8');
require_once "../../../app/clases/Conexion.php";
$objConexion = new Conexion();
$conexion = $objConexion->getConexion();

if(isset($_POST['operacion'])){

    $sql = "select * from sp_cliente(
        {$_POST['client_cod']},
        '{$_POST['client_nombre']}',
        '{$_POST['client_apellido']}',
        '{$_POST['client_doc_ident']}',
        '{$_POST['client_direc']}',
        '{$_POST['client_telf']}',
        '{$_POST['client_email']}',
        '{$_POST['client_fecha_in']}',
        '{$_POST['client_obs']}',
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
    $sql = "select * from cliente";
    $resultado = pg_query($conexion,$sql);
    $datos = pg_fetch_all($resultado);
    echo json_encode($datos);
}
    
?>
