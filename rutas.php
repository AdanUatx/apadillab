<?php

include_once "controlador/EmpleadosControlador.php";
include_once "controlador/AuthControlador.php";
include_once "controlador/WebServiceController.php";

//obtener los datos de la url GET para los paramentros de la peticion
$parametros_get = $_GET;
$respuesta_backend = array(
    'success' => false,
    'msg' => array(
        'Error, no encontre la peticion solicitada'
    )
);

$parametros_post = $_POST;

//instancia a la clase
$rutas = new Rutas();

if(isset($parametros_get['peticion']) && $parametros_get['peticion'] != ''
    && isset($parametros_get['funcion']) && $parametros_get['funcion'] != ''){
    switch ($parametros_get['peticion']){
        //peticion de catalogos
        case 'empleado':
            $empControlador = new EmpleadosControlador();
            switch ($parametros_get['funcion']){
                case 'listado': //200
                    $respuesta_controlador = $empControlador->listado();
                    $rutas->peticion(200,$respuesta_controlador);
                    break;
                case 'agregar': //201
                    $respuesta_controlador = $empControlador->agregar($parametros_post);
                    $rutas->peticion($respuesta_controlador['success'] ? 201 : 400,$respuesta_controlador);
                    break;
                case 'actualizar':
                    $respuesta_controlador = $empControlador->actualizar($parametros_post);
                    $rutas->peticion($respuesta_controlador['success'] ? 200 : 400,$respuesta_controlador);
                    break;
                case 'eliminar':
                    $respuesta_controlador = $empControlador->eliminar($parametros_post);
                    $rutas-> peticion($empControlador->getCodigoRespuesta(),$respuesta_controlador);
                    //$rutas->peticion($respuesta_controlador['success'] ? 200 : 400,$respuesta_controlador);
                    break;
                default:
                    $rutas->peticion(404,$respuesta_backend);
                    break;
            }
            break;
        case 'login':
            $authControlador = new AuthControlador();
            switch ($parametros_get['funcion']) {
                case 'autenticar':
                    $respuesta_controlador = $authControlador->autenticar($parametros_post);
                    $rutas->peticion($respuesta_controlador['success'] ? 200 : 401, $respuesta_controlador);
                    break;
                default:
                    $rutas->peticion(404, $respuesta_backend);
                    break;
            }
            break;
        case 'tipoCambio':
            $webServiceController = new WebServiceController();
            switch ($parametros_get['funcion']) {
                case 'obtener':
                    $respuesta_controlador = $webServiceController->consumirWebService();
                    $rutas->peticion($respuesta_controlador['success'] ? 200 : 401, $respuesta_controlador);
                    break;
                default:
                    $rutas->peticion(404, $respuesta_backend);
                    break;
            }
            break;
        default:
            $rutas->peticion(404,$respuesta_backend);
            break;
    }
}else{
    //$rutas->peticion_no_encontrada($respuesta_backend);
    $rutas->peticion(404,$respuesta_backend);
}

class Rutas {

    public function peticion($codigoRespuesta,$respuesta){
        http_response_code($codigoRespuesta);
        echo json_encode($respuesta);
    }

}