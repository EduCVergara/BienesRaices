<?php
    require '../includes/app.php';
    Autenticado();

    use App\Propiedad;
    use App\Vendedores;

    // Implementar un método para obtener propiedades utilizando ActiveRecord
    $propiedades = Propiedad::all();
    $vendedores = Vendedores::all();

    // Muestra mensaje condicional
    $resultado = $_GET['resultado'] ?? null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if ($id) {

            $tipo = $_POST['tipo'];

            if (validarTipoContenido($tipo)) {
                // Compara lo que vamos a eliminar
                if ($tipo === 'vendedor' ) {
                    $vendedor = Vendedores::find($id);
                    $vendedor->eliminar();
                } else if ($tipo === 'propiedad') {
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
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
            <p class="alerta exito">Elemento Agregado Correctamente</p>
        <?php elseif($resultado == 2): ?>
            <p class="alerta exito">Datos Actualizados Correctamente </p>
        <?php elseif($resultado == 3): ?>
            <p class="alerta exito">Elemento Eliminado</p>
        <?php endif; ?>

        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
        <a href="/admin/vendedores/crear.php" class="boton boton-verde">Nuevo Vendedor(a)</a>

        <h2>Propiedades</h2>

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
                        
                        <form method="POST" class="w-100 form-eliminacion" onsubmit="return abrirModal(event, <?php echo $propiedad->id; ?>, 'propiedad')">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Vendedores</h2>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody> <!-- Mostrar los resultados -->
                <?php foreach($vendedores as $vendedor): ?>
                
                <tr>
                    <td><?php echo $vendedor->id; ?></td>
                    <td><?php echo $vendedor->nombre . ' ' . $vendedor->apellido; ?></td>
                    <td><?php echo $vendedor->telefono; ?></td>
                    <td>
                        <a href="admin/vendedores/actualizar.php?id=<?php echo $vendedor->id; ?>" class="boton-amarillo-block">Actualizar</a>
                        
                        <form method="POST" class="w-100 form-eliminacion" onsubmit="return abrirModal(event, <?php echo $vendedor->id; ?>, 'vendedor')">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id ?>">
                            <input type="hidden" name="tipo" value="vendedor">
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
            <p>¿Estás seguro de que deseas eliminar este elemento?</p>
            <form id="formEliminar" method="POST" class="w-100">
                <input type="hidden" name="id" id="idEliminar">
                <input type="hidden" name="tipo" id="tipoModal">
                <button type="submit" class="boton-rojo-block">Sí, eliminar</button>
                <button type="button" class="boton-amarillo-block" onclick="cerrarModal()">Cancelar</button>
            </form>
        </div>
    </div>

    <?php 

    incluirTemplate('footer'); 
    
    ?>