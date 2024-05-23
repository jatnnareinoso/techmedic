<?php
session_start();

include 'conexion.php';
$conn = Conexion::ConexionBD();

if (isset($_SESSION['correo_doctor'])) {
    $correo_doctor = $_SESSION['correo_doctor'];

    $sql = "SELECT * FROM doctor WHERE correo = :correo";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':correo', $correo_doctor);
    $stmt->execute();

    $doctor = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($doctor) {
        $idDoctor = $doctor['id_doctor'];

        $sqlHistorial = "SELECT hc.*, p.nombre AS nombre_paciente, p.apellido AS apellido_paciente, e.nombre AS nombre_enfermedad, d.nombre AS nombre_doctor, d.apellido AS apellido_doctor
                        FROM historia_clinica hc
                        INNER JOIN paciente p ON hc.id_paciente = p.id_paciente
                        INNER JOIN enfermedad e ON hc.id_enfermedad = e.id_enfermedad
                        INNER JOIN doctor d ON hc.id_doctor = d.id_doctor
                        WHERE hc.id_doctor = :idDoctor";
        $stmtHistorial = $conn->prepare($sqlHistorial);
        $stmtHistorial->bindParam(':idDoctor', $idDoctor);
        $stmtHistorial->execute();

        $sqlEnfermedades = "SELECT * FROM enfermedad";
        $stmtEnfermedades = $conn->query($sqlEnfermedades);

    } else {
        $errorInfo = isset($conn) ? $conn->errorInfo() : null;
        echo "Error: " . ($errorInfo ? $errorInfo[2] : "No se pudo obtener información del doctor");
    }
} else {
    header("Location: login_doctor.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TechMedic - Historial Clínico</title>

    <script src="https://kit.fontawesome.com/c2b1422a44.js" crossorigin="anonymous"></script>

    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="inicio_doctor.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <img src="logo_only.png" alt="TechMedic Logo" class="img-fluid">
                </div>
                <div class="sidebar-brand-text mx-3">TechMedic</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="inicio_doctor.php">
                    <i class="fa-solid fa-user-doctor"></i>
                    <span>Sobre Mi</span></a>
            </li>

            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link" href="pacientes.php">
                    <i class="fa-solid fa-hospital-user"></i>
                    <span>Pacientes</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="citas.php">
                    <i class="fa-solid fa-hospital-user"></i>
                    <span>Citas</span>
                </a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="historial_clinico.php">
                    <i class="fa-solid fa-stethoscope"></i>
                    <span>Historial Clínico</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="mensajeria.php">
                    <i class="fa-regular fa-envelope"></i>
                    <span>Mensajería</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="calendar.php">
                    <i class="fa-solid fa-calendar-days"></i>
                    <span>Calendario</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="inicio_doctor.php">
                    <i class="fa-solid fa-briefcase"></i>
                    <span>Permisos</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="inicio_doctor.php">
                    <i class="fa-solid fa-circle-info"></i>
                    <span>Informaciones</span></a>
            </li>

        </ul>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <ul class="navbar-nav ml-auto">

                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <span class="badge badge-danger badge-counter"></span>
                            </a>
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Notificaciones
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Ver todas las notificaciones</a>
                            </div>
                        </li>

                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <span class="badge badge-danger badge-counter"></span>
                            </a>
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Centro de Mensajes
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                            alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Leer otros mensajes</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Dr. <?php echo $doctor['nombre'] . ' ' . $doctor['apellido']; ?> </span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="perfil_doctor.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <a class="dropdown-item" href="configuracion_doctor.php">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Configuración
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Salir
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>

                <div class="container-fluid">

                    <h1 class="h3 mb-4 text-gray-800">Historial Clínico</h1>

                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Historial Clínico</h5>
                                    <?php
                                    if ($stmtHistorial->rowCount() > 0) {
                                        while ($historia = $stmtHistorial->fetch(PDO::FETCH_ASSOC)) {
                                            echo "<p><strong>Fecha de Registro:</strong> " . $historia['fecha_registro'] . "</p>";
                                            echo "<p><strong>Paciente:</strong> " . $historia['nombre_paciente'] . " " . $historia['apellido_paciente'] . "</p>";
                                            echo "<p><strong>Enfermedad:</strong> " . $historia['nombre_enfermedad'] . "</p>";
                                            echo "<p><strong>Doctor:</strong> " . $historia['nombre_doctor'] . " " . $historia['apellido_doctor'] . "</p>";
                                            echo "<p><strong>Antecedentes:</strong> " . $historia['antecedentes'] . "</p>";
                                            echo "<p><strong>Resultados:</strong> " . $historia['resultados'] . "</p>";
                                            echo "<p><strong>Observación:</strong> " . $historia['observacion'] . "</p>";
                                            echo "<hr>";
                                        }
                                    } else {
                                        echo "<p>No hay registros en el historial clínico.</p>";
                                    }
                                    ?>
                                    <a href="crear_historial_clinico.php" class="btn btn-primary">Agregar Historial Clínico</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Lista de Enfermedades</h5>
                                    <?php
                                    if ($stmtEnfermedades->rowCount() > 0) {
                                        echo "<table class='table'>";
                                        echo "<thead><tr><th>ID</th><th>Nombre</th><th>Síntomas</th><th>Tratamiento</th><th>Observación</th></tr></thead><tbody>";
                                        while ($enfermedad = $stmtEnfermedades->fetch(PDO::FETCH_ASSOC)) {
                                            echo "<tr>";
                                            echo "<td>" . $enfermedad['id_enfermedad'] . "</td>";
                                            echo "<td>" . $enfermedad['nombre'] . "</td>";
                                            echo "<td>" . $enfermedad['sintomas'] . "</td>";
                                            echo "<td>" . $enfermedad['tratamiento'] . "</td>";
                                            echo "<td>" . $enfermedad['observacion'] . "</td>";
                                            echo "</tr>";
                                        }
                                        echo "</tbody></table>";
                                    } else {
                                        echo "<p>No hay enfermedades registradas.</p>";
                                    }
                                    ?>
                                    <a href="crear_enfermedad.php" class="btn btn-primary">Agregar Enfermedad</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
