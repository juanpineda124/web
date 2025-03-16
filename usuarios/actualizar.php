<?php
// Conectar a la base de datos
$conexion = new mysqli("localhost", "root", "", "mi_base_datos");

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Verificar si se recibieron los datos
if (isset($_POST['id'], $_POST['nombre'], $_POST['correo'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];

    // Actualizar usuario en la base de datos
    $sql = "UPDATE usuarios SET nombre = ?, correo = ? WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssi", $nombre, $correo, $id);

    if ($stmt->execute()) {
        echo "Usuario actualizado correctamente.";
    } else {
        echo "Error al actualizar usuario: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();

    // Redirigir de vuelta a la lista de usuarios
    header("Location: mostrar.php");
    exit();
} else {
    echo "Datos incompletos.";
}
?>
