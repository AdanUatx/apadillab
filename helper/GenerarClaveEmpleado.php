<?php

class GenerarClaveEmpleado
{
    public static function generarClaveEmpleado($datosFormulario){
        $fechaIngreso = date("Ymd"); // Fecha de ingreso en formato Ymd
        $inicialNombre = substr($datosFormulario['nombre'], 0, 1); // Inicial del nombre
        $inicialApellidoPaterno = strtoupper($datosFormulario['apellido_paterno']); // Apellido paterno
        $inicialApellidoMaterno = substr($datosFormulario['apellido_materno'], 0, 1); // Inicial del apellido materno
        $clave = $fechaIngreso . $inicialNombre . $inicialApellidoPaterno . $inicialApellidoMaterno;
        return $clave;
    }
}