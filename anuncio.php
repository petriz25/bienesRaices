<?php
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Casa en Venta Frente al Bosque </h1>

        <picture>
            <source srcset="build/img/destacada.webp" type="image/webp">
            <source srcset="build/img/destacada.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada.jpg" alt="imagen de la propiedad">
        </picture>

        <div class="resumen-propiedad">
            <p class="precio">$3,000,000</p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono icono_estacionamiento">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorios">
                    <p>4</p>
                </li>
            </ul>

            <p>
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maxime quasi sit error tempore architecto nobis sunt iure consectetur dignissimos, autem inventore explicabo illum temporibus culpa praesentium consequuntur aspernatur similique corporis!
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ratione soluta rem qui, voluptates necessitatibus exercitationem. Qui, numquam harum accusantium sunt asperiores, doloribus deserunt laboriosam blanditiis adipisci incidunt amet, explicabo ipsum?
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam, consequatur dolorum asperiores eligendi accusamus non sapiente delectus mollitia voluptatibus laudantium nihil recusandae laborum hic, ex soluta maxime dignissimos assumenda minus.
            </p>
        </div>
    </main>
    
    <?php
    incluirTemplate('footer');
    ?>