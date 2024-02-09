<?php
    namespace app\models;

    class VistasModel{
        protected function obtenerVistasModelo($vista){
            $listaBlanca = ["inicio","logOut","listEmpleados","agregarEmpleado"];

            if(in_array($vista,$listaBlanca)){
                if (is_file("./app/views/".$vista.".view.php")){
                    $contenidoMostrar ="./app/views/".$vista.".view.php";
                }else{
                    $contenidoMostrar ="404";
                }
            }elseif($vista=='login' || $vista=='index'){
                $contenidoMostrar="login";
            }else{
                $contenidoMostrar="404";
            }
            return $contenidoMostrar;
        }
    }
