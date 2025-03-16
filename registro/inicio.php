<?php
session_start();

// Verifica si el usuario está autenticado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ./index.html"); // Redirige al login si no hay sesión activa
    exit();
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center">Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?> 🎉</h2>

    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
    <div class="container">
        <a class="navbar-brand" href="#">🔹 Menú Principal</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-danger" href="cerrar_sesion.php">🚪 Cerrar Sesión</a>
                </li>
            </ul>
        </div>
    </div>
    </nav>


    <div class="card shadow p-3 mt-4 text-center" style="cursor: pointer;" onclick="window.location.href='../usuarios/index.html'">
    <div class="card-body">
        <h5 class="card-title">👥 Ir a Usuarios</h5>
        <p class="card-text">Consulta y gestiona la lista de usuarios registrados.</p>
    </div>
</div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
