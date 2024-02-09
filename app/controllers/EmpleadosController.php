<?php
    namespace app\controllers;

    use app\models\EmpleadosModel;
    use app\models\mainModel;
    use PDO;

    class EmpleadosController extends mainModel{
        public function obtenerListaEmpleados()
        {
            $listaEmpleados = $this->ejecutarConsulta("SELECT * FROM ms_empleados");
            $numeroEmpleados = count($listaEmpleados);
            if ($numeroEmpleados > 0){
                // Comenzar la tabla
                echo '<table class="table">';
                echo '<tr><th scope="col">ID</th><th scope="col">Clave</th><th scope="col">Nombre</th><th scope="col">Edad</th><th scope="col">Fecha Nacimiento</th></tr>';

                // Iterar sobre los resultados y construir las filas de la tabla
                foreach ($listaEmpleados as $empleado) {
                    echo '<tr>';
                    echo '<td>' . $empleado['id_empleado'] . '</td>';
                    echo '<td>' . $empleado['clave_empleado'] . '</td>';
                    echo '<td>' . $empleado['nombre'] . '</td>';
                    echo '<td>' . $empleado['edad'] . '</td>';
                    echo '<td>' . $empleado['fecha_nacimiento'] . '</td>';
                    echo '</tr>';
                }

                // Cerrar la tabla
                echo '</table>';
            }else{
                echo " <script>
                alert('No hay usuarios para mostrar')
                </script> ";
            }
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