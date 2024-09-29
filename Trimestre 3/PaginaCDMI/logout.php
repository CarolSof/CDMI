<?php
session_start(); // Inicia la sesión

// Borra todas las variables de sesión
$_SESSION = array();

// Si se está utilizando una cookie de sesión, la borramos
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalmente, destruye la sesión
session_destroy();

// Redirige a la página de inicio de sesión o a la página principal
header("Location: index.html");
exit();
?>
