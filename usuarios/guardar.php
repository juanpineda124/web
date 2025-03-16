<?php
// Datos de conexión
$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$base_datos = "mi_base_datos";

// Conectar a la base de datos
$conexion = new mysqli($servidor, $usuario, $contrasena, $base_datos);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Verificar si los datos fueron enviados
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['nombre']) && !empty($_POST['correo'])) {
        // Obtener los datos del formulario
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];

        // Preparar la consulta SQL
        $sql = "INSERT INTO usuarios (nombre, correo) VALUES (?, ?)";
        $stmt = $conexion->prepare($sql);

        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $conexion->error);
        }

        // Asociar parámetros y ejecutar
        $stmt->bind_param("ss", $nombre, $correo);

        if ($stmt->execute()) {
            echo "Registro exitoso. <a href='mostrar.php'>Ir al registro</a>";
        } else {
            echo "Error al guardar: " . $stmt->error;
        }

        // Cerrar la conexión
        $stmt->close();
        $conexion->close();
    } else {
        echo "Por favor, completa todos los campos.";
    }
} else {
    echo "Método no permitido.";
}
?>
