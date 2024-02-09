<?php
    namespace app\models;

    use PDO;

    if(file_exists(__DIR__."/../../config/database.php")){
        require_once __DIR__."/../../config/database.php";
    }

    class mainModel{
        private $server = DB_SERVER;
        private $db = DB_NAME;
        private $user = DB_USER;
        private $pass = DB_PASS;

        protected function conectar(){
            $conexion = new PDO("mysql:host=".$this->server.";dbname=".$this->db, $this->user, $this->pass);
            $conexion->exec("SET CHARACTER SET utf8");
            return $conexion;
        }


        protected function ejecutarConsulta($consulta){
            $sql = $this->conectar()->prepare($consulta);
            $sql->execute();
            $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $resultados;
        }

        protected function guardarDatos($tabla, $datos){
            try {
                $conexion = $this->conectar();
                $campos = implode(", ", array_keys($datos));
                $valores = ":" . implode(", :", array_keys($datos));
                $sql = "INSERT INTO $tabla ($campos) VALUES ($valores)";
                $consulta = $conexion->prepare($sql);
                foreach ($datos as $campo => $valor) {
                    $consulta->bindValue(":$campo", $valor);
                }
                $consulta->execute();
                return true;
            } catch(PDOException $e) {
                echo "Error al guardar los datos: " . $e->getMessage();
                return false;
            }
        }

    }