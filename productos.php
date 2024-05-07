<?php
require_once('conectar.php');

// Cremos una instancia de la clase Datos
$d = new Datos();
// Realizamos la consulta a la base de datos
$datos = $d->getDatos("select productos.id, productos.nombre, productos.precio,productos.fecha, productos.categorias_id, categorias.nombre as categoria FROM productos INNER JOIN categorias on categorias.id = productos.categorias_id ORDER BY productos.id DESC;");
// print_r($datos);
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
                <h1>PHP PDO</h1>
            </div>
            <div class="card-body text-primary">
                <p>
                    <a href="add.php" class="btn btn-success">Crear</a>
                </p>
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Categoria</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Creamos un ciclo para recorrer los datos obtenidos de la base de datos
                        foreach ($datos as $dato) {
                        ?>
                            <tr>
                                <!-- Mostramos los datos en sus respectivas columnas -->
                                <td><?php echo $dato['id']; ?></td>
                                <td><?php echo $dato['categoria']; ?></td>
                                <td><?php echo $dato['nombre']; ?></td>
                                <td><?php echo $dato['precio']; ?></td>
                                <td><?php echo $dato['fecha']; ?></td>
                                <td>
                                    <!-- Redireccionamos a la pantalla de editar mandando el ID -->
                                    <a href="editar.php?id=<?php echo $dato['id']; ?>">Editar</a>
                                    <!-- Redireccionamos a la pantalla de eliminar mandando el ID -->
                                    <a href="eliminar.php?id=<?php echo $dato['id']; ?>">Eliminar</a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>