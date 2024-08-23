<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $token = $_POST['token'];
    $nueva_contraseña = password_hash($_POST['nueva_contraseña'], PASSWORD_BCRYPT);

    // Conexión a la base de datos
    $conn = new mysqli("localhost", "root", "", "cdmi_bd");

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Verificar si el token es válido
    $query = "SELECT correo FROM solicitudes_recuperacion WHERE token = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Actualizar la contraseña del usuario
        $row = $result->fetch_assoc();
        $correo = $row['correo'];

        $query = "UPDATE usuarios SET contraseña = ? WHERE correo = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $nueva_contraseña, $correo);
        $stmt->execute();

        echo "Contraseña actualizada exitosamente.";
    } else {
        echo "Token no válido o expirado.";
    }

    $stmt->close();
    $conn->close();
}
?>
