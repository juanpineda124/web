<?php
session_start();

// Verifica si el usuario está autenticado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../registro/login.php"); // Redirige al login si no hay sesión activa
    exit();
}

// Datos de conexión
$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$base_datos = "mi_base_datos";

// Conectar a la base de datos
$conexion = new mysqli($servidor, $usuario, $contrasena, $base_datos);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consultar los usuarios
$sql = "SELECT id, nombre, correo FROM usuarios";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <!-- Enlace a Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center mb-4">Lista de Usuarios Registrados</h2>
    
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultado->num_rows > 0) {
                    while ($fila = $resultado->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $fila["id"] . "</td>";
                        echo "<td>" . $fila["nombre"] . "</td>";
                        echo "<td>" . $fila["correo"] . "</td>";
                        echo "<td>
                            <div class='d-flex justify-content-center gap-2'>
                                <form action='editar.php' method='GET'>
                                    <input type='hidden' name='id' value='" . $fila["id"] . "'>
                                    <button type='submit' class='btn btn-primary btn-sm'>✏️ Editar</button>
                                </form>
                                <form action='eliminar.php' method='GET'>
                                    <input type='hidden' name='id' value='" . $fila["id"] . "'>
                                    <button type='submit' onclick='return confirm(\"¿Estás seguro de eliminar este usuario?\")' class='btn btn-danger btn-sm'>❌ Eliminar</button>
                                </form>
                            </div>
                        </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>No hay usuarios registrados</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="text-center mt-4">
        <a href="index.html" class="btn btn-success">Volver al formulario</a>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
// Cerrar conexión
$conexion->close();
?>
