<?php
// conexion.php
$conn = mysqli_connect("localhost", "root", "", "cdmi_bd");

if (!$conn) {
    die("Error: No se pudo conectar a MySQL. " . mysqli_connect_error());
}
?>