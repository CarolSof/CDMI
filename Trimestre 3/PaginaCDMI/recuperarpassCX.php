<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];

    // Conexión a la base de datos
    $conn = new mysqli("localhost", "root", "", "cdmi_bd");

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Verificar si el correo existe en la base de datos
    $query = "SELECT * FROM usuarios WHERE correo = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $correo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Generar un token único
        $token = bin2hex(random_bytes(50));

        // Almacenar el token en la base de datos
        $query = "INSERT INTO solicitudes_recuperacion (correo, token) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ss', $correo, $token);
        $stmt->execute();

        // Configurar PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Cambia esto al host de tu servidor SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'cdmiindigena@gmail.com'; // Cambia esto a tu dirección de correo
            $mail->Password = 'x w k e a y f k c o a a w l x n'; // Cambia esto a tu contraseña
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            // Configuración del correo electrónico
            $mail->setFrom('cdmiindigena@gmail.com', 'CDMI');
            $mail->addAddress($correo);
            $mail->Subject = 'Recuperación de contraseña';
            $mail->Body = "tu token es el siguiente:  ($token) Haz clic en el siguiente enlace para restablecer tu contraseña: 
            https://localhost:8080/PaginaCDMI/buscar.html";

            $mail->send();
            echo "Correo enviado. Revisa tu bandeja de entrada.";
        } catch (Exception $e) {
            echo "No se pudo enviar el correo. Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Correo no encontrado.";
    }

    $stmt->close();
    $conn->close();
}
?>
