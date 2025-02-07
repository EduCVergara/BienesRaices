<?php 
    declare(strict_types = 1);

    require 'includes/funciones.php';
    $inicio = true;
    incluirTemplate('header', true);
?>

    <main class="contenedor seccion">
        <h1>Sobre Nosotros</h1>
        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="icono seguridad bienes raices" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nihil commodi eius officia vitae sed explicabo magnam labore autem impedit! Quidem!</p>
            </div>
            <div class="icono">
                <img src="build/img/icono2.svg" alt="icono precio bienes raices" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nihil commodi eius officia vitae sed explicabo magnam labore autem impedit! Quidem!</p>
            </div>
            <div class="icono">
                <img src="build/img/icono3.svg" alt="icono tiempo bienes raices" loading="lazy">
                <h3>Tiempo</h3>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nihil commodi eius officia vitae sed explicabo magnam labore autem impedit! Quidem!</p>
            </div>
        </div>
    </main>

    <!-- Sección de Anuncios -->
    <section class="seccion contenedor">
        <h2>Casas y Departamentos en Venta</h2>

        <!-- Aquí van los anuncios -->
         <?php 
         
            $limite = 3;
            include 'includes/templates/anuncios.php';

         ?>
        
        <div class="alinear-derecha">
            <a href="anuncios.php" class="boton-verde">Ver Todas las Propiedades</a>
        </div>
    </section>
    <!-- Sección de Anuncios -->

    <section class="imagen-contacto">
        <h2>Encuentra la casa de tus sueños</h2>
        <p>Llena el formulario de contacto y nos pondremos en contacto contigo a la brevedad</p>
        <a href="contacto.php" class="boton-amarillo">Contáctanos</a>
    </section>

    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h3>Nuestro Blog</h3>
            
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="image/webp"> 
                        <source srcset="build/img/blog1.jpg" type="image/jpeg">
                        <img loading="lazy" src="build/img/blog1.jpg" alt="Texto Entrada Blog">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Terraza en el techo de tu casa</h4>
                        <p class="informacion-meta">Escrito el: <span>28/01/2025</span> por: <span>Admin</span></p>

                        <p>Consejos para construir una terraza en el techo de tu casa con los mejores materiales y ahorrando dinero</p>
                    </a>
                </div>
            </article> <!-- Termino de Artículo -->

            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="image/webp"> 
                        <source srcset="build/img/blog2.jpg" type="image/jpeg">
                        <img loading="lazy" src="build/img/blog2.jpg" alt="Texto Entrada Blog">
                    </picture>
                </div>

                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Guía para la decoración de tu hogar</h4>
                        <p class="informacion-meta">Escrito el: <span>28/01/2025</span> por: <span>Admin</span></p>

                        <p>Maximiza el espacio de tu hogar con esta guía, aprende a combinar muebles y colores para darle vida a tu espacio</p>
                    </a>
                </div>
            </article> <!-- Termino de Artículo -->
        </section>

        <section class="testimoniales">
            <h3>Testimoniales</h3>

            <div class="testimonial">
                <blockquote>
                    La empresa se comportó de una excelente forma, muy buena atención y la casa que me ofrecieron cumplió con todas mis expectativas.
                </blockquote>
                <p>- Anónimo</p>
            </div>
        </section>
    </div>

<?php incluirTemplate('footer'); ?>