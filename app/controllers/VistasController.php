<?php
    namespace app\controllers;

    use app\models\VistasModel;

    class VistasController extends VistasModel{

        public function obtenerVistasControlador($vista){
            if($vista!=""){
                $respuesta = $this->obtenerVistasModelo($vista);
            }else{
                $respuesta="login";
            }

            return $respuesta;
        }
    }