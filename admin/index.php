<?php 

    // Importar la conexión
    require "../includes/config/database.php";
    $db = conectarDB();

    // Escribir el Query
    $query = "SELECT * FROM propiedades";

    // Consultar la base de datos
    $resultadoQuery = mysqli_query($db, $query);

    // Muestra mensaje condicional
    $resultado = $_GET['resultado'] ?? null;

    // Incluye un template
    require '../includes/funciones.php';
    $inicio = true;
    incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Administración de Bienes Raíces</h1>

        <?php if($resultado == 1): ?>
            <p class="alerta exito">Propiedad Agregada Correctamente</p>
        <?php endif; ?>

        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!-- Mostrar los resultados -->
                <?php while ($propiedad = mysqli_fetch_assoc($resultadoQuery)): ?>
                
                <tr>
                    <td><?php echo $propiedad['id']; ?></td>
                    <td><?php echo $propiedad['titulo']; ?></td>
                    <td><img src="/imagenes/<?php echo $propiedad['imagen']; ?>" class="imagen-tabla"></td>
                    <td>$<?php echo number_format($propiedad['precio']); ?></td>
                    <td>
                        <a href="admin/propiedades/actualizar.php?id=<?php echo $propiedad['id']; ?>" class="boton-amarillo-block">Actualizar</a>
                        <a href="#" class="boton-rojo-block">Eliminar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>

    <?php 
    
    // Cerrar la base de datos
    mysqli_close($db);
    incluirTemplate('footer'); 
    
    ?>