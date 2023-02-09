<?php
    require '../../includes/app.php';
    use App\Propiedad;
    use Intervention\Image\ImageManagerStatic as Image;


    //Verificar el inicio de sesión
    estaAutenticado();

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
?>

<?php
    $db = conectarDB();

    //Consultar para obtener los vendedores
    $consultaVendedores="SELECT * FROM vendedores";
    $resultadoVendedores=mysqli_query($db, $consultaVendedores);

    //Arreglo con mensaje de errores
    $errores= Propiedad::getErrores();

    $titulo = '';
    $precio ='';
    $descripcion ='';
    $habitaciones ='';
    $wc ='';
    $estacionamiento ='';
    $vendedorId ='';

    if($_SERVER['REQUEST_METHOD']=== 'POST'){

    $propiedad = new Propiedad($_POST);

    //CREANDO NOMBRE UNICO PARA CADA IMAGEN
    $nombreImagen= md5(uniqid( rand(), true) ) . ".jpg";

    //Realia un resize a la imagen usando intervention
    if($_FILES['imagen']['tmp_name']){
        $image=Image::make($_FILES['imagen']['tmp_name'])->fit(800,600);
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
        $resultado = $propiedad->guardar();
        
        //Mensaje de exito, reedirecciona a la pestaña de crear
        if($resultado){
            header('Location: /admin/propiedades/crear.php');
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
            

            <input type="submit" value="Crear Propiedad" class="boton-amarillo">
        </form>
    </main>
    
    <?php
    incluirTemplate('footer');
    ?>