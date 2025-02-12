<?php 
    require 'includes/app.php';
    $inicio = true;
    incluirTemplate('header');
 
    // Conectamos a bd
        $db = conectarDB();

    // Validacion de Id válido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header('Location: /admin');
    }
    // Consultamos a la base de datos
    $queryPropiedades = "SELECT * FROM propiedades WHERE id={$id}";
    // Obtener los datos de la propiedad
    $resultadoQueryProp = mysqli_query($db, $queryPropiedades);
    $propiedad = mysqli_fetch_assoc($resultadoQueryProp);

    if (!$resultadoQueryProp->num_rows) {
        header('Location: /admin');
    }
?>
    <main class="contenedor seccion contenido-centrado">
        <h1><?php echo $propiedad['titulo']; ?></h1>

        <img loading="lazy" src="imagenes/<?php echo $propiedad['imagen']; ?>" alt="Imagen de la propiedad">

        <div class="resumen-propiedad">
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
            <p><?php echo $propiedad['descripcion']; ?></p>
        </div>
    </main>

    <?php 
        mysqli_close($db);
        incluirTemplate('footer');
    ?>