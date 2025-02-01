<?php 
    require 'includes/funciones.php';
    $inicio = true;
    incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Conócenos</h1>
        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img loading="lazy" src="/build/img/nosotros.jpg" alt="Imagen Nosotros">
                </picture>
            </div>
            <div class="texto-nosotros">
                <h4>30 Años de Experiencia</h4>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ut, repellendus. Quos eveniet cum accusamus doloremque totam laborum, dicta ea quia, temporibus optio ipsam atque corporis. Vel aspernatur culpa doloremque, esse nisi veritatis quae sint voluptatum soluta nam, totam labore fugiat quia quas deserunt praesentium non nesciunt velit veniam tempora doloribus debitis. Repellat similique quas nemo placeat eum nulla asperiores odio, totam reiciendis porro atque deleniti, fugit explicabo est vero ipsam nostrum! Esse provident quaerat voluptas voluptatum nostrum nesciunt nisi, consequatur illum molestias vero. Quam, repellendus inventore, voluptas ipsam ratione, numquam obcaecati quidem voluptatibus modi vero perspiciatis! Sint aliquid.</p>
            </div>
        </div>
    </main>

    <section class="contenedor seccion">
        <h1>Más Sobre Nosotros</h1>
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
    </section>

    <?php incluirTemplate('footer'); ?>