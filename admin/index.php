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

    if($_SERVER['REQUEST_METHOD']=== 'POST'){
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        
        if($id){
            //Elimina la imagen
            $query = "SELECT imagen FROM propiedad WHERE id=${id}";
            $resultado = mysqli_query($db, $query);
            $propiedad = mysqli_fetch_assoc($resultado);

            unlink('../imagenes/' . $propiedad['imagen']);

            //Elimina la propiedad
            $query= "DELETE FROM propiedad WHERE id=${id}";
            $eliminar = mysqli_query($db, $query);

            if($eliminar){
                echo "<script> alert('Guardado exitosamente');
                location.href = 'crear.php';
                </script>";
            }else{
                echo "<script> alert('Error al guardar');
                location.href = 'crear.php';
                </script>";
            }
        }
    }

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
                <th>Id</th>
                <th>Titulo</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody> <!-- Mostrar los resultados  -->

        <?php while($row = mysqli_fetch_assoc($consulta)):  ?>
            <tr>
                <td><?php echo $row['id'];  ?></td>
                <td><?php echo $row['titulo'];  ?></td>
                <td><?php echo $row['precio'];  ?> </td>
                <td> <img src="../imagenes/<?php echo $row['imagen'];  ?>" class="imagen-tabla"></td>
                <td>
                <a href="propiedades/actualizar.php?id=<?php echo $row['id']; ?>" class="boton-azul-block boton-chico">Actualizar</a>
                    <form method="POST" class="w-100">
                        <input type="hidden" name="id" value=<?php echo $row['id'];?> >
                    <input type="submit" class="boton-rojo-block boton-chico" value="Eliminar">
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    
    <?php

    //Cerrar conexión a la BD
    mysqli_close($db);

    incluirTemplate('footer');
    ?>