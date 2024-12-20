<?php
include("conexionbd.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Correo = $_POST['Correo'];
    $Contraseña = $_POST['Contraseña'];

    if (!$conn) {
        die("<h2>No se encuentra el servidor</h2>");
    }

    // Verificar si el correo existe
    $query = $conn->prepare("SELECT * FROM usuarios WHERE Correo = ?");
    $query->bind_param("s", $Correo);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Verificar si la contraseña es correcta
        if (password_verify($Contraseña, $user['contraseña'])) {
            // Verificar el rol del usuario
            if ($user['rol'] == 'usuario') {
                header("Location: inicio.html");
                $_SESSION['user_id'] = $user['ID_Usuario'];
                exit;
            } elseif ($user['rol'] == 'administrador') {
                header("Location: admininicio.html");
                exit;
            }
        } else {
            echo '<script type="text/javascript"> alert("Contraseña incorrecta"); window.location.href="iniciosesion.html"; </script>';
        }
    } else {
        echo '<script type="text/javascript"> alert("Correo no registrado"); window.location.href="iniciosesion.html"; </script>';
    }
}
?>