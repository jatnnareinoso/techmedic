<?php
session_start();

include 'conexion.php';

if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];

    // Establecer conexión a la base de datos
    $conn = Conexion::ConexionBD();

    // Consultar los datos del usuario
    $sql = "SELECT nombre, apellidos FROM usuarios WHERE usuario = :usuario";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si se encontró al usuario
    if ($user) {
        $nombre = $user['nombre'];
        $apellidos = $user['apellidos'];
    } else {
        echo "Error: No se pudo obtener la información del usuario.";
    }
} else {
    // Redireccionar al usuario a la página de inicio de sesión si no ha iniciado sesión
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmacia Ismenia - Inicio</title>
    <link rel="stylesheet" href="CSS/styles.css">
    <meta name="author" content="">
    <script src="https://kit.fontawesome.com/c2b1422a44.js" crossorigin="anonymous"></script>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body>
    <header>
        <img src="img/logo2.jpeg" alt="Logo Farmacia" width="200">
        <h1>Bienvenido, <?php echo $nombre . ' ' . $apellidos; ?>!</h1>
    </header>

    <!-- Contenido principal -->
    <main>
        <h2>Contenido Principal</h2>
        <!-- Aquí puedes agregar más contenido HTML si es necesario -->
        <p>¡Aquí puedes colocar información relevante para el usuario!</p>

        <!-- Imágenes -->
        <div>
            <h3>Imágenes</h3>
            <img src="imagen1.jpg" alt="Imagen 1" width="200">
            <img src="imagen2.jpg" alt="Imagen 2" width="200">
            <img src="imagen3.jpg" alt="Imagen 3" width="200">
        </div>
    </main>

    <!-- Menú de opciones -->
    <nav>
        <h2>Menú de Opciones</h2>
        <ul>
            <li><a href="clientes.php">Clientes</a></li>
            <li><a href="recetas.php">Recetas</a></li>
            <li><a href="compras.php">Compras</a></li>
        </ul>
    </nav>

    <!-- Pie de página -->
    <footer>
        <!-- Agrega información adicional en el pie de página si es necesario -->
        <p>&copy; <?php echo date("Y"); ?> Farmacia Ismenia. Todos los derechos reservados.</p>
    </footer>
</body>

</html>
