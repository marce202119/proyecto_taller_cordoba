<?php
session_start();
if (isset($_SESSION['usuario'])) {
    $u = $_SESSION['usuario'];
} else {
    header("location: http://localhost/taller/index.php");
}

?>

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="preloader">
            <div class="spinner-layer pl-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
        <p>Por favor espere...</p>
    </div>
</div>
<!-- #END# Page Loader -->
<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<!-- #END# Overlay For Sidebars -->
<!-- Search Bar -->
<div class="search-bar">
    <div class="search-icon">
        <i class="material-icons">search</i>
    </div>
    <input type="text" placeholder="Buscar...">
    <div class="close-search">
        <i class="material-icons">close</i>
    </div>
</div>
<!-- #END# Search Bar -->
<!-- Top Bar -->
<nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index.html">TALLER CORDOBA</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                    <!-- #END# Call Search -->
                    <!-- Notifications -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">notifications</i>
                            <span class="label-count">7</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">NOTIFICATIONS</li>
                            <li class="body">
                                <ul class="menu">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">person_add</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>12 new members joined</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 14 mins ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-cyan">
                                                <i class="material-icons">add_shopping_cart</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>4 sales made</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 22 mins ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-red">
                                                <i class="material-icons">delete_forever</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>Nancy Doe</b> deleted account</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 3 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-orange">
                                                <i class="material-icons">mode_edit</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>Nancy</b> changed name</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 2 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-blue-grey">
                                                <i class="material-icons">comment</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>John</b> commented your post</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 4 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-light-green">
                                                <i class="material-icons">cached</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4><b>John</b> updated status</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> 3 hours ago
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="icon-circle bg-purple">
                                                <i class="material-icons">settings</i>
                                            </div>
                                            <div class="menu-info">
                                                <h4>Settings updated</h4>
                                                <p>
                                                    <i class="material-icons">access_time</i> Yesterday
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="javascript:void(0);">View All Notifications</a>
                            </li>
                        </ul>
                    </li>
                    <!-- #END# Notifications -->
                    <!-- Tasks -->
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">flag</i>
                            <span class="label-count">9</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">TASKS</li>
                            <li class="body">
                                <ul class="menu tasks">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Footer display issue
                                                <small>32%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-pink" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 32%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Make new buttons
                                                <small>45%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-cyan" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Create new dashboard
                                                <small>54%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-teal" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 54%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Solve transition issue
                                                <small>65%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 65%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Answer GitHub questions
                                                <small>92%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-purple" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 92%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="javascript:void(0);">View All Tasks</a>
                            </li>
                        </ul>
                    </li>
                    <!-- #END# Tasks -->
                    <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>
                </ul>
            </div>
        </div>
    </nav>
<!-- #Top Bar -->
<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
                <img src="/taller/images/user.png" width="48" height="48" alt="User" />
            </div>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $u['funcio_nombre'] . " " . $u['funcio_apellido'] ?>
                </div>
                <div class="email">
                    <?php echo $u['funcio_email'] ?>
                </div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="javascript:void(0);"><i class="material-icons">person</i>Perfil</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="javascript:void(0);"><i class="material-icons">group</i>
                                <?php echo $u['per_desc'] ?>
                            </a></li>
                        <li><a href="javascript:void(0);"><i class="material-icons">location_on</i>
                                <?php echo $u['sucu_nombre'] ?>
                            </a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="/taller/index.php"><i class="material-icons">input</i>Salir</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">MENU PRINCIPAL</li>
                <li class="active">
                    <a href="/taller/menu.php">
                        <i class="material-icons">home</i>
                        <span>INICIO</span>
                    </a>
                </li>

                <?php if ($u['per_desc'] == "AdminGRP") { ?>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">folder</i>
                        <span>Referenciales</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="javascript:void(0);" class="menu-toggle">
                                <span>Refer. Compras</span>
                            </a>
                            <ul class="ml-menu">
                                <li>
                                    <a href="/taller/referenciales/ref_compras/proveedor/index.php">Proveedor</a>
                                </li>
                                <li>
                                    <a href="/taller/referenciales/ref_compras/items/index.php">Items</a>
                                </li>
                                <li>
                                    <a href="/taller/referenciales/ref_compras/Tipo_items/index.php">Tipo de items</a>
                                </li>
                                <li>
                                    <a href="/taller/referenciales/ref_compras/depositos/index.php">Depositos</a>
                                </li>
                                <li>
                                    <a href="/taller/referenciales/ref_compras/tipo_impuesto/index.php">Tipo de Impuesto</a>
                                </li>
                                <li>
                                    <a href="/taller/referenciales/ref_compras/tipo_proveedor/index.php">Tipo de Proveedor</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="menu-toggle">
                                <span>Refer. Servicios</span>
                            </a>
                            <ul class="ml-menu">
                                <li>
                                    <a href="/taller/referenciales/ref_Gestion_de_servicios/Registro_clientes/index.php">Registro de cliente </a>
                                </li>
                                <li>
                                    <a href="/taller/referenciales/ref_Gestion_de_servicios/Tipo_servicios/index.php">Tipo de servicios</a>
                                </li>
                                <li>
                                    <a href="/taller/referenciales/ref_Gestion_de_servicios/Tipo_pintura/index.php">Tipo de pintura</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="menu-toggle">
                                <span>Refer. Ventas</span>
                            </a>
                            <ul class="ml-menu">
                                <li>
                                    <a href="/taller/referenciales/ref_ventas/formas_cobro/index.php">Forma de Cobro</a>
                                </li>
                                <li>
                                    <a href="/taller/referenciales/ref_ventas/caja/index.php">Caja</a>
                                </li>
                                <li>
                                    <a href="/taller/referenciales/ref_ventas/entidad_emisora/index.php">Entidad emisora</a>
                                </li>
                                <li>
                                    <a href="/taller/referenciales/ref_ventas/entidad_aderida/index.php">Entidad aderida</a>
                                </li>
                                <li>
                                    <a href="/taller/referenciales/ref_ventas/marca_tarjeta/index.php">Marca de tarjeta</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <?php } ?>


                <?php if ($u['per_desc'] == "AdminGRP") { ?>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">store</i>
                        <span>Compras</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="/taller/modulos/Compras/pedido_compras">Pedido compras</a>
                        </li>
                        <li>
                            <a href="/taller/modulos/Compras/Ordenes_compra">Ordenes de Compras</a>
                        </li>
                        <li>
                            <a href="/taller/modulos/Compras/Nota_credito_debito_compras">Notas de credito/debito Compras</a>
                        </li>
                        <li>
                            <a href="/taller/modulos/Compras/Nota_remision_compras">Notas de Remisión de compras</a>
                        </li>
                        <li>
                            <a href="/taller/modulos/Compras/Presupuesto_proveedor">Presupuesto proveedor</a>
                        </li>
                        <li>
                            <a href="/taller/modulos/Compras/Ajuste_inventario">Ajustes de inventario</a>
                        </li>
                    </ul>
                </li>
                <?php } ?>

                <?php if ($u['per_desc'] == "AdminGRP") { ?>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">directions_boat</i>
                        <span>Servicios</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="/taller/modulos/Servicios/Contratos">Contratos</a>
                        </li>
                        <li>
                            <a href="/taller/modulos/Servicios/Entrega_vehiculos">Entrega de vehiculos</a>
                        </li>
                        <li>
                            <a href="/taller/modulos/Servicios/Insumos_utilizados">insumos utilizados</a>
                        </li>
                        <li>
                            <a href="/taller/modulos/Servicios/Orden_trabajo">Orden de trabajo</a>
                        </li>
                        <li>
                            <a href="/taller/modulos/Servicios/Promociones">Promociones</a>
                        </li>
                        <li>
                            <a href="/taller/modulos/Servicios/Reclamos_clientes">Reclamos de clientes</a>
                        </li>
                        <li>
                            <a href="/taller/modulos/Servicios/Solicitud_servicio">Solicitud de servicio</a>
                        </li>
                        <li>
                            <a href="/taller/modulos/Servicios/Tipo_descuento">Tipo de descuentos</a>
                        </li>
                        <li>
                            <a href="/taller/modulos/Servicios/Tipo_diagnostico">Tipo de diagnostico</a>
                        </li>
                    </ul>
                </li>
                <?php } ?>

                <?php if ($u['per_desc'] == "AdminGRP") { ?>
                <li>
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">add_shopping_cart</i>
                        <span>Ventas</span>
                    </a>
                    <ul class="ml-menu">
                        <li>
                            <a href="/taller/modulos/ventas/pedidos">Pedidos Ventas</a>
                        </li>
                        <li>
                            <a href="/taller/modulos/ventas/ventas">Ventas</a>
                        </li>
                        <li>
                            <a href="/taller/modulos/ventas/Apertura_cierre_caja">Apertura y cierre de caja</a>
                        </li>
                        <li>
                            <a href="/taller/modulos/ventas/Arqueo_caja">Arqueo de caja</a>
                        </li>
                        <li>
                            <a href="/taller/modulos/ventas/Forma_cobro_recibos">Formas de cobro e imprimir recibos</a>
                        </li>
                        <li>
                            <a href="/taller/modulos/ventas/Nota_credito_debito_venta">Notas de Crédito/debito ventas</a>
                        </li>
                        <li>
                            <a href="/taller/modulos/ventas/Nota_remision_ventas">Notas de remision ventas</a>
                        </li>
                        <li>
                            <a href="/taller/modulos/ventas/Recaudaciones_depositar">Recaudaciones a depositar</a>
                        </li>
                    </ul>
                </li>
                <?php } ?>
            </ul>
        </div>
        <!-- #Menu -->
    </aside>
    <!-- #END# Left Sidebar -->
    <!-- Right Sidebar -->
    <aside id="rightsidebar" class="right-sidebar">
        <ul class="nav nav-tabs tab-nav-right" role="tablist">
            <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
            <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                <ul class="demo-choose-skin">
                    <li data-theme="red" class="active">
                        <div class="red"></div>
                        <span>Red</span>
                    </li>
                    <li data-theme="pink">
                        <div class="pink"></div>
                        <span>Pink</span>
                    </li>
                    <li data-theme="purple">
                        <div class="purple"></div>
                        <span>Purple</span>
                    </li>
                    <li data-theme="deep-purple">
                        <div class="deep-purple"></div>
                        <span>Deep Purple</span>
                    </li>
                    <li data-theme="indigo">
                        <div class="indigo"></div>
                        <span>Indigo</span>
                    </li>
                    <li data-theme="blue">
                        <div class="blue"></div>
                        <span>Blue</span>
                    </li>
                    <li data-theme="light-blue">
                        <div class="light-blue"></div>
                        <span>Light Blue</span>
                    </li>
                    <li data-theme="cyan">
                        <div class="cyan"></div>
                        <span>Cyan</span>
                    </li>
                    <li data-theme="teal">
                        <div class="teal"></div>
                        <span>Teal</span>
                    </li>
                    <li data-theme="green">
                        <div class="green"></div>
                        <span>Green</span>
                    </li>
                    <li data-theme="light-green">
                        <div class="light-green"></div>
                        <span>Light Green</span>
                    </li>
                    <li data-theme="lime">
                        <div class="lime"></div>
                        <span>Lime</span>
                    </li>
                    <li data-theme="yellow">
                        <div class="yellow"></div>
                        <span>Yellow</span>
                    </li>
                    <li data-theme="amber">
                        <div class="amber"></div>
                        <span>Amber</span>
                    </li>
                    <li data-theme="orange">
                        <div class="orange"></div>
                        <span>Orange</span>
                    </li>
                    <li data-theme="deep-orange">
                        <div class="deep-orange"></div>
                        <span>Deep Orange</span>
                    </li>
                    <li data-theme="brown">
                        <div class="brown"></div>
                        <span>Brown</span>
                    </li>
                    <li data-theme="grey">
                        <div class="grey"></div>
                        <span>Grey</span>
                    </li>
                    <li data-theme="blue-grey">
                        <div class="blue-grey"></div>
                        <span>Blue Grey</span>
                    </li>
                    <li data-theme="black">
                        <div class="black"></div>
                        <span>Black</span>
                    </li>
                </ul>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="settings">
                <div class="demo-settings">
                    <p>GENERAL SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Report Panel Usage</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                        <li>
                            <span>Email Redirect</span>
                            <div class="switch">
                                <label><input type="checkbox"><span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                    <p>SYSTEM SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Notifications</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                        <li>
                            <span>Auto Updates</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                    <p>ACCOUNT SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Offline</span>
                            <div class="switch">
                                <label><input type="checkbox"><span class="lever"></span></label>
                            </div>
                        </li>
                        <li>
                            <span>Location Permission</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </aside>
    <!-- #END# Right Sidebar -->
</section>