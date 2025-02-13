<?php
    require '../includes/app.php';
    Autenticado();

    use App\Propiedad;

    // Implementar un método para obtener propiedades utilizando ActiveRecord
    $propiedades = Propiedad::all();

    // Muestra mensaje condicional
    $resultado = $_GET['resultado'] ?? null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if ($id) {

            // Eliminar el archivo
            $query = "SELECT imagen FROM propiedades WHERE id={$id}";
            
            $resultado = mysqli_query($db, $query);
            $propiedad = mysqli_fetch_assoc($resultado);

            unlink('../imagenes/' . $propiedad['imagen']);

            // Eliminar la propiedad
            $query = "DELETE FROM propiedades WHERE id={$id}";

            $resultado = mysqli_query($db, $query);

            if ($resultado) {
                header('location: /admin?resultado=3');
            }
        }
    }

    // Incluye un template
    $inicio = true;
    incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Administración de Bienes Raíces</h1>

        <?php if($resultado == 1): ?>
            <p class="alerta exito">Propiedad Agregada Correctamente</p>
        <?php elseif($resultado == 2): ?>
            <p class="alerta exito">Datos Actualizados Correctamente</p>
        <?php elseif($resultado == 3): ?>
            <p class="alerta exito">Propiedad Eliminada</p>
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
                <?php foreach($propiedades as $propiedad): ?>
                
                <tr>
                    <td><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->titulo; ?></td>
                    <td><img src="/imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-tabla"></td>
                    <td>$<?php echo number_format($propiedad->precio); ?></td>
                    <td>
                        <a href="admin/propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
                        
                        <form method="POST" class="w-100 form-eliminacion" onsubmit="return abrirModal(event, <?php echo $propiedad->id; ?>)">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id ?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <!-- Modal de Confirmación -->
    <div id="modalConfirmacion" class="modal">
        <div class="modal-contenido">
            <h2>Confirmar Eliminación</h2>
            <p>¿Estás seguro de que deseas eliminar esta propiedad?</p>
            
            <form id="formEliminar" method="POST" class="w-100">
                <input type="hidden" name="id" id="idEliminar">
                <button type="submit" class="boton-rojo-block">Sí, eliminar</button>
                <button type="button" class="boton-amarillo-block" onclick="cerrarModal()">Cancelar</button>
            </form>
        </div>
    </div>

    <?php 
    
    // Cerrar la base de datos
    mysqli_close($db);
    incluirTemplate('footer'); 
    
    ?>