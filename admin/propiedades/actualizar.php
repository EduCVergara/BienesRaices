<?php

use App\Propiedad;
use App\Vendedores;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;

    require '../../includes/app.php';
    // Comprobar la sesión
    
    Autenticado();

    // Validacion de Id válido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header('Location: /admin');
    }
    // Obtener los datos de la propiedad
    $propiedad = Propiedad::find($id);

    // Consulta para obtener todos los vendedores
    $vendedores = Vendedores::all(); 
   
    // Array con mensajes de errores
    $errores = Propiedad::getErrores();

    // Ejecutar el código luego de que el usuario envía el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Asignar los atributos
        $args = $_POST['propiedad'];

        $propiedad->sync($args);

        // Validación de campos
        $errores = $propiedad->validar();

        // Genera un nombre único a la imagen
        $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

        // Setear la imagen
        // Realiza un resize a la imagen con intervention
        if ($_FILES['propiedad']['tmp_name']['imagen']) {
            $manager = new Image(Driver::class);// $manager es la variable para intervention image (subir imágenes con POO instalada con Composer)
            $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800, 600);
            $propiedad->setImagen($nombreImagen);
        }
        // Revisar que el arreglo de errores esté vacío
        if (empty($errores)) {
            // Almacenar la imagen
            if ($_FILES['propiedad']['tmp_name']['imagen']){
                $image->save(CARPETA_IMAGENES . $nombreImagen);
            }
            $propiedad->guardar();
        }
    }

    $inicio = true;
    incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Actualizar Propiedad</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error?>
        </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" enctype="multipart/form-data">
            <?php include '../../includes/templates/formulario_propiedades.php'; ?>

            <input type="submit" value="Actualizar Datos" class="boton boton-verde">
        </form>
    </main>

    <?php incluirTemplate('footer'); ?>