<?php 
    require 'includes/funciones.php';
    $inicio = true;
    incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h2>Casas y Departamentos en Venta</h2>

        <div class="contenedor-anuncios">
            <div class="anuncio">
                <picture>
                    <source srcset="build/img/anuncio1.webp" type="image/webp">
                    <source srcset="build/img/anuncio1.jpeg" type="image/jpeg">
                    <img loading="lazy" src="build/img/anuncio1.jpg" alt="anuncio">
                </picture>
                <div class="contenido-anuncio">
                    <h3>Casa de Lujo en el Lago</h3>
                    <p>Casa en Lago con excelente vista, acabados de lujo a un excelente precio</p>
                    <p class="precio">$430.000.000</p>

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
                    <a href="anuncio.php" class="boton-amarillo-block">
                        Ver Propiedad
                    </a>
                </div><!-- Contenido Anuncio -->
            </div><!-- Anuncio -->

            <div class="anuncio">
                <picture>
                    <source srcset="build/img/anuncio2.webp" type="image/webp">
                    <source srcset="build/img/anuncio2.jpeg" type="image/jpeg">
                    <img loading="lazy" src="build/img/anuncio2.jpg" alt="anuncio">
                </picture>
                <div class="contenido-anuncio">
                    <h3>Casa con Terminaciones de Lujo</h3>
                    <p>Casa en con excelentes terminaciones, acabados de lujo a un excelente precio</p>
                    <p class="precio">$430.000.000</p>

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
                    <a href="anuncio.php" class="boton-amarillo-block">
                        Ver Propiedad
                    </a>
                </div><!-- Contenido Anuncio -->
            </div><!-- Anuncio -->

            <div class="anuncio">
                <picture>
                    <source srcset="build/img/anuncio3.webp" type="image/webp">
                    <source srcset="build/img/anuncio3.jpeg" type="image/jpeg">
                    <img loading="lazy" src="build/img/anuncio3.jpg" alt="anuncio">
                </picture>
                <div class="contenido-anuncio">
                    <h3>Casa con Alberca</h3>
                    <p>Casa en multiespacio con excelentes prestaciones, acabados de lujo a un excelente precio</p>
                    <p class="precio">$430.000.000</p>

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
                    <a href="anuncio.php" class="boton-amarillo-block">
                        Ver Propiedad
                    </a>
                </div><!-- Contenido Anuncio -->
            </div><!-- Anuncio -->

            <div class="anuncio">
                <picture>
                    <source srcset="build/img/anuncio4.webp" type="image/webp">
                    <source srcset="build/img/anuncio4.jpeg" type="image/jpeg">
                    <img loading="lazy" src="build/img/anuncio4.jpg" alt="anuncio">
                </picture>
                <div class="contenido-anuncio">
                    <h3>Casa dos pisos con muchas ventanas</h3>
                    <p>Hermosa casa en lugar rural con muchas ventanas, ventilación y entrada vehículo</p>
                    <p class="precio">$550.000.000</p>

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
                    <a href="anuncio.php" class="boton-amarillo-block">
                        Ver Propiedad
                    </a>
                </div><!-- Contenido Anuncio -->
            </div><!-- Anuncio -->

            <div class="anuncio">
                <picture>
                    <source srcset="build/img/anuncio5.webp" type="image/webp">
                    <source srcset="build/img/anuncio5.jpeg" type="image/jpeg">
                    <img loading="lazy" src="build/img/anuncio5.jpg" alt="anuncio">
                </picture>
                <div class="contenido-anuncio">
                    <h3>Casa 2 pisos con gran terreno, amplia</h3>
                    <p>Casa en condominio personalizado con excelente terreno y tamaño</p>
                    <p class="precio">$630.000.000</p>

                    <ul class="iconos-caracteristicas">
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="wc">
                            <p>4</p>
                        </li>
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="estacionamiento">
                            <p>3</p>
                        </li>
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="habitaciones">
                            <p>6</p>
                        </li>
                    </ul>
                    <a href="anuncio.php" class="boton-amarillo-block">
                        Ver Propiedad
                    </a>
                </div><!-- Contenido Anuncio -->
            </div><!-- Anuncio -->

            <div class="anuncio">
                <picture>
                    <source srcset="build/img/anuncio6.webp" type="image/webp">
                    <source srcset="build/img/anuncio6.jpeg" type="image/jpeg">
                    <img loading="lazy" src="build/img/anuncio6.jpg" alt="anuncio">
                </picture>
                <div class="contenido-anuncio">
                    <h3>Casa un piso con extensión de terreno en L</h3>
                    <p>Casa en sector acomodado con extensión en L, consta de una variedad de lujos en su interior.</p>
                    <p class="precio">$540.000.000</p>

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
                    <a href="anuncio.php" class="boton-amarillo-block">
                        Ver Propiedad
                    </a>
                </div><!-- Contenido Anuncio -->
            </div><!-- Anuncio -->

        </div><!-- Contenedor Anuncios -->
    </main>

    <?php incluirTemplate('footer'); ?>