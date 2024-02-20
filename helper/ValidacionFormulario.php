<?php

class ValidacionFormulario
{

    public static function validarFormEmpleadoNuevo($datosFormulario){
        $validacion['status'] = true;
        $validacion['msg'] = array();
        if(!isset($datosFormulario['nombre']) || $datosFormulario['nombre'] == ''){
            $validacion['status'] = false;
            $validacion['msg'][] = 'El campo nombre es requerido';
        }if(!isset($datosFormulario['apellido_paterno']) || $datosFormulario['apellido_paterno'] == ''){
            $validacion['status'] = false;
            $validacion['msg'][] = 'El campo apellido paterno es requerido';
        }if(!isset($datosFormulario['apellido_materno']) || $datosFormulario['apellido_materno'] == ''){
            $validacion['status'] = false;
            $validacion['msg'][] = 'El campo apellido materno es requerido';
        }if(!isset($datosFormulario['genero']) || $datosFormulario['genero'] == ''){
            $validacion['status'] = false;
            $validacion['msg'][] = 'El campo genero es requerido';
        }if(!isset($datosFormulario['fecha_nacimiento']) || $datosFormulario['fecha_nacimiento'] == ''){
            $validacion['status'] = false;
            $validacion['msg'][] = 'El campo fecha de nacimiento es requerido';
        }if(!isset($datosFormulario['sueldo_base']) || $datosFormulario['sueldo_base'] == ''){
            $validacion['status'] = false;
            $validacion['msg'][] = 'El campo sueldo es requerido';
        }if(!isset($datosFormulario['puesto']) || $datosFormulario['puesto'] == ''){
            $validacion['status'] = false;
            $validacion['msg'][] = 'El campo puesto es requerido';
        }if(!isset($datosFormulario['experiencia_profesional']) || $datosFormulario['experiencia_profesional'] == '' ){
            $validacion['status'] = false;
            $validacion['msg'][] = 'El campo experiencia profesional es requerido';
        }

        return $validacion;
    }

    public static function validarFormEmpleadoActualizar($datosFormulario){
        $validacion = self::validarFormEmpleadoNuevo($datosFormulario);
        if(!isset($datosFormulario['id_empleado']) || $datosFormulario['id_empleado'] == ''){
            $validacion['status'] = false;
            $validacion['msg'][] = 'El campo identificador del empleado es requerido';
        }
        return $validacion;
    }

    public static function validarFormEmpleadoEliminar($datosFormulario){
        $validacion['status'] = true;
        $validacion['msg'] = array();
        if(!isset($datosFormulario['id_empleado']) || $datosFormulario['id_empleado'] == ''){
            $validacion['status'] = false;
            $validacion['msg'][] = 'El campo identificador del empleado es requerido';
        }
        return $validacion;
    }

}