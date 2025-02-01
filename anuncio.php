<?php 
    require 'includes/funciones.php';
    $inicio = true;
    incluirTemplate('header');
?>
    <main class="contenedor seccion contenido-centrado">
        <h1>Casa en Venta frente al bosque</h1>

        <picture>
            <source srcset="build/img/destacada.webp" type="image/webp">
            <source srcset="build/img/destacada.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada.jpg" alt="Imagen de la propiedad">
        </picture>

        <div class="resumen-propiedad">
            <p class="precio">$300.000.000</p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="wc">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="estacionamiento">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="habitaciones">
                    <p>4</p>
                </li>
            </ul>

            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Provident reiciendis, impedit rerum quam velit deserunt, dignissimos optio, nesciunt explicabo itaque ea officia! Maiores sequi facere expedita animi quis libero harum?</p>

            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate eveniet illum, iste totam non ratione quibusdam consequuntur libero facere fuga iure magnam quod necessitatibus quo! Nostrum excepturi cupiditate quos sequi?</p>
        </div>
    </main>

    <?php incluirTemplate('footer'); ?>