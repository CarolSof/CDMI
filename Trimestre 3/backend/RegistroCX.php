<?php
// Conexión a la base de datos
include("conexionbd.php");

// Verificar conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Procesar el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $fecha_nacimiento = $_POST["fecha_nacimiento"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];
    $contraseña = $_POST["contraseña"];
    $rol = $_POST["rol"];

    $contraseña = password_hash($contraseña, PASSWORD_DEFAULT,[50]);

    // Preparar la consulta SQL
    $query = $conn->prepare("INSERT INTO usuarios (nombre, apellido, fecha_nacimiento, correo, telefono, contraseña, rol) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $query->bind_param("sssssss", $nombre, $apellido, $fecha_nacimiento, $correo, $telefono, $contraseña, $rol);

    // Ejecutar la consulta
    if ($query->execute()) {
        echo "Datos guardados con éxito";
        header("Location: ./iniciosesion.html");
    } else {
        echo "Error al guardar los datos: " . $query->error;
    }
}

// Cerrar la conexión
mysqli_close($conn);
?>