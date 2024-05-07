<?php

// Mandamos a llamar el archivo conectar.php
require_once('conectar.php');

// Cremos una instancia de la clase Datos
$d = new Datos();

// Validamos si se recibe el id por el metodo GET
if (!isset($_GET['id'])) {
    die('Error: ID del producto no especificado.');
}


// Creamos una variable para almacenar la consulta
$getSQL = "SELECT * FROM productos WHERE id = '" . $_GET['id'] . "';";
// Creamos una variable para almacenar el dato
$producto = $d->getDato($getSQL);


// Validamos si se envio el formulario
if (isset($_POST['nombre'])) {
    $mensaje = "";
    // Validamos si los campos estan vacios
    if (empty($_POST['nombre'])) {
        $mensaje .= "El campo nombre está vacío.";
    }
    if (empty($_POST['precio'])) {
        $mensaje .= "El campo precio está vacío.";
    }

    // Validamos si hay un mensaje de error
    if (!empty($mensaje)) {
        header("Location:editar.php?error=1&id=" . $_GET['id']);
        // header("Location:editar.php?error=1&mensaje=" . $mensaje);
    } else {
        // Creamos una variable con la consulta para insertar un registro
        $sql = "update productos set nombre='" . $_POST['nombre'] . "', precio='" . $_POST['precio'] . "', categorias_id='" . $_POST['categoria_id'] . "' where id='" . $_GET['id'] . "';";
        // Mandamos a llamar el metodo setDato de la clase Datos para insertar un registro
        $d->setDato($sql);
        header("Location:editar.php?error=1&id=" . $_GET['id'] . "&error=0");
    }
} else {
    // Realizamos la consulta a la base de datos
    $categorias = $d->getDatos("SELECT * FROM categorias");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>CRUD PHP</title>
</head>

<body>
    <div class="container">
        <div class="card border-primary mb-3">
            <div class="card-header bg-primary text-white">
                <h1>Editar</h1>
            </div>
            <div class="card-body text-primary">
                <form action="" method="post" name="form">
                    <div class="mb-3">
                        <label for="categoria_id">Categoria</label>
                        <select name="categoria_id" id="categoria_id" class="form-control">
                            <?php
                            // Agregamos una condicion para imprimir la categoria seleccionada en la base de datos
                            foreach ($categorias as $categoria) {
                            ?>
                                <option value="<?php echo $categoria['id']; ?>" <?php echo ($producto['categorias_id'] == $categoria['id']) ? 'selected' : ''; ?>>
                                    <?php echo $categoria['nombre']; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <!-- Agregamos el value mandando llamar el nombre de la base de datos -->
                        <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $producto['nombre']; ?>" />
                    </div>
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <!-- Agregamos el value mandando llamar el precio de la base de datos -->
                        <input type="text" class="form-control" name="precio" id="precio" value="<?php echo $producto['precio']; ?>" />
                    </div>
                    <hr />
                    <!-- Boton para enviar el formulario -->
                    <a href="javascript::void(0);" onclick="document.form.submit();" class="btn btn-primary">Enviar</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>