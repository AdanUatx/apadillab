<div class="container pt-5">
    <div class="row">
        <div class="col-8">
            <div class="d-flex justify-content-centerus">
                <h2>Lista de empleados</h2>
            </div>
        </div>
        <div class="col-4">
            <div class="d-flex justify-content-centerus">
                <a class="btn btn-sm btn-primary" href="<?php APP_URL;?>agregarEmpleado">Agregar Empleado</a>
            </div>
        </div>

    </div>
    <div class="container">
        <?php
        use app\controllers\EmpleadosController;

        $empleados = new EmpleadosController();

        echo $empleados->obtenerListaEmpleados();
        ?>
    </div>
</div>