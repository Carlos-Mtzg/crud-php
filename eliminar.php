<?php

// Mandamos a llamar el archivo conectar.php
require_once('conectar.php');

// Cremos una instancia de la clase Datos
$d = new Datos();

// Validamos si se recibe el id por el metodo GET
if (!isset($_GET['id'])) {
    die('Error: ID del producto no especificado.');
}

// Creamos una variable consulta para eliminar un registro
$consulta = "delete from productos where id='" . $_GET['id'] . "';";
// Ejectuamos la consulta
$d->setDato($consulta);

// Redireccionamos a la pantalla de productos
header("Location:productos.php");
