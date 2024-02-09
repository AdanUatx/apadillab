<?php

    spl_autoload_register(function ($clase) {
        $archivo=__DIR__."/".$clase.".php";
        $archiv=str_replace("\\","/", $archivo);

        if (is_file($archivo)){
            require_once $archivo;
        }
    });