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

$user_id = $_SESSION['user_id'];

// Obtener los datos del usuario
$query = $conn->prepare("SELECT nombre, apellido, fecha_nacimiento, correo, telefono FROM usuarios WHERE ID_Usuario = ?");
$query->bind_param("i", $user_id);
$query->execute();
$query->store_result();
$query->bind_result($nombre, $apellido, $fecha_nacimiento, $correo, $telefono);

if ($query->num_rows === 1) {
    $query->fetch();
} else {
    echo "Usuario no encontrado";
    exit();
}

$query->close();
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario - CDMI</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto Condensed', sans-serif;
            background-color: #f4f1ea;
            color: #333;
        }

        .navbar {
            background-color: rgb(129, 41, 41);
        }

        .navbar-brand img {
            height: 40px;
            margin-right: 10px;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .navbar-nav .nav-link {
            color: #ffffff;
        }

        .navbar-nav .nav-link.active {
            font-weight: bold;
            color: #f8f9fa;
        }

        .navbar-nav .nav-link:hover {
            color: #e0e0e0;
        }

        .profile-pic {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        .edit-mode .view-mode {
            display: none;
        }

        .view-mode .edit-mode {
            display: none;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: rgb(129, 41, 41);
            border-color: rgb(129, 41, 41);
        }

        .btn-primary:hover {
            background-color: rgb(100, 30, 30);
            border-color: rgb(100, 30, 30);
        }

        .btn-outline-light {
            border-color: rgb(129, 41, 41);
            color: rgb(129, 41, 41);
        }

        .btn-outline-light:hover {
            background-color: rgb(129, 41, 41);
            color: #fff;
        }

        .form-label {
            color: rgb(129, 41, 41);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="inicio.html">
                <img src="img/logocdmi.png" alt="Logo CDMI">
                CDMI
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="producto.html">Productos <i class="bi bi-box2-heart"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="donaciones.html">Donaciones <i class="bi bi-coin"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" aria-current="page" href="marketing.html">Eventos <i
                                class="bi bi-calendar2-check"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="miscompras.html">Mis compras <i class="bi bi-bag-check"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="carrito.html">Carrito <i class="bi bi-cart4"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="perfil.php"><i class="bi bi-person"></i> Perfil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="logout.php"><i class="bi bi-box-arrow-right"></i> Cerrar sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Perfil de Usuario</h3>
                        <div class="text-center">
                            <img src="/api/placeholder/150/150" alt="Foto de perfil" class="profile-pic" id="profilePic">
                            <input type="file" id="profilePicInput" accept="image/*" style="display: none;">
                            <button class="btn btn-outline-light mb-3"
                                onclick="document.getElementById('profilePicInput').click()">Cambiar foto</button>
                        </div>
                        <div id="profileInfo" class="view-mode">
                            <div class="mb-3">
                                <strong>Nombre:</strong> <span id="nombreView">
                                    <?php echo htmlspecialchars($nombre); ?>
                                </span>
                            </div>
                            <div class="mb-3">
                                <strong>Apellido:</strong> <span id="apellidoView">
                                    <?php echo htmlspecialchars($apellido); ?>
                                </span>
                            </div>
                            <div class="mb-3">
                                <strong>Fecha de Nacimiento:</strong> <span id="fechaNacimientoView">
                                    <?php echo htmlspecialchars($fecha_nacimiento); ?>
                                </span>
                            </div>
                            <div class="mb-3">
                                <strong>Correo Electrónico:</strong> <span id="correoView">
                                    <?php echo htmlspecialchars($correo); ?>
                                </span>
                            </div>
                            <div class="mb-3">
                                <strong>Teléfono:</strong> <span id="telefonoView">
                                    <?php echo htmlspecialchars($telefono); ?>
                                </span>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-primary" onclick="toggleEditMode()">Editar Perfil</button>
                            </div>
                        </div>
                        <form id="profileForm" class="edit-mode" style="display: none;" method="post" action="update_profile.php">
                            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="apellido" class="form-label">Apellido:</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo htmlspecialchars($apellido); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="fechaNacimiento" class="form-label">Fecha de Nacimiento:</label>
                                <input type="date" class="form-control" id="fechaNacimiento" name="fecha_nacimiento" value="<?php echo htmlspecialchars($fecha_nacimiento); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="correo" class="form-label">Correo Electrónico:</label>
                                <input type="email" class="form-control" id="correo" name="correo" value="<?php echo htmlspecialchars($correo); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono:</label>
                                <input type="tel" class="form-control" id="telefono" name="telefono" value="<?php echo htmlspecialchars($telefono); ?>">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                <button type="button" class="btn btn-secondary" onclick="toggleEditMode()">Cancelar</button>
                            </div>
                        </form>
                        <div class="text-center mt-3">
                            <form id="deleteUserForm" action="delete_user.php" method="post">
                                <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
                                <button type="submit" class="btn btn-danger">Eliminar Usuario</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('profilePicInput').addEventListener('change', function (e) {
            if (e.target.files && e.target.files[0]) {
                let reader = new FileReader();
                reader.onload = function (event) {
                    document.getElementById('profilePic').setAttribute('src', event.target.result);
                }
                reader.readAsDataURL(e.target.files[0]);
            }
        });

        function toggleEditMode() {
            const viewMode = document.getElementById('profileInfo');
            const editMode = document.getElementById('profileForm');
            if (viewMode.style.display === 'none') {
                viewMode.style.display = 'block';
                editMode.style.display = 'none';
            } else {
                viewMode.style.display = 'none';
                editMode.style.display = 'block';
            }
        }
    </script>
</body>

</html>
