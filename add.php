<?php

// Mandamos a llamar el archivo conectar.php
require_once('conectar.php');

// Cremos una instancia de la clase Datos
$d = new Datos();

// Validamos si se envio el formulario
if (isset($_POST['nombre'])) {
    $mensaje = "";
    // Filter_var es una funcion que nos permite validar datos
    if (filter_var($_POST['nombre']) == false) {
        $mensaje .= "El campo nombre esta vacio";
    }
    if (filter_var($_POST['precio']) == false) {
        $mensaje .= "El campo precio esta vacio";
    }
    if (!empty($mensaje)) {
        // header("Location:add.php?error=1");
        header("Location:add.php?error=1&mensaje=" . $mensaje);
    } else {
        // Creamos una variable con la consulta para insertar un registro
        $sql = "insert into productos values (null, '" . $_POST['categoria_id'] . "', '" . $_POST['nombre'] . "', '" . $_POST['precio'] . "', now())";
        // Mandamos a llamar el metodo setDato de la clase Datos para insertar un registro
        $d->setDato($sql);
        header("Location:add.php?error=0");
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
                <h1>Agregar</h1>
            </div>
            <div class="card-body text-primary">
                <form action="" method="post" name="form">
                    <div class="mb-3">
                        <label for="categoria_id">Categoria</label>
                        <select name="categoria_id" id="categoria_id" class="form-control">
                            <?php
                            // Creamos un ciclo para recorrer los datos obtenidos de la base de datos en el select
                            foreach ($categorias as $categoria) {
                            ?>
                                <option value="<?php echo $categoria['id']; ?>"><?php
                                                                                echo $categoria['nombre']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" />
                    </div>
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="text" class="form-control" name="precio" id="precio" required="true" />
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