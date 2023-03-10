<?php
    require 'includes/app.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Conoce sobre Nosotros </h1>

        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre nosotros">
                </picture>
            </div>

            <div class="texto-nosotros">
                <blockquote>
                    25 Años de experiencia
                </blockquote>

                <p>
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nam, veritatis animi. Libero nam illo officiis consectetur fuga assumenda praesentium accusantium nihil cum temporibus, quas eius expedita enim laboriosam tenetur vero!

                </p>

                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Expedita iste explicabo eligendi velit modi. Rerum dolorem provident tenetur velit dolores optio explicabo obcaecati nam laborum enim ducimus, et deserunt laboriosam.</p>
            </div>
        </div>
    </main>

    <section class="contenedor seccion">
        <h1>Mas sobre nosotros </h1>
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Placeat alias aperiam velit facilis quis ea sunt ipsam, nihil consequuntur libero, est optio minus praesentium enim accusamus, reiciendis a dignissimos sequi.
                </p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono precio" loading="lazy">
                <h3>Precio</h3>
                <p>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Placeat alias aperiam velit facilis quis ea sunt ipsam, nihil consequuntur libero, est optio minus praesentium enim accusamus, reiciendis a dignissimos sequi.
                </p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono tiempo" loading="lazy">
                <h3>Tiempo</h3>
                <p>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Placeat alias aperiam velit facilis quis ea sunt ipsam, nihil consequuntur libero, est optio minus praesentium enim accusamus, reiciendis a dignissimos sequi.
                </p>
            </div>
        </div>
    </section>
    
    <?php
    incluirTemplate('footer');
    ?>