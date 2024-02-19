<?php

include_once "modelo/AuthModel.php";
include_once "helper/ValidacionFormulario.php";
class AuthControlador
{
    private $AuthModel;

    function __construct()
    {
        $this->AuthModel = new AuthModel();
    }

    public function autenticar($datos_login){
        // Validar los datos recibidos del formulario de inicio de sesión
        $usuario = isset($datos_login['usuario']) ? $datos_login['usuario'] : null;
        $password = isset($datos_login['password']) ? $datos_login['password'] : null;

        if (!$usuario || !$password) {
            return array(
                'success' => false,
                'msg' => 'Por favor ingresa un usuario y contraseña'
            );
        }

        $condicionales = array(
            'nombre_usuario' => $usuario,
            'password' => $password
        );
        $usuarios = $this->AuthModel->obtenerUsuario($condicionales);
        if (count($usuarios) > 0) {

            $datosUsuario = array(
                'id' => $usuarios[0]['id_usuario'],
                'nombre' => $usuarios[0]['nombre_usuario'],
                'apellido' => $usuarios[0]['apellido_usuario'],
                'rol' => $usuarios[0]['rol']
            );


            return array(
                'success' => true,
                'msg' => 'Inicio de sesión exitoso',
                'user' => json_encode($datosUsuario)
            );


        } else {
            return array(
                'success' => false,
                'msg' => 'Credenciales inválidas. Por favor verifica tu usuario y contraseña'
            );
        }
    }


}