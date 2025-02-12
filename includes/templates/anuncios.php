<?php
    // Conectamos a la BD
        $db = conectarDB();

    // Consultar
        $query = "SELECT * FROM propiedades LIMIT $limite";

    // Obtener Resultados
        $resultado = mysqli_query($db, $query);

?>

<div class="contenedor-anuncios">
    <!-- Iterar -->
    <?php while($propiedad = mysqli_fetch_assoc($resultado)): ?>
    <div class="anuncio"> <!-- Inicio Anuncio -->

        <img loading="lazy" src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="anuncio">

        <div class="contenido-anuncio">
            <h3><?php echo $propiedad['titulo']; ?></h3>
            <p><?php echo $propiedad['descripcion']; ?></p>
            <p class="precio">$<?php echo number_format($propiedad['precio']); ?></p>

            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="wc">
                    <p><?php echo $propiedad['wc']; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="estacionamiento">
                    <p><?php echo $propiedad['estacionamiento']; ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="habitaciones">
                    <p><?php echo $propiedad['habitaciones']; ?></p>
                </li>
            </ul>
            <a href="anuncio.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">
                Ver Propiedad
            </a>
        </div><!-- Contenido Anuncio -->
    </div><!-- Anuncio -->
    <?php endwhile; ?>
</div><!-- Contenedor Anuncios -->

<?php 

    // Cerrar Conexión
    mysqli_close($db);

?>