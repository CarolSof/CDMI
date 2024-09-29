<?php
include 'conexionbd.php';

// Inicializar variables
$id = $nombre = $precio = $categoria = $caracteristicas = $imagen = "";
$isEdit = false;

if (isset($_GET['id'])) {
    $isEdit = true;
    $id = $_GET['id'];
    $sql = "SELECT * FROM productos WHERE id = $id";
    $result = $conn->query($sql);
    $producto = $result->fetch_assoc();
    $nombre = $producto['nombre'];
    $precio = $producto['precio'];
    $categoria = $producto['categoria'];
    $caracteristicas = $producto['caracteristicas'];
    $imagen = $producto['imagen'];
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto CDMI</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f4f1ea; /* Fondo claro y cálido */
            font-family: 'Roboto Condensed', sans-serif;
            color: #333; /* Texto oscuro para contraste */
        }
        .sidebar {
            width: 200px;
            background-color: rgb(129, 41, 41); 
            border-right: 2px solid #d9c3b0; /* Detalle de borde */
            padding-top: 20px;
            text-align: center;
        }
        .sidebar img {
            border-radius: 50%;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s;
            font-size: 14px;
        }
        .sidebar a:hover {
            color: #ffdd57; /* Amarillo vibrante */
        }
        .content {
            flex-grow: 1;
            padding: 20px;
        }
        .image-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin-top: 20px;
        }
        .image-item {
            text-align: center;
            margin: 10px;
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            max-width: 200px;
        }
        .image-item img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
        }
        .image-item p {
            margin-top: 10px;
            font-size: 14px;
            color: #333;
        }
        .close-session {
            text-decoration: underline;
            cursor: pointer;
            color: #ffdd57; /* Amarillo vibrante */
        }
        .nav-link {
            margin: 5px 0;
            padding: 8px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .nav-link:hover {
            background-color: rgb(194, 86, 86)
        }
        .header-logo {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
<div class="d-flex">
    <div class="sidebar vh-100 text-center p-3">
        <img src="img/logocdmi.png" width="70" alt="CDMI Logo" class="header-logo">
        <h5 class="text-light">CDMI</h5>
        <p class="text-light mb-4">Administrador</p>
        <a href="logout.php" class="close-session" onclick="cerrarSesion()">Cerrar sesión</a>
    </div>
    <div class="container my-5">
        <h1><?php echo $isEdit ? 'Editar' : 'Agregar'; ?> Producto</h1>
        <form action="guardar.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Producto</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="<?php echo $precio; ?>" required>
            </div>
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoría</label>
                <input type="text" class="form-control" id="categoria" name="categoria" value="<?php echo $categoria; ?>" required>
            </div>
            <div class="mb-3">
                <label for="caracteristicas" class="form-label">Características</label>
                <textarea class="form-control" id="caracteristicas" name="caracteristicas" rows="3" required><?php echo $caracteristicas; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen del Producto</label>
                <input type="file" class="form-control" id="imagen" name="imagen" <?php echo $isEdit ? '' : 'required'; ?>>
                <?php if ($isEdit && $imagen): ?>
                    <img src="uploads/<?php echo $imagen; ?>" width="150" class="mt-3" alt="Imagen del Producto">
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-outline-dark"><?php echo $isEdit ? 'Actualizar' : 'Guardar'; ?></button>
            <a href="PRODUCTOSADMIN.php" class="btn btn-outline-dark">Cancelar</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
