<?php

class ConfigDB
{

    public static function getConfig(){
        switch ($_SERVER['SERVER_NAME']){
            /*case '000webhostapp.com':
                $dbConfig = array(
                    'hostname' => 'localhost',
                    'usuario' => 'root',
                    'password' => 'root',
                    'base_datos' => 'root',
                    'puerto'=>'3306',
                    'set_charset'=> 'utf-8'
                );
                break;*/
            default :
                $dbConfig = array(
                    'hostname' => 'localhost',
                    'usuario' => 'root',
                    'password' => '',
                    'base_datos' => 'empleados',
                    'puerto'=>'3306',
                    //'set_charset'=> 'uft-8'
                );
                break;
        }
        return $dbConfig;
    }

}