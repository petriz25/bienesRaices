<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php

    $id=$_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('Location: /admin/index.php');
    }

    //Conectar la base de daatos
    require '../../includes/config/database.php';
    $db = conectarDB();

    //Consultar por id
    $query = "SELECT * FROM propiedad WHERE id=${id}";
    $resultado = mysqli_query($db, $query);
    $propiedad = mysqli_fetch_assoc($resultado);
    // echo '<pre>';
    // var_dump($propiedad);
    // echo '<pre>';

    // exit;


    //Consultar para obtener los vendedores
    $consultaVendedores="SELECT * FROM vendedores";
    $resultadoVendedores=mysqli_query($db, $consultaVendedores);

    //Arreglo con mensaje de errores
    $errores=[];

    $titulo = $propiedad['titulo'];
    $precio =$propiedad['precio'];
    $descripcion =$propiedad['descripcion'];
    $habitaciones =$propiedad['habitaciones'];
    $wc =$propiedad['wc'];
    $estacionamiento =$propiedad['estacionamiento'];
    $vendedorId =$propiedad['vendedorId'];
    $imagenPropiedad = $propiedad['imagen'];

    if($_SERVER['REQUEST_METHOD']=== 'POST'){

        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";

        // echo "<pre>";
        // var_dump($_FILES);
        // echo "</pre>";

    $titulo = mysqli_real_escape_string($db, $_POST['titulo']) ;
    $precio = mysqli_real_escape_string($db, $_POST['precio']) ;
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']) ;
    $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']) ;
    $wc = mysqli_real_escape_string($db, $_POST['wc']) ;
    $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']) ;
    $vendedorId = mysqli_real_escape_string($db, $_POST['vendedorId']) ;

    //Asignar FILES a una variable 
        $imagen = $_FILES['imagen'] ;

    if(!$titulo){
        $errores[]="Debes de añadir el titulo";
    }
    if(!$precio){
        $errores[]="Debes de añadir el precio";
    }
    if(!$habitaciones){
        $errores[]="Debes de añadir el numero de habitaciones";
    }
    if(!$wc){
        $errores[]="Debes de añadir el numero de baños";
    }
    if(!$estacionamiento){
        $errores[]="Debes de añadir el numero de estacionamientos";
    }
    if(!$vendedorId){
        $errores[]="Debes seleccionar el vendedor";
    }

    //Revisar que el arreglo de errores este vacio
    if(empty($errores)){

        // CREAR UNA CARPETA PARA IMAGENES
        $carpetaImagenes='../../imagenes/';

        if(!is_dir($carpetaImagenes)){
            mkdir($carpetaImagenes);
        }
        //SUBIDA DE ARCHIVOS

        $nombreImagen = '';


        if($imagen['name']){
        //Eliminar imagen previa
        unlink($carpetaImagenes . $propiedad['imagen']);

        //CREANDO NOMBRE UNICO PARA CADA IMAGEN
        $nombreImagen= md5(uniqid( rand(), true) ) . ".jpg";

        //SUBIR LA IMAGEN
        move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen );
        }
        else{
            $nombreImagen = $propiedad['imagen'];
        }

            //Insertar en la base de datos
    $insertar = "UPDATE propiedad SET titulo = '${titulo}', precio = '${precio}', imagen= '${nombreImagen}', descripcion = '${descripcion}', habitaciones = ${habitaciones},
                 wc = ${wc}, estacionamiento = ${estacionamiento}, vendedorId = ${vendedorId} WHERE id=${id}";

    try{
        $resultado=mysqli_query($db, $insertar);

        if($resultado){
            echo "<script> alert('Actualizado exitosamente');
            location.href = '../index.php';
            </script>";
        }
    }catch(\Throwable $th){
        echo "<script> alert('Error al actualizar');
            location.href = '../index.php';
            </script>";
    }
}
    }

    require '../../includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Actualizar </h1>

        <a href="/admin/index.php" class="boton boton-verde">
            Volver al administrador
        </a>

        <?php foreach($errores as $error):  ?>
        <div class="alerta error">
        <?php echo $error;  ?>
        </div>
        <?php endforeach;  ?>

        <form method="POST" class="formulario" enctype="multipart/form-data">
            <fieldset>
                <legend>Información general</legend>

                <label for="titulo">Titulo: </label>
                <input name="titulo" type="text" id="titulo" placeholder="Titulo propiedad" value="<?php echo $titulo; ?>">

                <label for="precio">Precio: </label>
                <input name="precio" type="number" id="precio" placeholder="Precio propiedad" value="<?php echo $precio; ?>">

                <label for="imagen">Imagen: </label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                <img src="/imagenes/<?php echo $imagenPropiedad ?>" class="imagen-small">

                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" name="" id="descripcion"><?php echo $descripcion; ?></textarea>
            </fieldset>

            <fieldset>
                <legend>Información Propiedad</legend>

                <label for="habitaciones">Habitaciones: </label>
                <input name="habitaciones" type="number" id="habitaciones" placeholder="Ej: 3" min="1" max="9"  value="<?php echo $habitaciones; ?>">

                <label for="wc">Baños: </label>
                <input name="wc" type="number" id="wc" placeholder="Ej: 3" min="1" max="9"  value="<?php echo $wc; ?>">

                <label for="estacionamiento">Estacionamiento: </label>
                <input name="estacionamiento" type="number" id="estacionamiento" placeholder="Ej: 3" min="1" max="9"  value="<?php echo $estacionamiento; ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedorId" name="" id="" value="<?php echo $vendedorId; ?>">
                    <option value="">-- Seleccionar --</option>
                    <?php while($row = mysqli_fetch_assoc($resultadoVendedores)):  ?>
                        <option <?php echo $vendedorId === $row['id'] ? 'selected' : ''; ?>  value="<?php echo $row['id']; ?>"><?php echo $row['nombre'] ?></option>
                    <?php endwhile; ?>
                </select>
            </fieldset>

            <input type="submit" value="Actualizar Propiedad" class="boton-amarillo">
        </form>
    </main>
    
    <?php
    incluirTemplate('footer');
    ?>