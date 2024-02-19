
<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"> <img src="https://softura.com.mx/SofturaSolutions/images/soft-grande.png" width="150" alt="Logo Softura"> </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" id="btn_iniciar_sesion" aria-current="page" href="/apadillab/views/login">Iniciar Sesión</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Lista de empleados</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="nav-item" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span id="rol-usuario"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" id="cerrar-sesion" href="/apadillab/views/logOut">Cerrar Sesion</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>

<script>
    // Obtener los datos del usuario almacenados en sessionStorage
    var datosUsuario = sessionStorage.getItem('usuario');
    if (datosUsuario) {
        var usuario = JSON.parse(datosUsuario);
        document.getElementById('rol-usuario').textContent = usuario?.rol;
        document.getElementById('btn_iniciar_sesion').style.display = 'none';

    } else {
        console.log('No hay datos de usuario almacenados en sessionStorage');
        document.getElementById('nav-item').style.display = 'none';
    }

    var enlaceCerrarSesion = document.getElementById('cerrar-sesion');
    // Agregar un evento de clic al enlace
    enlaceCerrarSesion.addEventListener('click', function() {
        // Eliminar todos los datos de sessionStorage
        sessionStorage.clear();
    });
</script>