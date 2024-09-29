<?php
session_start();
include("conexionbd.php");

// Verificar la conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Asegúrate de que el usuario esté autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: iniciosesion.html");
    exit();
}

$user_id = $_POST['user_id']; // Recibir el id del usuario desde el formulario

// Eliminar el usuario de la base de datos
$query = $conn->prepare("DELETE FROM usuarios WHERE ID_Usuario ='$user_id'");

if ($query->execute()) {
    // Cerrar sesión del usuario eliminado
    session_destroy();
    echo '<script type="text/javascript"> alert("Usuario eliminado correctamente"); window.location.href="iniciosesion.html"; </script>';
} else {
    echo "Error al eliminar el usuario: " . $query->error;
}

$query->close();
mysqli_close($conn);
?>