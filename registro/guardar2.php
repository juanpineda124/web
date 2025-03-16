<?php
// Conectar a la base de datos
$conexion = new mysqli("localhost", "root", "", "mi_base_datos");

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Recibir datos del formulario
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT); // Encriptar contraseña

// Insertar usuario en la base de datos
$sql = "INSERT INTO registro (nombre, correo, contrasena) VALUES (?, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("sss", $nombre, $correo, $contrasena);

if ($stmt->execute()) {
    echo "<script>
        alert('Registro exitoso');
        window.location.href = 'registro.php';
    </script>";
} else {
    echo "<script>
        alert('Error al registrar usuario');
        window.history.back();
    </script>";
}

// Cerrar conexión
$stmt->close();
$conexion->close();
?>
