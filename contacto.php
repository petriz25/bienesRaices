<?php
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Contacto </h1>

        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen contacto">
        </picture>

        <h2>Llene el formulario de contacto</h2>
        <form class="formulario" action="">
            <fieldset>
                <legend>Información personal</legend>
                <label for="nombre">Nombre: </label>
                <input type="text" placeholder="Tu nombre" name="" id="nombre">

                <label for="email">E-mail: </label>
                <input type="email" placeholder="Tu Email" name="" id="email">

                <label for="telefono">Telefono: </label>
                <input type="tel" placeholder="Tu Telefono" name="" id="telefono">

                <label for="mensaje">Mensaje: </label>
                <textarea name="" id="mensaje"></textarea>
            </fieldset>
            <fieldset>
                    <legend>Información sobre la propiedad</legend>
                    <label for="opciones">Vende o Compra </label>
                    <select name="" id="opciones">
                        <option value="" disabled selected>-- Seleccione --</option>
                        <option value="compra">Compra</option>
                        <option value="vende">Vende</option>
                    </select>

                    <label for="presupuesto">Presupuesto: </label>
                    <input type="number" placeholder="Tu Presupuesto" name="" id="presupuesto">
            </fieldset>

            <fieldset>
                <legend>Contacto</legend>
                <p>Como desea ser Contactado</p>
                
                <div class="forma-contacto">
                    <label for="contactar-telefono">Teléfono</label>
                    <input type="radio" value="telefono" name="contacto" id="contactar-telefono">

                    <label for="contactar-email">E-mail</label>
                    <input type="radio" value="email" name="contacto" id="contactar-email">
                </div>

                <p>Si eligio telefono, seleccione la fecha y hora para ser contactado:</p>

                <label for="fecha">Fecha: </label>
                <input type="date" name="" id="fecha">

                <label for="hora">Hora: </label>
                <input type="time" name="" id="hora" min="09:00" max="18:00">
            </fieldset>

            <input class="boton-verde" type="submit" name="" id="">
        </form>
    </main>
    
    <?php
    incluirTemplate('footer');
    ?>