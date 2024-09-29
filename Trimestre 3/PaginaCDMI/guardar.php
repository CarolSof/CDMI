<?php
include 'conexionbd.php';

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$categoria = $_POST['categoria'];
$caracteristicas = $_POST['caracteristicas'];
$imagen = $_FILES['imagen']['name'];

// Ruta absoluta al directorio de imágenes
$uploadDir = __DIR__ . '/uploads/';  // Usa __DIR__ para obtener la ruta del directorio actual
$uploadFile = $uploadDir . basename($imagen);

// Verifica si se subió una imagen
if ($imagen) {
    // Mover la imagen al directorio de destino
    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $uploadFile)) {
        echo "Imagen subida con éxito.";
    } else {
        echo "Error al subir la imagen.";
        exit;
    }
}

if ($id) {
    // Actualizar producto existente
    if ($imagen) {
        $sql = "UPDATE productos SET nombre = '$nombre', precio = '$precio', categoria = '$categoria', caracteristicas = '$caracteristicas', imagen = '$imagen' WHERE id = $id";
    } else {
        // Si no se sube una nueva imagen, no actualizar el campo de imagen
        $sql = "UPDATE productos SET nombre = '$nombre', precio = '$precio', categoria = '$categoria', caracteristicas = '$caracteristicas' WHERE id = $id";
    }
} else {
    // Insertar nuevo producto
    $sql = "INSERT INTO productos (nombre, precio, categoria, caracteristicas, imagen) VALUES ('$nombre', '$precio', '$categoria', '$caracteristicas', '$imagen')";
}

if ($conn->query($sql) === TRUE) {
    header("Location: PRODUCTOSADMIN.PHP");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
