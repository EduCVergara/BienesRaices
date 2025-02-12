<?php

session_start();

// Cerramos sesión dejando la variable global de sesión vacía
$_SESSION = [];

header('Location: /login.php');