<?php

class AuthModel extends ModeloBase
{

    public function __construct()
    {
        parent::__construct('ms_usuarios');
    }

    public function obtenerUsuario($condiciones = array())
    {
        $condionesSQL = $this->obtenerCondicionalesWhereAnd($condiciones);
        $consulta = "select * from ms_usuarios $condionesSQL";
        return $this->obtenerResultadosQuery($consulta);
    }
}