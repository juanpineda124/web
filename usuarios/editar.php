<?php
session_start();

// Verifica si el usuario está autenticado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../registro/login.php"); // Redirige al login si no hay sesión activa
    exit();
}
// Conectar a la base de datos
$conexion = new mysqli("localhost", "root", "", "mi_base_datos");

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener el ID del usuario
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener datos del usuario
    $sql = "SELECT nombre, correo FROM usuarios WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $usuario = $resultado->fetch_assoc();

    if (!$usuario) {
        echo "Usuario no encontrado.";
        exit();
    }
} else {
    echo "ID no válido.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <!-- Enlace a Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center mb-4">Editar Usuario</h2>

    <div class="card shadow p-4">
        <form action="actualizar.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $usuario['nombre']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="correo" class="form-label">Correo:</label>
                <input type="email" id="correo" name="correo" class="form-control" value="<?php echo $usuario['correo']; ?>" required>
            </div>

            <div class="d-flex justify-content-center gap-3">
                <button type="submit" class="btn btn-success">💾 Guardar cambios</button>
                <a href="mostrar.php" class="btn btn-secondary">❌ Cancelar</a>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
$stmt->close();
$conexion->close();
?>
