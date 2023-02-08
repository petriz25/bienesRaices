<?php
    //Importar la conexión
    require 'includes/app.php';
    $db = conectarDB();

    //Escribir el query
    $query = "SELECT * FROM usuarios";

    //Conectar a la BD
    $consulta = mysqli_query($db, $query);

    //Autenticar usuario

    $errores=[];

    if($_SERVER['REQUEST_METHOD']=== 'POST'){

        $email=mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
        $password=mysqli_real_escape_string($db, $_POST['password']);

        if(!$email){
            $errores[]='Ingrese su E-mail';
        }
        if(!$password){
            $errores[]='Ingrese su Contraseña';
        }
        if(empty($errores)){
            //Revisar si el usuario existe
            $query="SELECT * FROM usuarios WHERE email='${email}'";
            $resultado=mysqli_query($db, $query);

            if($resultado->num_rows){
                //Revisar si el password es correcto
                $usuario = mysqli_fetch_assoc($resultado);

                $autenticarPassword = password_verify($password, $usuario['password']);

                if($autenticarPassword){
                    //El usuario esta autenticado
                    session_start();
                    $_SESSION['usuario']= $usuario['email'];
                    $_SESSION['login']= true;

                    header('Location: /admin/index.php');
                }else{
                    $errores[]='Contraseña incorrecta';
                }

            }else{
                $errores[]='El usuario no existe';
            }
        }
        
    }

    //Incluye el header
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesión </h1>

        <?php foreach($errores as $error):  ?>
        <div class="alerta error">
        <?php echo $error;  ?>
        </div>
        <?php endforeach;  ?>

        <form method="POST" action="" class="formulario">
        <fieldset>
                <legend>Email y Password</legend>
                <label for="email">E-mail: </label>
                <input type="email" placeholder="Tu Email" name="email" id="email" require>

                <label for="password">Contraseña: </label>
                <input type="password" placeholder="Tu Contraseña" name="password" id="password" require>
            </fieldset>

            <input type="submit" value="Iniciar Sesión" class="boton boton-verde">

        </form>
    </main>
    
    <?php
    incluirTemplate('footer');
    ?>