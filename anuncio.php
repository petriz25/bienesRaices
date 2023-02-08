<?php

    $id=$_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /index.php');
    }

    //Conectar la base de daatos
    require 'includes/app.php';
    $db = conectarDB();

    //Consultar la base de datos
    $query = "SELECT * FROM propiedad WHERE id=${id}";

    //Obtener los resultados
    $resultado=mysqli_query($db, $query);
    if($resultado->num_rows === 0){
        header('Location: /index.php');
    }
    $propiedad = mysqli_fetch_assoc($resultado);
    
    
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1><?php echo $propiedad['titulo']; ?></h1>
        
        <img loading="lazy" src="imagenes/<?php echo $propiedad['imagen']; ?>" alt="imagen de la propiedad">

        <div class="resumen-propiedad">
            <p class="precio">$<?php echo $propiedad['precio']; ?>.00</p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p><?php echo $propiedad['wc']; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono icono_estacionamiento">
                    <p><?php echo $propiedad['estacionamiento']; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorios">
                    <p><?php echo $propiedad['habitaciones']; ?></p>
                </li>
            </ul>

            <p>
            <?php echo $propiedad['descripcion']; ?>
            </p>
        </div>
    </main>
    
    <?php
    //Cerrar conexión a la BD
    mysqli_close($db);

    incluirTemplate('footer');
    ?>