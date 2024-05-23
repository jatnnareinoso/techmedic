<?php
session_start();

include 'conexion.php';
$conn = Conexion::ConexionBD();

if (isset($_SESSION['correo_doctor'])) {
    $correo_doctor = $_SESSION['correo_doctor'];

    $sql = "SELECT * FROM doctor WHERE correo = '$correo_doctor'";
    $result = $conn->query($sql);

    if ($result) {
        $doctor = $result->fetch(PDO::FETCH_ASSOC);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id_paciente = $_POST['id_paciente']; 
            $fecha_consulta = $_POST['fecha_consulta'];
            $diagnostico = $_POST['diagnostico'];
            $tratamiento = $_POST['tratamiento'];
            $cita = $_POST['cita'];
            $observacion = $_POST['observacion'];

            $sqlInsertConsulta = "INSERT INTO consulta (id_paciente, id_doctor, fecha_consulta, diagnostico, tratamiento, cita, observacion) 
                                 VALUES ('$id_paciente', '{$doctor['id_doctor']}', '$fecha_consulta', '$diagnostico', '$tratamiento', '$cita', '$observacion')";

            $resultInsertConsulta = $conn->exec($sqlInsertConsulta);

            if ($resultInsertConsulta) {
                header("Location: citas.php");
                exit;
            } else {
                $errorInfoInsertConsulta = isset($conn) ? $conn->errorInfo() : null;
                echo "Error: " . ($errorInfoInsertConsulta ? $errorInfoInsertConsulta[2] : "No se pudo insertar la consulta");
            }
        }

    } else {
        $errorInfo = isset($conn) ? $conn->errorInfo() : null;
        echo "Error: " . ($errorInfo ? $errorInfo[2] : "No se pudo obtener información del error");
    }
} else {
    header("Location: login_doctor.html");
    exit;
}

$queryPacientes = "SELECT id_paciente, nombre, apellido FROM paciente";
$resultPacientes = $conn->query($queryPacientes);

if ($resultPacientes) {
    $pacientes = $resultPacientes->fetchAll(PDO::FETCH_ASSOC);
} else {
    echo "Error en la consulta de pacientes: " . $conn->errorInfo()[2];
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

    <title>TechMedic - Citas</title>

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
    
                <li class="nav-item active">
                    <a class="nav-link" href="citas.php">
                        <i class="fa-solid fa-hospital-user"></i>
                        <span>Citas</span>
                    </a>
                </li>
    
                <li class="nav-item">
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
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Dr. <?php echo $doctor['nombre'] . ' ' . $doctor['apellido']; ?>   </span>
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
    
                    <div id="wrapper">
                        <div id="content">
                            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                                    <i class="fa fa-bars"></i>
                                </button>
                            </nav>
                            <div class="container-fluid">
                                <h1 class="h3 mb-4 text-gray-800">Crear Consulta</h1>
                                <form method="post" action="registrar_consulta.php">
                                    <div class="form-group">
                                    <label for="id_paciente">Seleccionar Paciente:</label>
                                    <select class="form-control" name="id_paciente" required>
                                        <?php foreach ($pacientes as $paciente) : ?>
                                            <option value="<?php echo $paciente['id_paciente']; ?>">
                                                <?php echo $paciente['id_paciente'] . ' - ' . $paciente['nombre'] . ' ' . $paciente['apellido']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="fecha_consulta">Fecha de Consulta:</label>
                                        <input type="date" class="form-control" name="fecha_consulta" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="diagnostico">Diagnóstico:</label>
                                        <textarea class="form-control" name="diagnostico" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="tratamiento">Tratamiento:</label>
                                        <textarea class="form-control" name="tratamiento" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="cita" for="cita">Cita:</label>
                                        <input type="date" class="form-control" name="cita" id="cita">
                                        
                                    </div>
                                    <div class="form-group">
                                        <label for="observacion">Observación:</label>
                                        <textarea class="form-control" name="observacion"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Crear Consulta</button>
                                </form>
                            </div>
                        </div>
                    </div> 
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
