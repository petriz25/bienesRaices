<?php
    require 'includes/app.php';
    incluirTemplate('header', $inicio= true);
?>
    <main class="contenedor seccion">
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
    </main>

    <section class="seccion contenedor">
        <h2>Casas y Depas en Venta</h2>

        <?php 
        $limite = 3;
        include 'includes/templates/anuncios.php';
        ?>

        <div class="alinear-derecha">
            <a href="anuncios.php" class="boton-verde">
                Ver todas
            </a>
        </div>
    </section>

    <section class="imagen-contacto">
        <h2>Encuentra la casa de tus sueños</h2>
        <p>Llena el formulario de contacto y un asesor se pondrá en contacto contigo a la brevedad</p>
        <a href="contacto.php" class="boton-amarillo">Contactános</a>
    </section>

    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h3>Nuestro blog</h3>

            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="image.webp">
                        <source srcset="build/img/blog1.jpg" type="image.jpeg">
                        <img loading="lazy" src="build/img/blog1.jpg" alt="Entrada a blog">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Terraza en el techo de tu casa</h4>
                        <p>Escrito el: <span>20/10/2021</span> por: <span>Admin</span></p>
                        <p>Consejos para construir una terraza en el techo de 
                            tu casa con los mejores materiales y ahorrar dinero
                         </p>
                    </a>
                </div>
            </article>

            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="image.webp">
                        <source srcset="build/img/blog2.jpg" type="image.jpeg">
                        <img loading="lazy" src="build/img/blog2.jpg" alt="Entrada a blog">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Guía para la decoracion de tu hogar</h4>
                        <p>Escrito el: <span>20/10/2021</span> por: <span>Admin</span></p>
                        <p>Maximiza el espacio de tu hogar con esta guia, aprende a combinar muebles
                            y colores para darle vida a tu espacio
                         </p>
                    </a>
                </div>
            </article>
        </section>

        <section class="testimoniales">
            <h3>Testimoniales</h3>
            <div class="testimonial">
                <blockquote>
                    El personal se comportó de una excelente forma, muy buena atención 
                    y la casa que me ofrecieron cumple con todas mis expectativas.
                </blockquote>
                <p>Jonathan Zazueta Petriz</p>
            </div>
        </section>
    </div>

    <?php
    //Cerrar conexión a la BD
    mysqli_close($db);
    
    incluirTemplate('footer');
    ?>