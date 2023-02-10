<?php
    require '../../includes/app.php';
    use App\Propiedad;
    use App\Vendedor;
    use Intervention\Image\ImageManagerStatic as Image;


    //Verificar el inicio de sesión
    estaAutenticado();

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $propiedad=new Propiedad;

    //Consulta para obtener todos los vendedores
    $vendedores = Vendedor::all();

    //Arreglo con mensaje de errores
    $errores= Propiedad::getErrores();

    if($_SERVER['REQUEST_METHOD']=== 'POST'){

    $propiedad = new Propiedad($_POST['propiedad']);

    //CREANDO NOMBRE UNICO PARA CADA IMAGEN
    $nombreImagen= md5(uniqid( rand(), true) ) . ".jpg";

    //Realia un resize a la imagen usando intervention
    if($_FILES['propiedad']['tmp_name']['imagen']){
        $image=Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
        $propiedad->setImagen($nombreImagen);
    }

    $errores=$propiedad->validar();

    //Revisar que el arreglo de errores este vacio
    if(empty($errores)){
        //CREAR UNA CARPETA PARA IMAGENES
        if(!is_dir(CARPETA_IMAGENES)) { mkdir(CARPETA_IMAGENES);}

        //Guardar la imagen en el servidor
        $image->save(CARPETA_IMAGENES . $nombreImagen);

        //Guardar en la base de datos
        $propiedad->guardar();
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
            <?php include '../../includes/templates/formulario_propiedades.php'; ?>

            <input type="submit" value="Crear Propiedad" class="boton-amarillo">
        </form>
    </main>
    
    <?php
    incluirTemplate('footer');
    ?>