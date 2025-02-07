<?php 
    require '../../includes/funciones.php';
    // Comprobar la sesión
    $auth = Autenticado();

    if (!$auth) {
        header('Location: /login.php');
    }
    //Base de datos
    require "../../includes/config/database.php";
    $db = conectarDB();
    // Consultar para obtener los vendedores
    $queryVendedores = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $queryVendedores);


    // Array con mensajes de errores

    $errores = [];

    $titulo = '';
    $precio = '';
    $descripcion = '';
    $habitaciones = '';
    $wc = '';
    $estacionamiento = '';
    $vendedorId = '';

    // Ejecutar el código luego de que el usuario envía el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";
        
        echo "<pre>";
        var_dump($_FILES);
        echo "</pre>";

        $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
        $precio = mysqli_real_escape_string($db, $_POST['precio']);
        $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
        $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
        $wc = mysqli_real_escape_string($db, $_POST['wc']);
        $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
        $vendedorId = mysqli_real_escape_string($db, $_POST['vendedor']);
        $creado = date('Y/m/d');

        //asignación de FILEs hacia una variable

        $imagen = $_FILES['imagen'];

        if(!$titulo) {
            $errores[] = "La propiedad debe tener un <strong>título</strong>";
        }

        if(!$precio) {
            $errores[] = "La propiedad debe tener un <strong>precio</strong>";
        }

        if(strlen($descripcion) < 50) {
            $errores[] = "La propiedad debe tener una <strong>descripcion</strong>, y debe tener al menos 50 caracteres para más posibilidades de venta";
        }

        if(!$habitaciones) {
            $errores[] = "La propiedad debe tener <strong>habitaciones</strong>";
        }

        if(!$wc) {
            $errores[] = "La propiedad debe especificar cuantos <strong>baños</strong> tiene";
        }

        if(!$estacionamiento) {
            $errores[] = "La propiedad debe especificar cuantos <strong>estacionamientos</strong> tiene";
        }

        if(!$vendedorId) {
            $errores[] = "Debes elegir un  <strong>vendedor</strong>";
        }

        if(!$imagen['name'] || $imagen['error']) {
            $errores[] = "La propiedad debe contener una <strong>imagen</strong>";
        }

        // Validación por tamaño
        $medida = 1000 * 1000;

        if($imagen['size'] > $medida) {
            $errores[] = "La imagen no debe superar los 1000kb (1mb)";
        }

        // echo "<pre>";
        // var_dump($errores);
        // echo "</pre>";

        // exit;

        // Revisar que el arreglo de errores esté vacío
        if (empty($errores)) {

            // * Subida de Archivos *//

            // Crear Carpeta
            $carpetaImagenes = '../../imagenes/';

            if (!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes);
            }

            // Generar nombre único a imagen
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            var_dump($nombreImagen);

            // Subir la Imagen
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);

            // Insertar en la base de datos
            $query = "INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedores_id) VALUES ('$titulo', '$precio', '$nombreImagen', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado', '$vendedorId')";

            // echo $query;
            $resultado = mysqli_query($db, $query);

            if ($resultado) {
                // Redireccionar al Usuario
                header('Location: /admin?resultado=1');
            }
        } else {

        }

        

    }

    $inicio = true;
    incluirTemplate('header');
?>
    <main class="contenedor seccion">
        <h1>Crear Propiedad</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error?>
        </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Título de la propiedad" value="<?php echo $titulo;?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio de la propiedad" value="<?php echo $precio;?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" placeholder="Ejemplo: Casa roja con puertas y ventanas" name="descripcion"><?php echo $descripcion;?></textarea>
            </fieldset>

            <fieldset>
                <legend>Información de la Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" placeholder="Ejemplo: 2" min="1" max="9" name="habitaciones" value="<?php echo $habitaciones;?>">

                <label for="wc">Baños:</label>
                <input type="number" id="wc" placeholder="Ejemplo: 1" min="1" max="9" name="wc" value="<?php echo $wc;?>">

                <label for="estacionamiento">Estacionamientos:</label>
                <input type="text" id="estacionamiento" placeholder="Ejemplo: 2" min="1" max="9" name="estacionamiento" value="<?php echo $estacionamiento;?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedor">
                    <option value="">-- Seleccione un Vendedor--</option>
                    <?php while($vendedor = mysqli_fetch_assoc($resultado) ) : ?>
                        <option <?php echo $vendedorId === $vendedor['id'] ? 'selected' : ''; ?> value="<?php echo $vendedor['id']; ?>"><?php echo $vendedor['nombre'] . " " . $vendedor['apellido']; ?></option>
                    <?php endwhile;?>
                </select>
            </fieldset>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </form>
    </main>

    <?php incluirTemplate('footer'); ?>