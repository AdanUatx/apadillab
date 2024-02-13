<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"> <img src="https://softura.com.mx/SofturaSolutions/images/soft-grande.png" width="150" alt="Logo Softura"> </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?php APP_URL;?>inicio">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php APP_URL;?>listEmpleados">Lista de empleados</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $_SESSION['rol'] ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo APP_URL; ?>logOut">Cerrar Sesion</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>