<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Iniciar sesión</div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="username">Nombre de usuario:</label>
                            <input type="text" name="username" id="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña:</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    if(isset($_POST['username']) && isset($_POST['password'])){
        $insLogin->iniciarSesionControlador();
    }
?>

