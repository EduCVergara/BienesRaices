<?php 
    require '../includes/funciones.php';
    $inicio = true;
    incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Administración de Bienes Raíces</h1>

        <a href="/admin/propiedades/crear.php" class="boton-verde">Nueva Propiedad</a>
    </main>

    <?php incluirTemplate('footer'); ?>