<?php
    namespace app\controllers;

    use app\models\EmpleadosModel;
    use app\models\mainModel;
    use PDO;

    class EmpleadosController extends mainModel{
        public function obtenerListaEmpleados()
        {
            $listaEmpleados = $this->ejecutarConsulta("SELECT * FROM ms_empleados");
            return $listaEmpleados;
            
        }

        public function guardarEmpleado()
        {
                $nombre = $_POST['nombre'];
                $apaterno = $_POST['apellido_paterno'];
                $amaterno = $_POST['apellido_materno'];
                $edad = $_POST['edad'];
                $fecha_nacimiento = $_POST['fecha_nacimiento'];
                $genero = $_POST['genero'];
                $sueldo_base = $_POST['sueldo_base'];
                $puesto = $_POST['puesto'];
                $experiencia_profesional = $_POST['experiencia_profesional'];




                $empleado = new EmpleadosModel($nombre, $apaterno, $amaterno, $edad, $fecha_nacimiento, $genero, $sueldo_base, $puesto, $experiencia_profesional);
                if ($empleado->guardar()) {
                    $alert = [
                        "msg" => "Los datos se guardaron correctamente",
                        "redirect" => APP_URL."listEmpleados",
                    ];
                    return json_encode($alert);
                } else {
                    $alert = [
                        "msg" => "Hubo un error al guardar los datos"
                    ];
                    return json_encode($alert);
                }
        }

    }