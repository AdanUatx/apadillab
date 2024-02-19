<?php
require_once "./autoload.php";
require_once "./views/session_start.php";
if(isset($_GET['views'])){
    $url=explode("/",$_GET['views']);
}else{
    $url=["login"];
}
?>


<!DOCTYPE html>
<html lang="es">
<?php
require_once 'views/inc/header.php';
?>
<body>

<?php

    $url = isset($_GET['views']) ? $_GET['views'] : 'login';
    $url = str_replace('views/', '', $url);
    $vista = obtenerVistas($url);

    function obtenerVistas($vista)
    {
        $listaBlanca = ["login","logOut", "listadoEmpleados", "agregarEmpleado"];

        if (in_array($vista, $listaBlanca)) {
            if (is_file("./views/" . $vista . ".php")) {
                $contenidoMostrar = "./views/" . $vista . ".php";
            } else {
                $contenidoMostrar = "404";
            }
        } elseif ($vista == 'login' || $vista == 'index') {
            $contenidoMostrar = "login";
        } else {
            $contenidoMostrar = "404";
        }
        return $contenidoMostrar;
    }

    if ($vista == "login" || $vista == "404") {
        require_once "./views/" . $vista . ".php";
    } else {
        if (!isset($_SESSION['id'])) {
            //echo "No hay session activa";
        }else{
            require_once "./views/inc/nav-bar.php";
        }
        require_once $vista;
    }


require_once 'views/inc/footer.php'
?>
</body>
</html>