<?php

use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;

    require '../../includes/app.php';
    //Verificar el inicio de sesión
    estaAutenticado();

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

    //Consultar por id
    $propiedad=Propiedad::find($id);

    //Consultar para obtener los vendedores
    $consultaVendedores="SELECT * FROM vendedores";
    $resultadoVendedores=mysqli_query($db, $consultaVendedores);

    //Arreglo con mensaje de errores
    $errores=Propiedad::getErrores();

    if($_SERVER['REQUEST_METHOD']=== 'POST'){

        //Asignar los atributos
        $args = $_POST['propiedad'];

        $propiedad->sincronizar($args);
        //Validación 
        $errores = $propiedad->validar();
        //Subida de archivos
        //CREANDO NOMBRE UNICO PARA CADA IMAGEN
        $nombreImagen= md5(uniqid( rand(), true) ) . ".jpg";

        //Realia un resize a la imagen usando intervention
        if($_FILES['propiedad']['tmp_name']['imagen']){
            $image=Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
            $propiedad->setImagen($nombreImagen);
        }

        //Revisar que el arreglo de errores este vacio
        if(empty($errores)){
            //Guardar imagen 
            $image->save(CARPETA_IMAGENES . $nombreImagen);
            //Insertar en la base de datos
            $propiedad->guardar();
        }
    }

    //Incluir el header
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
            <?php include '../../includes/templates/formulario_propiedades.php'; ?>

            <input type="submit" value="Actualizar Propiedad" class="boton-amarillo">
        </form>
    </main>
    
    <?php
    incluirTemplate('footer');
    ?>