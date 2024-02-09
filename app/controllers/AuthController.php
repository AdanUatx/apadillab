<?php
    namespace app\controllers;
    use app\models\mainModel;

class AuthController extends mainModel
{
    public function iniciarSesionControlador()
    {
        $usuario = $_POST['username'];
        $clave = $_POST['password'];

        if($usuario == " " || $clave == " "){
            echo "
                <script>
                    alert('No han llenado todos los campos')
                </script>
            ";
        }else{
            $existeUsuario = $this->ejecutarConsulta("SELECT * FROM ms_usuarios WHERE nombre_usuario='$usuario'");
            if ($existeUsuario->rowCount()===1){
                $existeUsuario = $existeUsuario->fetch();

                $_SESSION['id'] = $existeUsuario['id_usuario'];
                $_SESSION['nombre'] = $existeUsuario['nombre_usuario'];
                $_SESSION['apellido'] = $existeUsuario['apellido_usuario'];
                $_SESSION['rol'] = $existeUsuario['rol'];
                if (headers_sent()){
                    echo "<script>
                    window.location.href='".APP_URL."inicio';
                    </script> ";
                }else{
                    header("Location: ".APP_URL."inicio");
                }
            }else{
               echo " <script>
                alert('Usuario o clave incorrectos')
                </script> ";
            }
        }

    }

    public function cerrarSesionControlador()
    {
        session_destroy();
        if (headers_sent()){
            echo "<script>
                    window.location.href='".APP_URL."login/';
                    </script> ";
        }else{
            header("Location: ".APP_URL."login/");
        }
    }
}

