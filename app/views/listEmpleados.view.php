<div class="container pt-5">
    <div class="row">
        <div class="col-8">
            <div class="d-flex justify-content-centerus">
                <h2>Lista de empleados</h2>
            </div>
        </div>
        <div class="col-4">
        <?php if ($_SESSION['rol'] === "Administrador"): ?>
            <a class="btn btn-sm btn-primary" href="<?php echo APP_URL; ?>agregarEmpleado">Agregar Empleado</a>
        <?php endif; ?>
        </div>

    </div>
    <div class="container">
    <?php
    use app\controllers\EmpleadosController;

    $empleadosController = new EmpleadosController();
    $empleados = $empleadosController->obtenerListaEmpleados();
    
    echo '<table class="table">';
    echo '<table class="table">';
        echo '<tr><th scope="col">ID</th><th scope="col">Clave</th><th scope="col">Nombre</th><th scope="col">Edad</th><th scope="col">Fecha Nacimiento</th>';
        
        // Verifica el rol del usuario
        if ($_SESSION['rol'] === "Administrador") {
            echo '<th scope="col">Acciones</th>';
        }
        
        echo '</tr>';

    if (!empty($empleados)) {
        foreach ($empleados as $empleado) {
            echo '<tr>';
            echo '<td>' . $empleado['id_empleado'] . '</td>';
            echo '<td>' . $empleado['clave_empleado'] . '</td>';
            echo '<td>' . $empleado['nombre'] .' '. $empleado['apellido_paterno'] .' '. $empleado['apellido_materno']. '</td>';
            echo '<td>' . $empleado['edad'] . '</td>';
            echo '<td>' . $empleado['fecha_nacimiento'] . '</td>';
            
            if ($_SESSION['rol'] === "Administrador") {
                echo '<td>';
                echo '<a class = "btn btn-warning" href="">Editar</a> | ';
                echo '<a class = "btn btn-danger" href="">Eliminar</a>';
                echo '</td>';
            }
            
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="6">Sin datos</td></tr>';
    }

    echo '</table>';
    ?>
</div>


</div>