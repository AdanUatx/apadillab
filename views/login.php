
<div class="login-container">
    <h2>Iniciar Sesión</h2>
    <div id="mensaje-error" style="display: none;"></div>
    <form id="form-login">
        <div class="form-group">
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" required>
        </div>
        <div class="form-group">
            <label for="contraseña">Contraseña:</label>
            <input type="password" id="contraseña" name="contraseña" required>
        </div>
        <button type="button" onclick="enviarFormulario()">Iniciar Sesión</button>
    </form>
</div>

<script src="/apadillab/views/js/login.js"></script>


