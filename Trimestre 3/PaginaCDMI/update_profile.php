<?php
include("conexionbd.php");
include("iniciosesionCX.php");

// Verificar conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Asegúrate de que el usuario esté autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: iniciosesion.html");
    exit();
}

// Obtener el ID del usuario desde la sesión
$user_id = $_SESSION['user_id'];

// Recoger y validar los datos del formulario
$nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
$apellido = isset($_POST['apellido']) ? trim($_POST['apellido']) : '';
$fecha_nacimiento = isset($_POST['fecha_nacimiento']) ? trim($_POST['fecha_nacimiento']) : '';
$correo = isset($_POST['correo']) ? trim($_POST['correo']) : '';
$telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';

// Verificar que todos los campos estén llenos (puedes agregar más validaciones según sea necesario)
if (empty($nombre) || empty($apellido) || empty($fecha_nacimiento) || empty($correo) || empty($telefono)) {
    echo "Todos los campos son obligatorios.";
    exit();
}

// Preparar la consulta para actualizar los datos
$query = $conn->prepare("
    UPDATE usuarios
    SET nombre = ?, apellido = ?, fecha_nacimiento = ?, correo = ?, telefono = ?
    WHERE ID_Usuario = ?
");
$query->bind_param("sssssi", $nombre, $apellido, $fecha_nacimiento, $correo, $telefono, $user_id);

// Ejecutar la consulta
if ($query->execute()) {
    echo "Perfil actualizado con éxito.";
} else {
    echo "Error al actualizar el perfil: " . $query->error;
}

// Cerrar la consulta y la conexión
$query->close();
mysqli_close($conn);

// Redirigir al perfil de usuario después de la actualización
header("Location: perfil.php");
exit();
?>
