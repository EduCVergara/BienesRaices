<?php 

require '../../includes/app.php';

use App\Vendedores;

Autenticado();

$vendedor = new Vendedores();

// Arreglo con mensajes de errores
$errores  = Vendedores::getErrores();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Creamos una nueva instancia del objeto "vendedor"
    $vendedor = new Vendedores($_POST['vendedor']);

    // Validar que no haya campos vacíos
    $errores = $vendedor->validar();

    // Si no hay $errores (no estén vacíos los campos)
    if (empty($errores)) {
        $vendedor->guardar();
    }
}

incluirTemplate('header');

?>
    <main class="contenedor seccion">
        <h1>Registrar Vendedor(a)</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error?>
        </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" action="/admin/vendedores/crear.php" enctype="multipart/form-data">

            <?php include '../../includes/templates/formulario_vendedores.php';  ?>

            <input type="submit" value="Registrar Vendedor(a)" class="boton boton-verde">
        </form>
    </main>

<?php incluirTemplate('footer'); ?>