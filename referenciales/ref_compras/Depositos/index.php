<?php
date_default_timezone_set("America/Asuncion");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Referenciales | Depositos</title>
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
                            <h2>Formulario de Depositos</h2>
                        </div>
                        <div class="body">
                            <input type="hidden" id="operacion" value="1">
                            <div class="row clearfix">
                                <!-- Campos del formulario de depósitos -->
                                <div class="col-md-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="depo_cod" class="form-control" disabled>
                                            <label class="form-label">Código Depósito</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="despo_desc" class="form-control editable" disabled>
                                            <label class="form-label">Descripcion</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="number" id="sucu_cod" class="form-control editable" disabled>
                                            <label class="form-label">Código Sucursal</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="hidden" id="items_cod" value="0">
                                            <input type="text" id="item_nombre" class="form-control editable" onclick="getItems()">
                                            <label class="form-label">Código Item</label>
                                            <div id="listaItems" style="display: none;">
                                                <ul class="list-group" id="ulItems"></ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Botones de operaciones -->
                            <div class="button-demo text-center">
                                <button type="button" class="btn btn-success waves-effect btnOperacion1" onclick="agregar();">AGREGAR</button>
                                <button type="button" class="btn btn-info waves-effect btnOperacion1" onclick="editar();">MODIFICAR</button>
                                <button type="button" class="btn btn-danger waves-effect btnOperacion1" onclick="borrar();">ELIMINAR</button>
                                <button type="button" class="btn btn-primary waves-effect btnOperacion2 hidden" onclick="confirmarOperacion();">GRABAR</button>
                                <button type="button" class="btn btn-warning waves-effect btnOperacion3" onclick="cancelar();">CANCELAR</button>
                            </div>
                        </div>
                    </div>

                    <!-- Tabla de depósitos registrados -->
                    <div class="card">
                        <div class="header">
                            <h2>Depósitos Registrados <small>Lista de Depósitos Registrados</small></h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered table-striped dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Codigo Deposito</th>
                                            <th>Descripcion</th>
                                            <th>Código Sucursal</th>
                                            <th>Código Item</th>
                                        </tr>
                                    </thead>
                                    <tbody id="grilla_datos"></tbody>
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
