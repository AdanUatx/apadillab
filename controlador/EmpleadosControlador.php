<?php

include_once "modelo/EmpleadoModelo.php";
include_once "modelo/DetEmpleadoModel.php";
include_once "modelo/ContactoEmpleadoModelo.php";
include_once "helper/ValidacionFormulario.php";
include_once "helper/GenerarClaveEmpleado.php";

class EmpleadosControlador
{

    private $empleadoModelo;
    private $detalleEmpleadoModelo;
    private $codigoRespuesta;

    function __construct()
    {
        $this->codigoRespuesta = 400;
        $this->empleadoModelo = new EmpleadoModelo();
        $this->detalleEmpleadoModelo = new DetEmpleadoModel();
    }



    public function listado(){
        $condicionActivo = array(
            'activo' => 1
        );
        $empleadoDatos = $this->empleadoModelo->obtenerListado($condicionActivo);
        $empleadoRespuesta = array();
        foreach ($empleadoDatos as $index => $empleado){
            $condicionesWhere = array(
                'id_empleado' => $empleado['id_empleado']
            );
            $detalleEmpleado = $this->detalleEmpleadoModelo->obtenerListado($condicionesWhere);
            $empleado['detalleEmpleado'] = $detalleEmpleado;
            $empleadoRespuesta[$index] = $empleado;
        }

        return array(
            'success' => true,
            'msg' => array('Se obtuvo el listado de empleados correctamente'),
            'data' => array(
                'empleados' => $empleadoRespuesta
            )
        );
    }


    
     public function agregar($datosFormulario){
        $respuesta = array(
            'success' => false,
            'msg' => array('No fue posible agregar el empleado'),
        );
        // Validaciones del formulario
         $validacion = ValidacionFormulario::validarFormEmpleadoNuevo($datosFormulario);
        //dd($datosFormulario);
        //recuperar el detalle del empleado y separarlo del formulario general
        $datosDetalleEmpleado['puesto'] = $datosFormulario['puesto'];
        $datosDetalleEmpleado['experiencia_profesional'] = $datosFormulario['puesto'];
        unset($datosFormulario['puesto'] , $datosFormulario['experiencia_profesional']);


        if($validacion['status']){
            $datosFormulario['clave_empleado'] = GenerarClaveEmpleado::generarClaveEmpleado($datosFormulario);
            $datosFormulario['fecha_ingreso'] = Date('Y-m-d');
            $datosFormulario['activo'] = true;
            $empleadoNuevo = $this->empleadoModelo->insertar($datosFormulario);
            if($empleadoNuevo){
                //recuperar el id del empleado registrado
                $idNuevoEmpleado = $this->empleadoModelo->ultimoID();
                var_dump($idNuevoEmpleado);
                $datosDetalleEmpleado['id_empleado'] = $idNuevoEmpleado;
                $guardoContacto = $this->detalleEmpleadoModelo->insertar($datosDetalleEmpleado);
                if($guardoContacto){
                    $respuesta = array(
                        'success' => true,
                        'msg' => array('Se registro el empleado correctamente'),
                        //devolver en el data, los datos del empleado agregado, incluido su id
                    );
                }else{
                    $respuesta = array(
                        'success' => false,
                        'msg' => array('Se registro el empleado correctamente pero faltaron los datos de contacto'),
                        //devolver en el data, los datos del empleado agregado, incluido su id
                    );
                }
            }
        }else{
            $respuesta['success'] = false;
            $respuesta['msg'] = $validacion['msg'];
        }
        return $respuesta;
    }

    public function actualizar($datosFormulario){
        $respuesta = array(
            'success' => false,
            'msg' => array('No fue posible actualizar el empleado'),
        );
        $datosContacto = $datosFormulario['listado_datos_contacto'];
        unset($datosFormulario['listado_datos_contacto']);
        $validacion = ValidacionFormulario::validarFormEmpleadoActualizar($datosFormulario);
        if($validacion['status']){
            $id_empleado = $datosFormulario['id_empleado'];
            unset($datosFormulario['id_empleado']);
            $empleadoActualizar = $this->empleadoModelo->actualizar($datosFormulario,array('id' => $id_empleado));
            if($empleadoActualizar){
                $guardoContacto = true;
                $this->contactoEmpleadoModelo->eliminar(array('empleado_id' => $id_empleado));
                foreach ($datosContacto as $dc){
                    $dc['empleado_id'] = $id_empleado;
                    $guardoContacto = $this->contactoEmpleadoModelo->insertar($dc);
                }
                if($guardoContacto){
                    $respuesta = array(
                        'success' => true,
                        'msg' => array('Se actualizo el empleado correctamente'),
                        //devolver en el data, los datos del empleado agregado, incluido su id
                    );
                }else{
                    $respuesta = array(
                        'success' => false,
                        'msg' => array('Se el empleado correctamente pero faltaron los datos de contacto'),
                        //devolver en el data, los datos del empleado agregado, incluido su id
                    );
                }
            }else{
                $respuesta['success'] = false;
                $respuesta['msg'] = $this->empleadoModelo->getErrores();
            }
        }else{
            $respuesta['success'] = false;
            $respuesta['msg'] = $validacion['msg'];
        }
        return $respuesta;
    }


    //Funcion de Eliminar los datos
    public function eliminar($datosFormulario){
        try{
            $validacion = ValidacionFormulario::validarFormEmpleadoEliminar($datosFormulario);
            if($validacion['status']){
                $empleadoEliminar = $this->empleadoModelo->eliminar(array('id_empleado' => $datosFormulario['id_empleado']));
            }if($empleadoEliminar){
                   $respuesta['success'] = true;
                   $respuesta['msg'] = array ('Se elimino correctamente');
                   $this->codigoRespuesta = 200;
            }else{
                    $respuesta['success'] = false;
                    $respuesta['msg'] = $this->empleadoModelo->getErrores();
                    $this->codigoRespuesta = 400;
            }
        }catch (Exception $ex){
            $respuesta['success'] = false;
            $respuesta['msg'] = $validacion['msg'];
            $this->codigoRespuesta = 500;
        }
           return $respuesta;
    }

    public function getCodigoRespuesta(){
        return $this->codigoRespuesta;
    }
}