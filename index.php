<?php
    session_start();
    session_destroy();
$sql = "SELECT sucu_cod, sucu_desc FROM sucursal ORDER BY sucu_desc ASC";

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Ingresar | Taller Cordoba</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet"
        type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- sweetalert Css -->
    <link href="plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);"><img src="images/image-gallery/23.png"></a>
            <small>Sistema de Servicios</small>
        </div>
        <div class="card">
            <div class="body">
                <div class="msg">Ingrese los datos para iniciar sesión</div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">person</i>
                    </span>
                    <div class="form-line">
                        <input type="text" class="form-control" id="usu_alias" placeholder="Usuario" required autofocus>
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line">
                        <input type="password" class="form-control" id="usu_clave" placeholder="Contraseña" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-8 p-t-5">
                        <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                        <label for="rememberme">Recuérdame</label>
                    </div>
                    <div class="col-xs-4">
                        <button class="btn btn-block bg-pink waves-effect" type="button"
                            onclick="verificarUsuario();">INGRESAR</button>
                    </div>
                </div>
                <div class="row m-t-15 m-b--20">
                    <!-- <div class="col-xs-6">
                            <a href="sign-up.html">Register Now!</a>
                        </div>-->
                    <div class="col-xs-6 align-center">
                        <a href="forgot-password.html">Olvidé mi contraseña</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="plugins/jquery-validation/jquery.validate.js"></script>

    <!-- SweetAlert Plugin Js -->
    <script src="plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <script src="js/pages/examples/sign-in.js"></script>

    <script>
        function verificarUsuario() {


            $.ajax({
                method: "POST",
                url: "acceso.php",
                data: {
                    usu_alias: $("#usu_alias").val(),
                    usu_clave: $("#usu_clave").val()
                }
            }).done(function (resultado) {
                if (!resultado) {
                    swal("ERROR!!", "USUARIO O CONTRASENA INCORRECTA", "error");
                    $("usu_alias").val("");
                    $("usu_clave").val("");
                } else {
                    swal({
                        title: "BIENVENIDO!!",
                        text: resultado.funcionario,
                        type: "success"
                    }, function () {
                        window.location = "menu.php";
                    });
                }

            }).fail(function (a, b, c) {
                alert(c);
            });



            // window.location = "menu.php";
        }
    </script>

</body>

</html>