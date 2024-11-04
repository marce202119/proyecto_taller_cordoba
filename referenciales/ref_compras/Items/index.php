<?php
date_default_timezone_set("America/Asuncion");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Referenciales | Items</title>
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
                            <h2>Formulario de Items</h2>
                        </div>
                        <div class="body">
                            <input type="hidden" id="operacion" value="1">
                            <div class="row clearfix">
                                <div class="col-md-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="items_nro" value=""
                                                class="form-control" disabled>
                                            <label class="form-label">Código</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                                <input type="text" id="items_desc" class="form-control editable" disabled>
                                                <label class="form-label">Descripción</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                                <input type="number" id="items_precio" class="form-control editable" disabled>
                                                <label class="form-label">Precio</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="hidden" id="tip_impto_nro" value="0">
                                            <input type="text" id="impuesto" class="form-control editable" onclick="getTipImpto()">
                                            <label class="form-label">Tipo Impuesto</label>
                                            <div id="listaTipImpto" style="display: none;">
                                                <ul class="list-group" id="ulTipImpto">

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="hidden" id="tip_items_nro" value="0">
                                            <input type="text" id="mercaderia" class="form-control editable" onclick="getTipItems()">
                                            <label class="form-label">Tipo Item</label>
                                            <div id="listaTipo" style="display: none;">
                                                <ul class="list-group" id="ulTipo">

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                                <input type="number" id="items_stock_min" class="form-control editable" disabled>
                                                <label class="form-label">Stock minimo</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                                <input type="number" id="items_stock_max" class="form-control editable" disabled>
                                                <label class="form-label">Stock maximo</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="items_fecha_venc" class="form-control datepicker editable" disabled>
                                            <label class="form-label">Fecha Vencimiento</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" id="items_estado" class="form-control" disabled>
                                            <label class="form-label">Estado</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="button-demo text-center">
                                    <button type="button" class="btn btn-success waves-effect btnOperacion1" onclick="agregar();">AGREGAR</button>
                                    <button type="button" class="btn btn-info waves-effect btnOperacion1" onclick="editar();">MODIFICAR</button>
                                    <button type="button" class="btn btn-danger waves-effect btnOperacion1" onclick="borrar();">ELIMINAR</button>
                                    <button type="button" class="btn btn-primary waves-effect btnOperacion2 hidden" onclick="confirmarOperacion();">GRABAR</button>
                                    <button type="button" class="btn btn-warning waves-effect btnOperacion3" onclick="cancelar();">CANCELAR</button>
                                </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="header">
                            <h2>
                                ITEMS REGISTRADOS <small>Lista de ITEMS Registrados</small>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered table-striped dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Descripción</th>
                                            <th>Precio</th>
                                            <th>Stock min</th>
                                            <th>Stock max</th>
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