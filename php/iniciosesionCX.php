<?php
include("conexionbd.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Correo = $_POST['Correo'];
    $Contraseña = $_POST['Contraseña'];

    if (!$conn) {
        die("<h2>No se encuentra el servidor</h2>");
    }

    // Verificar si el correo y la contraseña son correctos
    $query = $conn->prepare("SELECT * FROM usuarios WHERE Correo = ? AND Contraseña = ?");
    $query->bind_param("ss", $Correo, $Contraseña);
    $query->execute();
    $nr = $query->get_result()->num_rows;

    if ($nr == 1) {
        header("Location: ./inicio.html");
        exit;
    } else {
        // Verificar si el correo existe
        $query = $conn->prepare("SELECT * FROM usuarios WHERE Correo = ?");
        $query->bind_param("s", $Correo);
        $query->execute();
        $nr = $query->get_result()->num_rows;

        if ($nr == 0) {
            echo'<script type="text/javascript"> alert("Correo y contraseña incorrectos o no existen"); window.location.href="iniciosesion.html"; </script>';
        } else {
            echo'<script type="text/javascript"> alert("Contraseña incorrecta"); window.location.href="iniciosesion.html"; </script>';
        }
    }
}
?>