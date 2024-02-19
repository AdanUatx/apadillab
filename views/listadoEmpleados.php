<!DOCTYPE html>
<html lang="es">
<?php
require_once 'inc/header.php';
?>
<body>

<?php
    include_once 'inc/nav-bar.php'
?>

<div class="container">
    <div class="row" id="contenedor_tablero_empleado">
        <!-- boton de agregar uno nuevo -->
        <div class="row">
            <fieldset>
                <legend>Tablero de resultados</legend>
            </fieldset>
            <div class="col-12" style="text-align: right">
                <button type="button" id="btn_agregar_empleado" class="btn btn-outline-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalAgregarEmpleado">Agregar empleado</button>
            </div>
        </div>
        <table id="tableroEmpleados" class="table table-striped">
            <thead>
            <tr>
                <th>Clave Empleado</th>
                <th>Nombre completo</th>
                <th>Cumpleaños</th>
                <th>Edad</th>
                <th>Operaciones</th>
            </tr>
            </thead>
            <tbody id="tbodyTableroEmpleados">

            </tbody>
        </table>
    </div>
</div>


<!-- Modal para agregar empleado -->
<div id="modalAgregarEmpleado" class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Empleado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Aquí va el formulario para agregar un nuevo empleado -->
                <form id="formAgregarEmpleado">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label><span class="text-danger">*</span>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellido_paterno" class="form-label">Apellido Paterno:</label><span class="text-danger">*</span>
                        <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellido_materno" class="form-label">Apellido Materno:</label><span class="text-danger">*</span>
                        <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" required>
                    </div>
                    <div class="mb-3">
                        <label for="edad" class="form-label">Edad:</label><span class="text-danger">*</span>
                        <input type="number" class="form-control" id="edad" name="edad" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label><span class="text-danger">*</span>
                        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                    </div>
                    <div class="mb-3">
                        <label for="genero" class="form-label">Género:</label><span class="text-danger">*</span>
                        <select class="form-select" id="genero" name="genero" required>
                            <option value="masculino">Masculino</option>
                            <option value="femenino">Femenino</option>
                            <option value="otro">Otro</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="sueldo_base" class="form-label">Sueldo Base:</label><span class="text-danger">*</span>
                        <input type="number" class="form-control" id="sueldo_base" name="sueldo_base" required>
                    </div>
                    <div class="mb-3">
                        <label for="puesto" class="form-label">Puesto:</label><span class="text-danger">*</span>
                        <input type="text" class="form-control" id="puesto" name="puesto" required>
                    </div>
                    <div class="mb-3">
                        <label for="experiencia_profesional" class="form-label">Experiencia Profesional:</label><span class="text-danger">*</span>
                        <textarea type="text" class="form-control" id="experiencia_profesional" name="experiencia_profesional" required></textarea>
                    </div>
                    <!-- Agrega aquí los demás campos del formulario -->
                    <button type="submit" onclick="Empleados.guardarEmpleado()" class="btn btn-primary">Agregar</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal de Detalles del Empleado -->
<div class="modal fade" id="modalDetallesEmpleado" tabindex="-1" aria-labelledby="modalDetallesEmpleadoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- El contenido del modal se agregará dinámicamente desde JavaScript -->


        </div>
    </div>
</div>






<script src="/apadillab/views/js/funciones.js"></script>
<?php
require_once 'inc/footer.php'
?>
</body>
</html>
