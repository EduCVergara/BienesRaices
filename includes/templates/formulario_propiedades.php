<fieldset>
    <legend>Información General</legend>

    <label for="titulo">Título:</label>
    <input type="text" id="titulo" name="titulo" placeholder="Título de la propiedad" value="<?php echo s($propiedad->titulo);?>">

    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="precio" placeholder="Precio de la propiedad" value="<?php echo s($propiedad->precio);?>">

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

    <label for="descripcion">Descripción</label>
    <textarea id="descripcion" placeholder="Ejemplo: Casa roja con puertas y ventanas" name="descripcion"><?php echo s($propiedad->descripcion);?></textarea>
    </fieldset>

    <fieldset>
    <legend>Información de la Propiedad</legend>

    <label for="habitaciones">Habitaciones:</label>
    <input type="number" id="habitaciones" placeholder="Ejemplo: 2" min="1" max="9" name="habitaciones" value="<?php echo s($propiedad->habitaciones);?>">

    <label for="wc">Baños:</label>
    <input type="number" id="wc" placeholder="Ejemplo: 1" min="1" max="9" name="wc" value="<?php echo s($propiedad->wc);?>">

    <label for="estacionamiento">Estacionamientos:</label>
    <input type="text" id="estacionamiento" placeholder="Ejemplo: 2" min="1" max="9" name="estacionamiento" value="<?php echo s($propiedad->estacionamiento);?>">
</fieldset>

<fieldset>
    <legend>Vendedor</legend>
</fieldset>