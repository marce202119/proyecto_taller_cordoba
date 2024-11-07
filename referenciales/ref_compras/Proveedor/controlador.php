<?php
header('Content-type: application/json; charset=utf-8');
require_once "../../../app/clases/Conexion.php";
$objConexion = new Conexion();
$conexion = $objConexion->getConexion();

if(isset($_POST['operacion'])){

    $sql = "select * from sp_proveedores(
        {$_POST['provee_cod,']},
        '{$_POST['provee_name']}',
        '{$_POST['provee_ruc']}',
        '{$_POST['provee_direccion']}',
        '{$_POST['provee_fecha_inc']}',
        '{$_POST['provee_email']}',
        '{$_POST['provee_telef']}',
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
    $sql = "SELECT * from proveedor";
    $resultado = pg_query($conexion, $sql);
    $datos = pg_fetch_all($resultado);
    echo json_encode($datos);


    }
?>