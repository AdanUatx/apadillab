<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2>Formulario de Empleado</h2>
            <form class="FormularioAjax" action="<?php echo APP_URL; ?>app/ajax/empleadoAjax.php" method="POST">
                <input type="hidden" name="modulo_empleado" value="registrar">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="mb-3">
                    <label for="apellido_paterno" class="form-label">Apellido Paterno:</label>
                    <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" required>
                </div>
                <div class="mb-3">
                    <label for="apellido_materno" class="form-label">Apellido Materno:</label>
                    <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" required>
                </div>
                <div class="mb-3">
                    <label for="edad" class="form-label">Edad:</label>
                    <input type="number" class="form-control" id="edad" name="edad" required>
                </div>
                <div class="mb-3">
                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                </div>
                <div class="mb-3">
                    <label for="genero" class="form-label">Género:</label>
                    <select class="form-select" id="genero" name="genero" required>
                        <option value="masculino">Masculino</option>
                        <option value="femenino">Femenino</option>
                        <option value="otro">Otro</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="sueldo_base" class="form-label">Sueldo Base:</label>
                    <input type="number" class="form-control" id="sueldo_base" name="sueldo_base" required>
                </div>
                <div class="mb-3">
                    <label for="puesto" class="form-label">Puesto:</label>
                    <input type="text" class="form-control" id="puesto" name="puesto" required>
                </div>
                <div class="mb-3">
                    <label for="experiencia_profesional" class="form-label">Experiencia Profesional:</label>
                    <input type="text" class="form-control" id="experiencia_profesional" name="experiencia_profesional" required>
                </div>
                <button type="submit" class="btn btn-primary" id="boton-guardar">Enviar</button>
            </form>
        </div>
    </div>
</div>


