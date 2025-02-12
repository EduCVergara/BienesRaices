<?php 

    require 'includes/app.php';
    // Conectamos a la bd
    $db = conectarDB();

    $errores = [];

    // Autenticar el usuario
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
        $password = mysqli_real_escape_string($db, $_POST['password']);

        if (!$email) {
            $errores[] = "El E-Mail es obligatorio, o no es válido";
        }

        if (!$password) {
            $errores[] = "El password es obligatorio";
        }

        if (empty($errores)) {

            // Revisar si el usuario existe
            $query = "SELECT * FROM usuarios WHERE email = '{$email}'";
            $resultado = mysqli_query($db, $query);

            if ($resultado->num_rows) {
                // Revisar si el password es correcto
                $usuario = mysqli_fetch_assoc($resultado);

                // Verificar si el password es correcto o no
                $auth = password_verify($password, $usuario['password']);

                if ($auth) {
                    // Usuario autenticado
                    session_start();

                    // Llenar arreglo de la sessión
                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true;

                    header('Location: /admin');

                } else {
                    $errores[] = "El password es incorrecto";
                }
            } else {
                $errores[] = "El Usuario no existe";
            }
        }
    }

    // Incluye el header
    incluirTemplate('header');
?>
    <main class="contenedor seccion contenido-centrado">
        <h1>Login de Usuario</h1>

        <?php foreach ($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form method="POST" class="formulario" novalidate>
            <fieldset>
                <legend>E-mail y Password</legend>
                
                <label for="email">E-Mail</label>
                <input type="email" name="email" placeholder="Tu E-Mail" id="email" required>

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Tu Password" id="password" required>
            </fieldset>

            <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
        </form>
    </main>

    <?php incluirTemplate('footer'); ?>