
<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Ventas | Ventas</title>
    <?php include "{$_SERVER['DOCUMENT_ROOT']}/taller/importCSS.php"; ?>
    <style>
        .list-group-item:hover {
            background-color: #1f91f3;
            color: white;
        }
    </style>
</head>

<body class="theme-blue">

    <?php include "../../../opciones.php"; ?>

    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>Formulario de Ventas</h2>
                        </div>
                        <div class="body">
                            <input type="hidden" id="operacion" value="1">
                            <div class="row clearfix">
                                <div class="col-md-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="pedido_nro" value="" class="form-control" disabled>
                                            <label class="form-label">Código</label>
                                        </div>
                                    </div>


                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="hidden" id="sucu_cod" value="<?php echo $u['sucu_cod'] ?>" class="form-control" disabled>
                                            <input type="text" id="sucursal" value="<?php echo $u['sucu_desc'] ?>" class="form-control" disabled>
                                            <label class="form-label">Sucursal</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="hidden" id="funcio_cod" value="<?php echo $u['funcio_cod'] ?>" class="form-control" disabled>
                                            <input type="text" id="funcionario" value="<?php echo $u['funcio_nombre'] ?> <?php echo $u['funcio_apellido'] ?>" class="form-control" disabled>
                                            <label class="form-label">Funcionario</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="datetime" id="pedido_fecha" value="<?= date('d/m/Y h:m:s') ?>" class="form-control datetimepicker" disabled>
                                            <label class="form-label">Fecha de Registro</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="pedido_estado" class="form-control" disabled>
                                            <label class="form-label">Estado</label>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="button-demo text-center">
                                    <button type="button" class="btn btn-success waves-effect btnOperacion1" onclick="agregar();">AGREGAR</button>
                                    <button type="button" class="btn btn-danger waves-effect btnOperacion1" onclick="anular();">ANULAR</button>
                                    <button type="button" class="btn btn-primary waves-effect btnOperacion2 hidden" onclick="confirmarOperacion();">GRABAR</button>
                                    <button type="button" class="btn btn-warning waves-effect btnOperacion3" onclick="cancelar();">CANCELAR</button>
                                </div>
                        </div>
                    </div>
                    <div class="card">

                        <div class="header">
                            <h2>Detalles de la Venta</h2>
                        </div>
                        <div class="body">
                            <input type="hidden" id="operacion_det" value="1">
                            <div class="row clearfix">
                                <div class="col-md-5">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="hidden" id="items_cod" value="0">
                                            <input type="text" id="items_desc" class="form-control editableDet" onclick="getProducto()">
                                            <label class="form-label">Producto</label>
                                            <div id="listaProductos" style="display: none;">
                                                <ul class="list-group" id="ulProductos"></ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="items_precio" class="form-control editableDet">
                                            <label class="form-label">Precio</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="number" id="pdet_cantidad" class="form-control editableDet">
                                            <label class="form-label">Cantidad</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="button-demo text-center">
                                        <button type="button" class="btn btn-success waves-effect btnOperacion2" onclick="agregarDetalle(1);">AGREGAR</button>
                                        <button type="button" class="btn btn-info waves-effect btnOperacion2" onclick="agregarDetalle(2);">MODIFICAR</button>
                                        <button type="button" class="btn btn-danger waves-effect btnOperacion4" onclick="agregarDetalle(3);">ELIMINAR</button>
                                        <!--- <button type="button" class="btn btn-danger waves-effect btnOperacion4" onclick="agregarDetalle(3);">EDITAR</button>-->
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Items</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                        </tr>
                                    </thead>
                                    <tbody id="grilla_detalles">
                                    </tbody>
                                    <tfoot id="pie_detalles">

                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="header">
                            <h2>
                                VENTAS REGISTRADOS <small>Lista de Ventas Registrados</small>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered table-striped dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Fecha</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody id="grilla_datos">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <?php include "{$_SERVER['DOCUMENT_ROOT']}/taller/importJS.php"; ?>
    <script src="metodo.js"></script>

</body>

</html>