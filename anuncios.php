<?php 
    require 'includes/app.php';
    $inicio = true;
    incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h2>Casas y Departamentos en Venta</h2>

        <!-- Aquí van los anuncios -->
        <?php 
            include 'includes/templates/anuncios.php';
        ?>

    </main>

    <?php incluirTemplate('footer'); ?>