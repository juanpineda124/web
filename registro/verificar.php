<?php
session_start(); // Iniciar sesión

// Conectar a la base de datos
$conexion = new mysqli("localhost", "root", "", "mi_base_datos");

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Recibir datos del formulario
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

// Buscar usuario en la BD
$sql = "SELECT id, nombre, contrasena FROM registro WHERE correo = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();

    // Verificar la contraseña
    if (password_verify($contrasena, $usuario['contrasena'])) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nombre'] = $usuario['nombre'];

        echo "<script>
            alert('Inicio de sesión exitoso');
            window.location.href = 'inicio.php';
        </script>";
    } else {
        echo "<script>
            alert('Contraseña incorrecta');
            window.history.back();
        </script>";
    }
} else {
    echo "<script>
        alert('Correo no registrado');
        window.history.back();
    </script>";
}

// Cerrar conexión
$stmt->close();
$conexion->close();
?>
