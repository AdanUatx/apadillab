
<div class="container-sm">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2>Iniciar Sesión</h2>
                    <div id="mensaje-error" style="display: none;"></div>
                    <form id="form-login">
                        <div class="form-group">
                            <label for="usuario">Usuario:</label>
                            <input class="form-control" type="text" id="usuario" name="usuario" required>
                        </div>
                        <div class="form-group">
                            <label for="contraseña">Contraseña:</label>
                            <input class="form-control" type="password" id="contraseña" name="contraseña" required>
                        </div>
                        <br>
                        <button type="button" class="btn btn-primary" onclick="enviarFormulario()">Iniciar Sesión</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/apadillab/views/js/login.js"></script>


