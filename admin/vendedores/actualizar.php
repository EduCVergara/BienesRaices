<?php 

require '../../includes/app.php';
use App\Vendedores;
Autenticado();

// Validar el id
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: /admin');
}

// Obtener arreglo del vendedor desde la base de datos
$vendedor = Vendedores::find($id);

// Arreglo con mensajes de errores
$errores  = Vendedores::getErrores();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Asignar los valores actualizados por el usuario
    $args = $_POST['vendedor'];
    // Sincronizar objeto en memoria con lo que el usuario escribió
    $vendedor->sync($args);
    // Validación
    $errores = $vendedor->validar();

    if (empty($errores)) {
        $vendedor->guardar();
    }
}

incluirTemplate('header');

?>
    <main class="contenedor seccion">
        <h1>Actualizar Vendedor(a)</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error?>
        </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" enctype="multipart/form-data">

            <?php include '../../includes/templates/formulario_vendedores.php';  ?>

            <input type="submit" value="Actualizar Vendedor(a)" class="boton boton-verde">
        </form>
    </main>

<?php incluirTemplate('footer'); ?>