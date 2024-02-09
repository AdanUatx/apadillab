<?php
    require_once "./config/app.php";
    require_once "./autoload.php";
    require_once "./app/views/session_start.php";
    if(isset($_GET['views'])){
        $url=explode("/",$_GET['views']);
    }else{
        $url=["login"];
    }
    ?>

<!doctype html>
<html lang="es">
<head>
    <?php require_once "./app/views/inc/header.php" ?>
</head>
<body>


    <?php
    use app\controllers\VistasController;
    use app\controllers\AuthController;

    $insLogin = new AuthController();

    $vistasController = new VistasController();

    $vista = $vistasController->obtenerVistasControlador($url[0]);

    if ($vista == "login" || $vista == "404") {
        require_once "./app/views/".$vista.".view.php";
    } else {
        if (!isset($_SESSION['id'])){
            $insLogin->cerrarSesionControlador();
            exit();
        }
        require_once "./app/views/inc/navbar.php";
        require_once $vista;
    }

    require_once "./app/views/inc/footer.php" ?>
</body>
</html>
