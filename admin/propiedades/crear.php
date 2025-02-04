<?php 
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

        $titulo = $_POST['titulo'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];
        $habitaciones = $_POST['habitaciones'];
        $wc = $_POST['wc'];
        $estacionamiento = $_POST['estacionamiento'];
        $vendedorId = $_POST['vendedor'];
        $creado = date('Y/m/d');

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

        // echo "<pre>";
        // var_dump($errores);
        // echo "</pre>";

        // exit;

        // Revisar que el arreglo de errores esté vacío
        if (empty($errores)) {
            // Insertar en la base de datos
            $query = "INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, wc, estacionamiento, creado, vendedores_id) VALUES ('$titulo', '$precio', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado', '$vendedorId')";

            // echo $query;
            $resultado = mysqli_query($db, $query);

            if ($resultado) {
                // Redireccionar al Usuario
                header('Location: /admin');
            }
        } else {

        }

        

    }

    require '../../includes/funciones.php';
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

        <form class="formulario" method="POST" action="/admin/propiedades/crear.php">
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Título de la propiedad" value="<?php echo $titulo;?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio de la propiedad" value="<?php echo $precio;?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png">

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

        <!-- Modal -->
    <div id="modalExito" class="modal hidden">
        <div class="modal-content">
            <h2>Propiedad Agregada Correctamente</h2>
            <input type="submit" class="boton boton-verde" value="Aceptar" onclick="cerrarModal()">
        </div>
    </div>

    <?php incluirTemplate('footer'); ?>