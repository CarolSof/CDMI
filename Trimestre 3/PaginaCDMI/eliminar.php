<?php
include 'conexionbd.php';

$id = $_GET['id'];

$sql = "DELETE FROM productos WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    header("Location: PRODUCTOSADMIN.PHP");
} else {
    echo "Error al eliminar el producto: " . $conn->error;
}

$conn->close();
?>
