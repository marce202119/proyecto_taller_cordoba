<?php
header('Content-type: application/json; charset=utf-8');
require_once "../../../app/clases/Conexion.php";
$objConexion = new Conexion();
$conexion = $objConexion->getConexion();

if(isset($_POST['operacion'])){

    $sql = "select * from sp_proveedores(
        {$_POST['proveecod,']},
        '{$_POST['nombre']}',
        '{$_POST['ruc']}',
        '{$_POST['direccion']}',
        '{$_POST['email']}',
        '{$_POST['telefono']}',
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
    $sql = "SELECT * FROM sp_proveedores";
    $resultado = pg_query($conexion, $sql);
    $datos = pg_fetch_all($resultado);
    echo json_encode($datos);
    }
?>