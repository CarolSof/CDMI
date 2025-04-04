<?php
include 'conexionbd.php';

// Obtener productos
$sql = "SELECT * FROM productos";
$result = $conn->query($sql);
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
        <hr class="bg-light">
        <nav class="nav flex-column">
            <a class="nav-link text-white" href="ventas.html">Ventas</a>
            <a class="nav-link text-white" href="PRODUCTOSADMIN.php">Productos</a>
            <a class="nav-link text-white" href="DONACIONESADMIN.html">Donaciones</a>
            <a class="nav-link text-white" href="EVENTOSADMIN.html">Eventos</a>
        </nav>
    </div>
    <div class="container my-5">
        <h1>Productos</h1>
        <a href="form.php" class="btn btn-outline-dark mb-3">Agregar Producto</a>
        <table class="table table-lolo table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Categoría</th>
                    <th>Características</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['nombre']; ?></td>
                        <td><?php echo $row['precio']; ?></td>
                        <td><?php echo $row['categoria']; ?></td>
                        <td><?php echo $row['caracteristicas']; ?></td>
                        <td>
                            <?php if ($row['imagen']): ?>
                                <img src="uploads/<?php echo $row['imagen']; ?>" width="100" alt="Imagen del Producto">
                            <?php else: ?>
                                Sin imagen
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="form.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-dark">Editar</a>
                            <a href="eliminar.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-dark btn-sm" onclick="return confirm('¿Estás seguro de eliminar este producto?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>