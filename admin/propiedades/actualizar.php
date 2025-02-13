<?php

use App\Propiedad;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;

    require '../../includes/app.php';
    // Comprobar la sesión
    
    Autenticado();

    // Consultar para obtener los vendedores
    $queryVendedores = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $queryVendedores);
    // Validacion de Id válido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header('Location: /admin');
    }
    // Obtener los datos de la propiedad
    $propiedad = Propiedad::find($id);

    
    // Array con mensajes de errores

    $errores = Propiedad::getErrores();

    // Ejecutar el código luego de que el usuario envía el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Asignar los atributos
        $args = $_POST['propiedad'];

        $propiedad->sync($args);

        $errores = $propiedad->validar();


        // Revisar que el arreglo de errores esté vacío
        if (empty($errores)) {

            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $manager = new Image(Driver::class);// $manager es la variable para intervention image (subir imágenes con POO instalada con Composer)
                $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800, 600);
                $propiedad->setImagen($nombreImagen);
            }
            
            exit;
            // Insertar en la base de datos
            $query = "UPDATE propiedades SET titulo='{$titulo}', precio='{$precio}', imagen = '{$nombreImagen}', descripcion='{$descripcion}', habitaciones={$habitaciones}, wc={$wc}, estacionamiento={$estacionamiento}, vendedores_id={$vendedorId} WHERE id={$id} ";

            // echo $query;
            $resultado = mysqli_query($db, $query);

            if ($resultado) {
                // Redireccionar al Usuario
                header('Location: /admin?resultado=2');
            }
        } else {

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