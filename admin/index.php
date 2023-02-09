<?php
    require '../includes/app.php';
    use App\Propiedad;

    //Metodo para obtener todas las propiedades
    $propiedades = Propiedad::all();

    //Verificar el inicio de sesión
    estaAutenticado();

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
?>

<?php

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

        <?php foreach($propiedades as $propiedad):  ?>
            <tr>
                <td><?php echo $propiedad->id;  ?></td>
                <td><?php echo $propiedad->titulo;  ?></td>
                <td><?php echo $propiedad->precio;  ?> </td>
                <td> <img src="../imagenes/<?php echo $propiedad->imagen;  ?>" class="imagen-tabla"></td>
                <td>
                <a href="propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>" class="boton-azul-block boton-chico">Actualizar</a>
                    <form method="POST" class="w-100">
                        <input type="hidden" name="id" value=<?php echo $propiedad->id;?> >
                    <input type="submit" class="boton-rojo-block boton-chico" value="Eliminar">
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <?php

    //Cerrar conexión a la BD
    mysqli_close($db);

    incluirTemplate('footer');
    ?>