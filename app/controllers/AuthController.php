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
            var_dump($existeUsuario);
            if (!empty($existeUsuario) && is_array($existeUsuario[0])) {
                $usuario = $existeUsuario[0];
            
                $_SESSION['id'] = $usuario['id_usuario'];
                $_SESSION['nombre'] = $usuario['nombre_usuario'];
                $_SESSION['apellido'] = $usuario['apellido_usuario'];
                $_SESSION['rol'] = $usuario['rol'];
            
                if (headers_sent()) {
                    echo "<script>window.location.href='" . APP_URL . "inicio';</script>";
                } else {
                    header("Location: " . APP_URL . "inicio");
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

