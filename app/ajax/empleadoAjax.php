<?php

use app\controllers\EmpleadosController;

require_once "../../config/app.php";
    require_once "../views/session_start.php";
    require_once "../../autoload.php";

    if(isset($_POST['modulo_empleado'])){
        $empleado = new EmpleadosController();

        if ($_POST['modulo_empleado'] == "registrar"){
            echo $empleado->guardarEmpleado();
        }
    }else{
        session_destroy();
        header("Location: ".APP_URL."/login");
    }