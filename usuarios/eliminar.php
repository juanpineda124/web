<?php
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

// Verificar si se pasó un ID válido
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Preparar y ejecutar la eliminación
    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Usuario eliminado correctamente.";
    } else {
        echo "Error al eliminar usuario: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();

    // Redirigir de vuelta a la lista de usuarios
    header("Location: mostrar.php");
    exit();
} else {
    echo "ID no válido.";
}
?>
