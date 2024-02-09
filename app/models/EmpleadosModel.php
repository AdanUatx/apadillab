<?php
// Empleado.php

namespace app\models;


use PDOException;

class EmpleadosModel extends mainModel
{
    private $nombre;
    private $apellido_paterno;
    private $apellido_materno;
    private $edad;
    private $fechaNacimiento;
    private $genero;
    private $sueldoBase;
    private $puesto;
    private $experienciaProfesional;
    private $claveEmpleado;

    public function __construct($nombre, $apellidoPaterno, $apellidoMaterno , $edad, $fechaNacimiento, $genero, $sueldoBase, $puesto, $experienciaProfesional)
    {
        $this->nombre = $nombre;
        $this->apellidoPaterno = $apellidoPaterno;
        $this->apellidoMaterno = $apellidoMaterno;
        $this->edad = $edad;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->genero = $genero;
        $this->sueldoBase = $sueldoBase;
        $this->puesto = $puesto;
        $this->experienciaProfesional = $experienciaProfesional;
        $this->claveEmpleado = $this->generarClaveEmpleado();
    }

    private function generarClaveEmpleado()
    {
        // Lógica para generar la clave del empleado
        // Por ejemplo:
        $fechaIngreso = date("Ymd"); // Fecha de ingreso en formato Ymd
        $inicialNombre = substr($this->nombre, 0, 1); // Inicial del nombre
        $inicialApellidoPaterno = strtoupper($this->apellidoPaterno); // Apellido paterno
        $inicialApellidoMaterno = substr($this->apellidoMaterno, 0, 1); // Inicial del apellido materno
        $clave = $fechaIngreso . $inicialNombre . $inicialApellidoPaterno . $inicialApellidoMaterno;
        return $clave;
    }
    public function guardar()
    {
        $mainModel = new mainModel();
        $conexion = $mainModel->conectar();
        try {
            $conexion->beginTransaction();

            $sqlEmpleado = "INSERT INTO ms_empleados (clave_empleado, nombre, edad, fecha_nacimiento, genero, sueldo_base, apellido_paterno, apellido_materno) 
            VALUES (:clave_empleado, :nombre, :edad, :fecha_nacimiento, :genero, :sueldo_base, :apellido_paterno, :apellido_materno)";
            $stmtEmpleado = $conexion->prepare($sqlEmpleado);
            $stmtEmpleado->bindParam(':clave_empleado', $this->claveEmpleado);
            $stmtEmpleado->bindParam(':nombre', $this->nombre);
            $stmtEmpleado->bindParam(':apellido_paterno', $this->apellidoPaterno);
            $stmtEmpleado->bindParam(':apellido_materno', $this->apellidoMaterno);
            $stmtEmpleado->bindParam(':edad', $this->edad);
            $stmtEmpleado->bindParam(':fecha_nacimiento', $this->fechaNacimiento);
            $stmtEmpleado->bindParam(':genero', $this->genero);
            $stmtEmpleado->bindParam(':sueldo_base', $this->sueldoBase);
            $stmtEmpleado->execute();

            $idEmpleado = $conexion->lastInsertId();

            // Insertar datos en la tabla det_empleado
            $sqlDetEmpleado = "INSERT INTO det_empleados (id_empleado, puesto, experiencia_profesional) 
                           VALUES (:id_empleado, :puesto, :experiencia_profesional)";
            $stmtDetEmpleado = $conexion->prepare($sqlDetEmpleado);
            $stmtDetEmpleado->bindParam(':id_empleado', $idEmpleado);
            $stmtDetEmpleado->bindParam(':puesto', $this->puesto);
            $stmtDetEmpleado->bindParam(':experiencia_profesional', $this->experienciaProfesional);
            $stmtDetEmpleado->execute();

            // Confirmar transacción
            $conexion->commit();

            // Devolver verdadero si la inserción fue exitosa
            return true;
        } catch (PDOException $e) {
            $conexion->rollBack();

            // Manejar errores de base de datos
            echo "Error al guardar el empleado: " . $e->getMessage();
            return false;
        }
    }

}
?>
