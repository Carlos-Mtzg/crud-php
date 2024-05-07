<?php

abstract class Conectar
{
    // Se declara una variable privada para la conexion
    private $con;

    // Este metodo es para conectarse a la base de datos
    public function conectar()
    {
        try {
            // Se crea una instancia de la clase PDO
            $this->con = new PDO(
                // Parametros de la conexion
                "mysql:host=localhost;dbname=ejemplo2",
                "root", // Nombre de usuario de la base de datos
                "root" // Contraseña de la base de datos
            );
        } catch (PDOException $e) {
            // En caso de error se muestra un mensaje
            die("error :" . $e);
        }
        return $this->con;
    }

    // Este mnetodo permitira...
    public function setNames()
    {
        // Con esto se evita problemas de acentos y caracteres especiales
        return $this->con->query("SET NAMES 'utf8'");
    }
}

class Datos extends Conectar
{
    // Se declara una variable privada para la conexion
    private $bd;
    public function __construct()
    {
        // Inicializamos la conexion
        $this->bd = self::conectar();
        // Se establece la codificacion de caracteres
        self::setNames();
    }
    public function getDatos($sql)
    {
        // Se prepara la consulta
        $datos = $this->bd->prepare($sql);
        // Se ejecuta la consulta
        $datos->execute();
        // Traera todos los registros de la consulta en un array
        return $datos->fetchAll();
        // Cerramos la conexion a la base de datos
        // $this->bd = null;
    }
    public function getDato($sql)
    {
        // Se prepara la consulta
        $datos = $this->bd->prepare($sql);
        // Se ejecuta la consulta
        $datos->execute();
        // Traera el primer registro de la consulta
        return $datos->fetch();
        // Cerramos la conexion a la base de datos
        // $this->bd = null;
    }
    public function setDato($sql)
    {
        // Se prepara la consulta
        $datos = $this->bd->prepare($sql);
        // Se ejecuta la consulta
        $datos->execute();
        // return $this->bd->lastInsertId();
    }
}
