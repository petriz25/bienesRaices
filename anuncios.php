<?php
    require 'includes/app.php';
    incluirTemplate('header');
?>
    <main class="contenedor seccion">
    <?php 
        $limite = 12;
        include 'includes/templates/anuncios.php';
        ?>
    </main>
    
    <?php
    incluirTemplate('footer');
    ?>