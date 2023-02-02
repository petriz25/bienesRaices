<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php

    //Importar la conexión
    require '../includes/config/database.php';
    $db = conectarDB();

    //Escribir el query
    $query = "SELECT * FROM propiedad";

    //Conectar a la BD
    $consulta = mysqli_query($db, $query);

    //incluye el header
    require '../includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Propiedades </h1>

        <a href="/admin/propiedades/crear.php" class="boton boton-verde">
            Volver al creador
        </a>
    </main>

    <table class="empleados">
        <thead>
            <tr>
                <th>Titulo</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th>Descripción</th>
                <th>Habitaciones</th>
                <th>Baños</th>
                <th>Estacionamiento</th>
                <th>Vendedor</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody> <!-- Mostrar los resultados  -->

        <?php while($row = mysqli_fetch_assoc($consulta)):  ?>
            <tr>
                <td><?php echo $row['titulo'];  ?></td>
                <td><?php echo $row['precio'];  ?> </td>
                <td><?php echo $row['imagen'];  ?></td>
                <td><?php echo $row['descripcion'];  ?></td>
                <td><?php echo $row['habitaciones'];  ?></td>
                <td><?php echo $row['wc'];  ?></td>
                <td><?php echo $row['estacionamiento'];  ?></td>
                <td><?php echo $row['vendedorId'];  ?></td>
                <td>
                    <a href="#" class="boton-azul-block boton-chico">Actualizar</a>
                    <a href="#" class="boton-rojo-block boton-chico">Eliminar</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    
    <?php
    //Cerrar la conexión a la BD

    incluirTemplate('footer');
    ?>