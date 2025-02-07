<?php 
    require '../../includes/funciones.php';
    // Comprobar la sesión
    $auth = Autenticado();

    if (!$auth) {
        header('Location: /');
    }
    //Base de datos
    require "../../includes/config/database.php";
    $db = conectarDB();
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
    $queryPropiedades = "SELECT * FROM propiedades WHERE id={$id}";
    $resultadoQueryProp = mysqli_query($db, $queryPropiedades);
    $propiedad = mysqli_fetch_assoc($resultadoQueryProp);

    // echo "<pre>";
    // var_dump($propiedad);
    // echo "</pre>";

    // Array con mensajes de errores

    $errores = [];

    $titulo = $propiedad['titulo'];
    $precio = $propiedad['precio'];
    $descripcion = $propiedad['descripcion'];
    $habitaciones = $propiedad['habitaciones'];
    $wc = $propiedad['wc'];
    $estacionamiento = $propiedad['estacionamiento'];
    $vendedorId = $propiedad['vendedores_id'];
    $imagenPropiedad = $propiedad['imagen'];

    // Ejecutar el código luego de que el usuario envía el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";
        
        // echo "<pre>";
        // var_dump($_FILES);
        // echo "</pre>";

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

            $nombreImagen = '';

            if ($imagen['name']) { // Si existe una imagen?
                // Eliminar imagen previa
                unlink($carpetaImagenes . $propiedad['imagen']);
                
                // Generar nombre único a imagen
                $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

                // Subir la Imagen
                move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
            } else {
                $nombreImagen = $propiedad['imagen'];
            }
            
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
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Título de la propiedad" value="<?php echo $titulo;?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio de la propiedad" value="<?php echo $precio;?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                <img src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="imagen propiedad" class="imagen-small">

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

            <input type="submit" value="Actualizar Datos" class="boton boton-verde">
        </form>
    </main>

    <?php incluirTemplate('footer'); ?>