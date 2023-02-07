<?php
    require '../../includes/funciones.php';
    //Verificar el inicio de sesión
    $aut=estaAutenticado();
    if(!$aut){
        header('Location: /index.php');
    }

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
?>

<?php
    //Conectar la base de daatos
    require '../../includes/config/database.php';
    $db = conectarDB();

    //Consultar para obtener los vendedores
    $consultaVendedores="SELECT * FROM vendedores";
    $resultadoVendedores=mysqli_query($db, $consultaVendedores);

    //Arreglo con mensaje de errores
    $errores=[];

    $titulo = '';
    $precio ='';
    $descripcion ='';
    $habitaciones ='';
    $wc ='';
    $estacionamiento ='';
    $vendedorId ='';

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
    if(!$imagen['name']){
        $errores[]= "Debes agregar una imagen";
    }

    //Revisar que el arreglo de errores este vacio
    if(empty($errores)){
        //SUBIDA DE ARCHIVOS

        //CREAR UNA CARPETA PARA IMAGENES
        $carpetaImagenes='../../imagenes/';

        //CREANDO NOMBRE UNICO PARA CADA IMAGEN
        $nombreImagen= md5(uniqid( rand(), true) ) . ".jpg";

        //SUBIR LA IMAGEN
        move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen );

        if(!is_dir($carpetaImagenes)){
            mkdir($carpetaImagenes);
        }

            //Insertar en la base de datos
    $insertar = "INSERT INTO propiedad(titulo, precio, imagen, descripcion,habitaciones, wc, estacionamiento, vendedorId)
                VALUES('$titulo','$precio', '$nombreImagen','$descripcion',  '$habitaciones','$wc', '$estacionamiento', '$vendedorId')";

    //echo $insertar;

    try{
        $resultado=mysqli_query($db, $insertar);

        if($resultado){
            echo "<script> alert('Guardado exitosamente');
            location.href = 'crear.php';
            </script>";
        }
    }catch(\Throwable $th){
        echo "<script> alert('Error al guardar');
            location.href = 'crear.php';
            </script>";
    }
}
    }

    //Incluir el header
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Crear </h1>

        <a href="/admin/index.php" class="boton boton-verde">
            Volver al administrador
        </a>

        <?php foreach($errores as $error):  ?>
        <div class="alerta error">
        <?php echo $error;  ?>
        </div>
        <?php endforeach;  ?>

        <form method="POST" action="/admin/propiedades/crear.php" class="formulario" enctype="multipart/form-data">
            <fieldset>
                <legend>Información general</legend>

                <label for="titulo">Titulo: </label>
                <input name="titulo" type="text" id="titulo" placeholder="Titulo propiedad" value="<?php echo $titulo; ?>">

                <label for="precio">Precio: </label>
                <input name="precio" type="number" id="precio" placeholder="Precio propiedad" value="<?php echo $precio; ?>">

                <label for="imagen">Imagen: </label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" name="" id="descripcion" value="<?php echo $descripcion; ?>"></textarea>
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

            <input type="submit" value="Crear Propiedad" class="boton-amarillo">
        </form>
    </main>
    
    <?php
    incluirTemplate('footer');
    ?>