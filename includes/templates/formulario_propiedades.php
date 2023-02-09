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